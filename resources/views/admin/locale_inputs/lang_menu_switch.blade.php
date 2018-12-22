<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 20.06.2018
 * Time: 9:35
 */
?>
<div class="lang h3 pull-right">
    @foreach(\App\Http\Middleware\Locale::$languages as $lang)
        <span class="{{$lang==\App\Http\Middleware\Locale::$mainLanguage}}" data-v="{{$lang}}">{{$lang}}</span>
    @endforeach
</div>
