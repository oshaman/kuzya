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
    <a href="{{route('reviews.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add_review')</button>
    </a>
    <table class="example2 table table-bordered table-hover reviews">
        <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.content')</th>
            <th>@lang('admins.image')</th>
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
                <td>{!! str_limit(strip_tags($model->description),300) !!}</td>
                <td>@if($model->image)<img src="{{$model->image}}" style="max-height: 50px;max-width: 50px;">@endif</td>
                <td>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" data-id="{{$model->id}}"
                                   class="minimal"
                                   name="is_visible"
                                    {{ $model->is_visible==1?'checked':'' }}>
                        </label>
                    </div>
                </td>
                <td class="text-center">
                    <a href="{{route('reviews.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
                <td class="text-center"><a class="text-red btn btn-link  btn-destr"
                                           data-url="{{route('reviews.destroy',$model->id)}}">@lang('admins.destroy')</a></td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>#</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.content')</th>
            <th>@lang('admins.image')</th>
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
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $('.example2').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
        $('.icheckbox_minimal-blue ins').on('click', function () {
            var input = $(this).siblings('input[type="checkbox"].minimal');

            $.post({
                url: '/admin/reviews/switch-pub/' + input.data('id'),
                data: {'name': input.attr('name')},
                success: function (resp) {
                    if (resp == 1) {
                        location.reload();
                    }
                }
            });
        });
    </script>
@endsection
