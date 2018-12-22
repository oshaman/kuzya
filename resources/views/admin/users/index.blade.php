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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admins.all_users')}}</h3>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-app">
            {{--<span class="badge bg-aqua">12</span>--}}
            <i class="fa fa-birthday-cake"></i> @lang('admins.create')
        </a>


        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>E-mail</th>
                    <th>@lang('admins.name')</th>
                    <th>{{trans('admins.user_date')}}</th>
                    <th>{{trans('admins.actions')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil" title="{{trans('admins.edit')}}"></a>
                            {{Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete'])}}
                            <button onclick="return confirm('{{trans('admins.sure')}}')" type="submit" class="delete"  title="@lang('admins.destroy')">
                                <i class="fa fa-trash-o"></i>
                            </button>
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