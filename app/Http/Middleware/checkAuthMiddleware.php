<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // Perlu mengimpor kelas Auth
use Illuminate\Support\Facades\Session; // Perlu mengimpor kelas Session

class CheckAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            
            return $next($request);
            
        }

        // Store the message in the session with a valid string key
        Session::flash('loginMessage', 'Anda Belum Login');

        // Redirect the user to the login page
        return redirect('/nolan.com/login');
    }
}
