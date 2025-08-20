<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Vérifier si l'utilisateur a au moins une des permissions requises
        foreach ($permissions as $permission) {
            if ($user->hasPermission($permission)) {
        return $next($request);
            }
        }

        // Permissions spéciales pour les directions
        if ($this->checkDirectionAccess($user, $permissions)) {
            return $next($request);
        }

        // Redirection vers la page d'erreur personnalisée au lieu d'abort(403)
        return response()->view('errors.403', [], 403);
    }

    /**
     * Vérifier les accès spéciaux basés sur les directions
     */
    protected function checkDirectionAccess($user, $permissions)
    {
        // Accès AMG pour tous les utilisateurs DFC
        if (in_array('amg.view', $permissions) && $user->belongsToDirection('DFC')) {
            return true;
        }

        // Accès maintenance pour tous les utilisateurs DEX avec service maintenance
        if (in_array('maintenance.view', $permissions) && 
            $user->belongsToDirection('DEX') && 
            $user->belongsToService('MAINT')) {
            return true;
        }

        // Accès logistique pour tous les utilisateurs DEX avec service logistique
        if (in_array('logistique.view', $permissions) && 
            $user->belongsToDirection('DEX') && 
            $user->belongsToService('LOGI')) {
            return true;
        }

        // Accès expression de besoins pour tous les utilisateurs
        if (in_array('besoins.create', $permissions)) {
            return true;
        }

        return false;
    }
}
