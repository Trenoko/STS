<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika user adalah admin
        if (session('admin')) {
            return $next($request);
        }

        // Redirect kalau bukan admin
        return redirect()->route('login')->with('error', 'Hei Kamu Bukan Koki Handal Tidak Boleh Masuk!');
    }
}

