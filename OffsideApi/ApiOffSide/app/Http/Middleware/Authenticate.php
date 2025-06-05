<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
    protected function unauthenticated($request, array $guards)
        {
        // Verificar si la solicitud espera JSON
        if ($request->expectsJson()) {
        response()->json(['message' => 'No autenticado.'], 401)->send();
        exit; // Detener la ejecución
        }
        // Si no es una solicitud JSON, lanzar un error genérico
        abort(401, 'No autenticado.');
        }

        protected function redirectTo($request)
        {
        // Si la solicitud espera JSON, no redirigir
        if ($request->expectsJson()) {
            return null;

        }
            // Si es una solicitud web (HTML), redirigir a la ruta 'login'
            return route('login');
        }
}
