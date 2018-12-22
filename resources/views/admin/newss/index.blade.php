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
    <a href="{{route('articles.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add') @lang('admins.news')</button>
    </a>
    <table class="example2 table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('admins.status')</th>
            <th>@lang('admins.priority')</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.alias')</th>
            <th>@lang('admins.image')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </thead>
        @foreach($models as $model)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{!! $model->active ? '<i class="fa fa-thumbs-o-up"></i>' : '<i class="fa fa-thumbs-down"></i>' !!}</td>
                <td>{{$model->priority}}</td>
                <td>{{$model->name}}</td>
                <td>{{$model->slug}}</td>
                <td>@if($model->image)<img src="{{$model->image}}" style="max-height: 50px;max-width: 50px;">@endif</td>
                <td class="text-center">
                    <a href="{{route('articles.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
                <td class="text-center"><a class="text-red btn btn-link  btn-destr"
                                           data-url="{{route('articles.destroy',$model->id)}}">@lang('admins.destroy')</a></td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>#</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.alias')</th>
            <th>@lang('admins.image')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </tfoot>
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
