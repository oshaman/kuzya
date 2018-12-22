<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 25.07.2018
 * Time: 10:44
 */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$subject??'Email from Kuzia'}}</title>
</head>
<body>

@isset($name)
    <p>@lang('site.name'): {{$name}}</p>
@endisset
@isset($surname)
    <p>@lang('site.surname'): {{$surname}}</p>
@endisset
@isset($email)
    <p>Email: {{$email}}</p>
@endisset
@isset($phone)
    <p>@lang('site.phone'): {{$phone}}</p>
@endisset
@isset($content)
    <p>@lang('site.form_content'): {{$content}}</p>
@endisset
@isset($street)
    <p>@lang('site.street'): {{$street}}</p>
@endisset
@isset($house)
    <p>@lang('site.house'): {{$house}}</p>
@endisset
@isset($link)
    <p>@lang('site.link'): <a href="{{$link}}">{{$title??$link}}</a></p>
@endisset

</body>
</html>
