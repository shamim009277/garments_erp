<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Administration\Module;
use Symfony\Component\HttpFoundation\Response;

class ModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $moduleName): Response
    {
        $module = Module::where('slug', $moduleName)->first();
        if (!$module || !$module->is_active) {
            abort(403, "The {$moduleName} module is not active.");
        }
        return $next($request);
    }
}
