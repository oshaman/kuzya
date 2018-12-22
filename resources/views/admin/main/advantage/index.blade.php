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
    <a href="{{route('advantage.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add_review_advantages')</button>
    </a>
    <table class="example2 table table-bordered table-hover advantages">
        <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.image')</th>
            <th>@lang('admins.image_dark')</th>
            <th>@lang('admins.visible')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </thead>
        @foreach($models as $model)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$model->id}}</td>
                <td>{{$model->name}}</td>
                <td>
                    @if($model->image)
                        <img src="{{$model->image}}" class="img-bordered-sm" style="max-height: 50px;max-width: 50px;background-color: cadetblue">
                    @endif
                </td>
                <td>
                    @if($model->image_dark)
                        <img src="{{$model->image_dark}}" class="img-bordered-sm" style="max-height: 50px;max-width: 50px;background-color: cadetblue">
                    @endif
                </td>
                @if($visible == 'in_main')
                    <td>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" data-id="{{$model->id}}" name="in_main" class="minimal"
                                        {{ $model->in_main==1?'checked':'' }}>
                            </label>
                        </div>
                    </td>
                @endif
                @if($visible == 'in_internet')
                    <td>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" data-id="{{$model->id}}" name="in_internet" class="minimal"
                                        {{ $model->in_internet==1?'checked':'' }}>
                            </label>
                        </div>
                    </td>
                @endif
                @if($visible == 'in_about')
                    <td>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" data-id="{{$model->id}}" name="in_about" class="minimal"
                                        {{ $model->in_about==1?'checked':'' }}>
                            </label>
                        </div>
                    </td>
                @endif
                <td class="text-center">
                    <a href="{{route('advantage.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
                <td class="text-center">
                    <a class="text-red btn btn-link  btn-destr"
                       data-url="{{route('advantage.destroy',$model->id)}}">@lang('admins.destroy')</a>
                </td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.image')</th>
            <th>@lang('admins.image_dark')</th>
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
    </script>
@endsection
