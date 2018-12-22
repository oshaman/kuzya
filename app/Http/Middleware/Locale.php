<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;

class Locale
{
    public static $mainLanguage = 'ru'; //основной язык, который не должен отображаться в URl

    public static $languages
        = [
            /*'en',*/
           'ru',
           'uk',
        ]; // Указываем, какие языки будем использовать в приложении.

    /*
     * Проверяет наличие корректной метки языка в текущем URL
     * Возвращает метку или значеие null, если нет метки
     */
    public static function getLocale()
    {
        $uri = Request::path(); //получаем URI


        $segmentsURI = explode('/', $uri); //делим на части по разделителю "/"


        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {

            if ($segmentsURI[0] != self::$mainLanguage) {
                return $segmentsURI[0];
            }

        }


        return null;
    }

    /*
    * Устанавливает язык приложения в зависимости от метки языка из URL
    */
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();
        if (!$locale) {
            $locale = self::$mainLanguage;
        }
        App::setLocale($locale);
        if (Cookie::get('lang') != $locale) {
            return $next($request);
        }

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }
}
