<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 11:06
 */

/**
 * @var \App\Models\Question[] $models
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
    <a href="{{route('questions.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add') @lang('admins.question')</button>
    </a>
    <table class="example2 table table-bordered table-hover categorys">
        <thead>
        <tr>
            <th>#</th>
            <th>@lang('admins.priority')</th>
            <th>@lang('admins.status')</th>
            <th>@lang('admins.question')</th>
            <th>@lang('admins.answer')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </thead>
        @foreach($models as $model)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$model->priority??0}}</td>
                <td>{!! $model->active ? '<i class="fa fa-thumbs-o-up"></i>' : '<i class="fa fa-thumbs-down"></i>' !!}</td>
                <td>{{$model->question}}</td>
                <td>{{str_limit($model->answer,200)}}</td>
                <td class="text-center">
                    <a href="{{route('questions.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
                <td class="text-center">
                    <a class="text-red btn btn-link  btn-destr"
                       data-url="{{route('questions.destroy',$model->id)}}">@lang('admins.destroy')</a>
                </td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>@lang('admins.question')</th>
            <th>@lang('admins.answer')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </tfoot>
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
