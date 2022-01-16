<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->is_admin == 0){
            return $next($request);
        }
        $notification = array(
            'message' => Lang::get('content.youdonothavepermissiontoaccessthispage'),
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }
}
