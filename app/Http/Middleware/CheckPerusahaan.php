<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPerusahaan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the authenticated user's perusahaan record
        $user = Auth::user();

        // Check if the user's perusahaan status is "menunggu"
        if ($user && $user->perusahaan && $user->perusahaan->status === 'menunggu') {
            // Redirect to the dashboard with an error message
            return redirect()->route('dashboard')->with('error', 'Your perusahaan status is pending approval. You cannot access this area.');
        }

        return $next($request);
    }
}
