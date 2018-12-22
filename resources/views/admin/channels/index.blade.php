<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 11:06
 */

/**
 * @var \App\Models\Channel[] $models
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
    <a href="{{route('channel.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add') @lang('admins.channels')</button>
    </a>
    <table class="example2 table table-bordered table-hover categorys">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('admins.status')</th>
            <th>@lang('admins.priority')</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.image')</th>
            <th class="text-center">@lang('admins.edit')</th>
        </tr>
        </thead>
        @foreach($models as $model)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{!! $model->active ? '<i class="fa fa-thumbs-o-up"></i>' : '<i class="fa fa-thumbs-down"></i>' !!}</td>
                <td>{{$model->priority}}</td>
                <td>{{$model->name}}</td>
                <td>@if($model->image)<img src="{{$model->image}}" style="max-height: 50px;max-width: 50px;">@endif</td>
                <td class="text-center">
                    <a href="{{route('channel.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection


@section('js')
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
        initTable();

    </script>
@endsection
