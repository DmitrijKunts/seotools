<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class SetDefaultLocaleForUrls
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {
        if (!$request->lang) {//сначало определяем язык из запроса браузера
            $acceptLanguage = Str::of($request->header('accept-language'))->explode(',');
            foreach ($acceptLanguage as $acl) {
                $ln = Arr::first(config('app.available_locales', ['en']), function ($avl) use ($acl) {
                    return stripos($acl, $avl) !== false;
                });
                if ($ln) {
                    $request->lang = $ln;
                    break;
                }
            }
        }

        if (!$request->lang) {//если не найден, то берем язык по умолчанию
            $request->lang = config('app.locale', 'en');
        }

        if (!in_array($request->lang, config('app.available_locales', ['en']))) {
            abort(404);
        }

        App::setlocale($request->lang);
        URL::defaults(['lang' => $request->lang]);

        return $next($request);
    }
}
