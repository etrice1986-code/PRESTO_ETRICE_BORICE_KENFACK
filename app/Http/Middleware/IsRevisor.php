<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsRevisor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && Auth::user()->is_revisor) {
            return $next($request);
        }


        return redirect()->route('home')->with('access_denied', 'Accesso negato: Questa sezione è riservata esclusivamente ai revisori.');
    }
}
