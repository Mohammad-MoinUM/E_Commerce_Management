<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLogin
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
        $session = $request->session();
        if($session->has('loginId')){
            return redirect('/admin/dashboard')
                ->with('alert-type','info')
                ->with('message','You are already logged in');
        }
        if($session->has('vendorId')){
            return redirect('/vendor/dashboard')
                ->with('alert-type','info')
                ->with('message','You are already logged in');
        }
        if($session->has('userId')){
            return redirect('/profile')
                ->with('alert-type','info')
                ->with('message','You are already logged in');
        }
        return $next($request);
    }
}
