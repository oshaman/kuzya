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
        <label for="footertext_ru">@lang('admins.footer_text')</label>
        @foreach(\App\Http\Middleware\Locale::$languages as $lang)
            @include('admin.locale_inputs.textarea_lang',['field_name'=>'footertext','class_ex'=>'my-editor'])
        @endforeach
    </div>
@stop

@section('sub_content')
    <div class="pad">
        <div class="h2">@lang('menu.advantages')</div>
        <div class="advantages-wrapp"></div>
    </div>
@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="{{asset('vendor/iCheck/all.css')}}">
@stop
@section('js')
    @parent
    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        //iCheck for checkbox and radio inputs
        var table;

        function initTable() {
            $('input[type="checkbox"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            table = $('.example2').DataTable({
                'paging': false,
                'lengthChange': true,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
            $('.icheckbox_minimal-blue ins').on('click', switchStatus);
        }


        function switchStatus() {
            var input = $(this).siblings('input[type="checkbox"].minimal');
            $.post({
                url: '/admin/advantages/switch-pub/' + input.data('id'),
                data: {'name': input.attr('name')},
                success: function (html) {
                    $('.example2').html($(html).find('.example2').html());
                    table.destroy();
                    initTable();
                }
            });
        }

        $(function () {
            $.get({
                url: '{{route('advantage.index',['visible'=>'in_about'])}}',
                success: function (resp) {
                    $('.advantages-wrapp').html($(resp).find('.content').html());
                    initTable();
                }
            });
        });
    </script>
@endsection