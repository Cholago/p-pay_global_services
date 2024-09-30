<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\LoginLog;

class LogUserActions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Log user sign out
            // Create a new entry in the LoginLog table with user ID, IP address, and 'logout' action
            LoginLog::create([
                'user_id' => Auth::id(),
                'ip_address' => $request->ip(),
                'action' => 'logout'
            ]);
        }
        
        // Pass the request to the next middleware or controller
        return $next($request);
    }

    /**
     * Perform any final actions after the response has been sent to the browser.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function terminate($request, $response)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Log user sign in
            // Create a new entry in the LoginLog table with user ID, IP address, and 'login' action
            LoginLog::create([
                'user_id' => Auth::id(),
                'ip_address' => $request->ip(),
                'action' => 'login'
            ]);
        }
        
    }
}
