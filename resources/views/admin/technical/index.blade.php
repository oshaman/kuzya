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
    <table class="example2 table table-bordered table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>@lang('admins.type')</th>
            <th>@lang('admins.title')</th>
            <th>@lang('admins.status')</th>
            <th>@lang('admins.image')</th>
            <th>@lang('admins.background')</th>
            <th class="text-center">@lang('admins.edit')</th>
        </tr>
        </thead>
        @foreach($models as $model)
            <tr>
                <td>{{$model->id}}</td>
                <td>@lang('admins.'.$model->slug)</td>
                <td>{{$model->title}}</td>
                <td>{!! $model->active ? '<i class="fa fa-thumbs-o-up"></i>' : '<i class="fa fa-thumbs-down"></i>' !!}</td>
                <td>@if($model->image)<img src="{{$model->image}}" style="max-height: 50px;max-width: 50px;">@endif</td>
                <td>@if($model->background)<img src="{{$model->background}}" style="max-height: 50px;max-width: 50px;">@endif</td>
                <td class="text-center">
                    <a href="{{route('technical.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('js')
    <script>
        $('.example2').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });

    </script>
@endsection
