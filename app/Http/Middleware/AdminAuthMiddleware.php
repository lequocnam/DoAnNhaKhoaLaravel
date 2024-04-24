<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if(Auth::User() && Auth::User()->getRole() == 'admin')
       {
        return $next($request);
        return redirect()->route('admin.home.index');
       }else
       {
        return redirect()->route('employee.tuvanvakhambenh.index');
       }
    }
}
