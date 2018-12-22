<?php

?>
@extends('adminlte::page')

@section('css')
    @parent
    <style>
        table.table form{display: inline-block;}button.delete{background: transparent;border: none;color: #337ab7;padding: 0px;}td .fa:before{font-size: 20px !important; margin-left: 10px;}
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
            <h3 class="box-title">{{trans('admins.callbacks')}}</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>--</th>
                    <th>E-mail</th>
                    <th>CC</th>
                    <th>{{trans('admins.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($callbacks as $callback)
                    <tr>
                        <td>{{$callback->id}}</td>
                        <td>{{$callback->name}}</td>
                        <td>{{$callback->email}}</td>
                        <td>{{$callback->copies}}</td>
                        <td>
                            <a href="{{route('callbacks.edit', $callback->id)}}" class="fa fa-pencil" title="{{trans('admins.edit')}}"></a>
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