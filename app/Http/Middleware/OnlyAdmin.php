<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OnlyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // hanya admin yang boleh akses
        if(Auth::user()->role_id != 1) {
            // return redirect('/');
            abort(404);
        }

        // jika yg login admin ya lanjutin
        return $next($request);
    }
}
