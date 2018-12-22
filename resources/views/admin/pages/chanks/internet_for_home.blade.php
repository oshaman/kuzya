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
        <div class="h2">@lang('menu.tariffs')</div>
        <div class="tariffs-wrapp"></div>
        <div class="h2">@lang('menu.advantages')</div>
        <div class="advantages-wrapp"></div>
        <div class="h2">@lang('menu.services')</div>
        <div class="services-wrapp"></div>
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
            $('.banners .icheckbox_minimal-blue ins').on('click', switchBannersStatus);
            $('.advantages .icheckbox_minimal-blue ins').on('click', switchAdvantStatus);
            $('.reviews .icheckbox_minimal-blue ins').on('click', switchReviewsStatus);
        }

        function switchAdvantStatus() {
            switchStatus('advantages', $(this));
        }

        function switchBannersStatus() {
            switchStatus('banners', $(this));
        }

        function switchReviewsStatus() {
            switchStatus('reviews', $(this));
        }

        function switchStatus(name, _this) {
            var input = _this.siblings('input[type="checkbox"].minimal');
            $.post({
                url: '/admin/' + name + '/switch-pub/' + input.data('id'),
                data: {'name': input.attr('name')},
                success: function (html) {
                    $('.' + name + ' .example2').html($(html).find('.example2').html());
                    table.destroy();
                    initTable();
                }
            });
        }

        $(function () {
            $.get({
                url: '{{route('tariffs.index')}}',
                success: function (resp) {
                    $('.tariffs-wrapp').html($(resp).find('.content').html());
                    $.get({
                        url: '{{route('advantage.index',['visible'=>'in_internet'])}}',
                        success: function (resp) {
                            $('.advantages-wrapp').html($(resp).find('.content').html());
                            $.get({
                                url: '{{route('services.index')}}',
                                success: function (resp) {
                                    $('.services-wrapp').html($(resp).find('.content').html());
                                    initTable();
                                }
                            });
                        }
                    });
                }
            });


        });
    </script>
@endsection
