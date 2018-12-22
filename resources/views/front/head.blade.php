<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>@yield('title', $model->seo->seo_title??$model->name??'Кузя' )</title>
    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon.icon')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="//fonts.googleapis.com/css?family=Roboto:300i,400,400i,500,500i,700,700i,900&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/slick/slick-theme.css')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <meta http-equiv="cleartype" content="on">
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'"></script>--}}
    <script>window.jQuery || document.write('<script src="{{asset('assets/js/lib/jquery-1.7.2.min.js')}}"><\/script>')</script>

{{--    <script src="{{asset('assets/js/lib/jquery.inputmask.js')}}"></script>--}}

    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function() {--}}
            {{--$(".phone").inputmask("+3(999)-999-99-99");//�����--}}
        {{--});--}}

    {{--</script>--}}

    @yield('css','')
</head>
<body>
@include('front.header')