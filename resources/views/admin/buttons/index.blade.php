<?php

?>
@extends('adminlte::page')

@section('css')
    @parent
    <style>
        table.table form {
            display: inline-block;
        }

        button.delete {
            background: transparent;
            border: none;
            color: #337ab7;
            padding: 0px;
        }

        td .fa:before {
            font-size: 20px !important;
            margin-left: 10px;
        }
    </style>
@endsection
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
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">{{trans('admins.buttons')}}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Link</th>
                    <th>{{trans('admins.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($buttons as $button)
                    <tr>
                        <td>{{$button->id}}</td>
                        <td>{{$button->title}}</td>
                        <td>{{$button->link}}</td>
                        <td>
                            <a href="{{route('buttons.edit', $button->id)}}" class="fa fa-pencil"
                               title="{{trans('admins.edit')}}"></a>
                            {{Form::close()}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('js')

@endsection