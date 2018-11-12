<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Foundation\Application;

class Locale
{

    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $locale = $request->segment(1);
        // $locale = strtolower($locale);

        // if (!in_array($locale, config('app.locales'))) {
        //     $locale = 'vn';
        // }
        // $this->app->setLocale($locale);

        return $next($request);
    }
}
