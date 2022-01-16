<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;

class Lang{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        $locale = $request->route('locale');

        if($locale == null){
            $locale = 'ar';
        }

        App::setLocale($locale);
        URL::defaults(['locale' => $locale]);
        return $next($request);
    }
}
