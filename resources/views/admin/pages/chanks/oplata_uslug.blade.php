<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 16.07.2018
 * Time: 11:47
 */

?>

@extends('admin.pages.form')

@section('inner')
    <div class="pad form-group localize">
        <label for="footertext_ru">@lang('admins.bank_details')</label>
        @foreach(\App\Http\Middleware\Locale::$languages as $lang)
            @include('admin.locale_inputs.textarea_lang',['field_name'=>'footertext','class_ex'=>'my-editor'])
        @endforeach
    </div>
@stop

@section('css')
    @parent
    <link rel="stylesheet" href="{{asset('vendor/iCheck/all.css')}}">
@stop
@section('js')
    @parent
    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
@endsection