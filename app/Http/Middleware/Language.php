<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Foundation\Application;

class Language
{

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $this->app->setLocale(session('my_locale', config('app.locale')));

        return $next($request);
    }
}
