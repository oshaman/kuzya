<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 11:06
 */

?>
@extends('adminlte::page')

@section('content_header')
    @if(Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success">
                {{Session::get('flash_message')}}
            </div>
        </div>
    @endif
@stop

@section('content')
    <a href="{{route('banners.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add') @lang('admins.banner')</button>
    </a>
    <table class="example2 table table-bordered table-hover banners">
        <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>@lang('admins.image')</th>
            <th>@lang('admins.link')</th>
            <th>@lang('admins.visible')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </thead>
        @foreach($models as $model)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$model->id}}</td>
                <td>
                    @if($model->image)
                        <img src="{{$model->image}}" class="img-bordered-sm" style="max-height: 50px;max-width: 50px;background-color: cadetblue">
                    @endif
                </td>
                <td>{{$model->link}}</td>
                <td>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" data-id="{{$model->id}}" name="in_main" class="minimal"
                                    {{ $model->in_main==1?'checked':'' }}>
                        </label>
                    </div>
                </td>
                <td class="text-center">
                    <a href="{{route('banners.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
                <td class="text-center">
                    <a class="text-red btn btn-link  btn-destr"
                       data-url="{{route('banners.destroy',$model->id)}}">@lang('admins.destroy')</a>
                </td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>#</th>
            <th>@lang('admins.image')</th>
            <th>@lang('admins.link')</th>
            <th>@lang('admins.visible')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </tfoot>
    </table>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('vendor/iCheck/all.css')}}">
@stop
@section('js')
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

        initTable();

        function switchStatus() {
            const url = '/admin/banners/switch-pub/' + $(this).siblings('input[type="checkbox"].minimal').data('id');
            $.post({
                url: url,
                success: function (html) {
                    $('.example2').html($(html).find('.example2').html());
                    table.destroy();
                    initTable();
                }
            });
        }
    </script>
@endsection
