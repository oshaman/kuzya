<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 16.07.2018
 * Time: 12:35
 */

?>

@extends('admin.pages.form')

@section('sub_content')
    <div class="pad">
        <div class="h2">@lang('admins.categoryi')</div>
        <div class="categoryi-wrapp"></div>
        <div class="h2">@lang('admins.questions')</div>
        <div class="questions-wrapp"></div>
    </div>
@endsection


@section('js')
    @parent
    <script>
        var table;

        function initTable() {

            table = $('.example2').DataTable({
                'paging': false,
                'lengthChange': true,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
        }


        $(function () {
            $.get({
                url: '{{route('categorys.index')}}',
                success: function (resp) {
                    $('.categoryi-wrapp').html($(resp).find('.content').html());
                    $.get({
                        url: '{{route('questions.index')}}',
                        success: function (resp) {
                            $('.questions-wrapp').html($(resp).find('.content').html());
                            initTable();
                        }
                    });
                }
            });
        });
    </script>
@endsection
