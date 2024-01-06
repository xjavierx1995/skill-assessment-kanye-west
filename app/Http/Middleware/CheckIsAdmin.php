<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         // Verifica si el usuario está autenticado y tiene el atributo isAdmin en true
         if ($request->user() && $request->user()->isAdmin) {
            return $next($request);
        }

        // Si el usuario no cumple con los requisitos, puedes redirigirlo o devolver un error
        return response()->json([
            'success' => false,
            'data'    => ['error' => 'Not allowed'],
            'message' => 'You are not allowed to do this action.',
        ], 403);
    }
}
