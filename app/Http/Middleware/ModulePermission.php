<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModulePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $module): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // LOG : Vérification de la session
        \Log::info('ModulePermission: utilisateur connecté ?', ['user_id' => $user->id ?? null, 'module' => $module]);
        // Vérifier les permissions selon le module
        if ($module === 'maintenance' || $module === 'logistique') {
            // TEMPORAIRE : accès ouvert à tout le monde pour debug
            return $next($request);
        }
        if (!$this->hasModuleAccess($user, $module)) {
            \Log::warning('ModulePermission: accès refusé', ['user_id' => $user->id ?? null, 'module' => $module, 'direction' => $user->direction->code_direction ?? null, 'service' => $user->service->code_service ?? null]);
            // Redirection vers la page d'erreur 403
            return response()->view('errors.403', [
                'message' => "Vous n'avez pas accès au module $module"
            ], 403);
        }

        return $next($request);
    }

    /**
     * Vérifier si l'utilisateur a accès au module
     */
    protected function hasModuleAccess($user, $module): bool
    {
        // Permissions par module basées sur la direction et le service
        switch ($module) {
            case 'moyens-generaux':
                // Accès aux moyens généraux : DFC uniquement
                return $user->belongsToDirection('DFC');
                
            case 'maintenance':
                // Accès à la maintenance : DEX avec service MAINT uniquement
                return $user->belongsToDirection('DEX') && $user->belongsToService('MAINT');
                
            case 'logistique':
                // Accès à la logistique : DEX avec service LOGI uniquement
                return $user->belongsToDirection('DEX') && $user->belongsToService('LOGI');
                
            case 'chauffeurs':
                // Accès aux chauffeurs : DEX uniquement
                return $user->belongsToDirection('DEX');
                
            default:
                return false;
        }
    }
}
