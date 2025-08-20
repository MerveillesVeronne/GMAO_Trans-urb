<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Afficher le formulaire de connexion
     */
    public function showLoginForm()
    {
        return view('welcome');
    }

    /**
     * Traiter la connexion
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirection basée sur le rôle et les permissions
            return $this->redirectBasedOnRole($user);
        }

        throw ValidationException::withMessages([
            'email' => ['Les informations de connexion ne correspondent pas à nos enregistrements.'],
        ]);
    }

    /**
     * Redirection basée sur le rôle de l'utilisateur
     */
    protected function redirectBasedOnRole($user)
    {
        // Chargement des relations
        $user->load(['direction', 'service', 'role']);

        // Redirection prioritaire pour DFC/AMG
        if ($user->hasPermission('dfc.full_access') || $user->hasPermission('amg.full_access') || $user->hasPermission('amg.manage')) {
            return redirect()->route('dashboard.moyens-generaux');
        }

        // Redirection pour maintenance
        if ($user->hasPermission('maintenance.manage') || $user->hasPermission('maintenance.full_access')) {
            return redirect()->route('dashboard.maintenance');
        }

        // Redirection pour logistique
        if ($user->hasPermission('logistique.manage') || $user->hasPermission('logistique.full_access')) {
            return redirect()->route('dashboard.logistique');
        }

        // Redirection pour chauffeurs
        if ($user->hasPermission('fdt.create')) {
            return redirect()->route('chauffeur.fdt');
        }

        // Par défaut, redirection vers moyens généraux (pour expression de besoins)
        return redirect()->route('dashboard.moyens-generaux');
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * API - Informations utilisateur connecté
     */
    public function user(Request $request)
    {
        return response()->json([
            'user' => $request->user()->load(['direction', 'service', 'role']),
            'permissions' => $request->user()->role->permissions ?? []
        ]);
    }
}
