<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $userRoleCode = $user->role ? $user->role->code_role : null;

        // Vérifier si l'utilisateur a un des rôles requis
        if (in_array($userRoleCode, $roles)) {
            return $next($request);
        }

        // Vérifier si l'utilisateur a un niveau hiérarchique suffisant
        $requiredLevel = $this->getMinHierarchyLevel($roles);
        $userLevel = $user->role ? $user->role->niveau_hierarchique : 0;

        if ($userLevel >= $requiredLevel) {
        return $next($request);
        }

        // Redirection vers la page d'erreur personnalisée au lieu d'abort(403)
        return response()->view('errors.403', [], 403);
    }

    /**
     * Obtenir le niveau hiérarchique minimum requis
     */
    protected function getMinHierarchyLevel(array $roles)
    {
        $roleLevels = [
            'DIR_DFC' => 100,
            'DIR_DEX' => 100,
            'CHEF_AMG' => 80,
            'CHEF_MAINT' => 80,
            'CHEF_LOGI' => 80,
            'AGENT_AMG' => 50,
            'MECANICIEN' => 40,
            'ELECTRICIEN' => 40,
            'VULCANISATEUR' => 40,
            'CHAUFFEUR' => 30,
            'USER_DIR' => 20,
        ];

        $minLevel = 0;
        foreach ($roles as $role) {
            if (isset($roleLevels[$role])) {
                $minLevel = max($minLevel, $roleLevels[$role]);
            }
        }

        return $minLevel;
    }
}
