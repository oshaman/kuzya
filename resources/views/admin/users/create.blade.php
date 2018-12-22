<?php

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
    <div class="box box-primary">
        {!! Form::open(['url'=>route('users.store'), 'class'=>'contact-form', 'method'=>'post']) !!}
        <div class="box-body">

            <div class="form-group">
                {!! Form::label('name', trans('admins.name')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    {!! Form::text('name', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>trans('admins.enter_name')]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('email', trans('admins.email')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {!! Form::email('email', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>trans('admins.enter_email')]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('password', trans('admins.password')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    {!! Form::password('password', ['class'=>'form-control', 'required'=>'required', 'placeholder'=>trans('admins.enter_password')]) !!}
                </div>
            </div>
        </div>
        <!-- Submit -->
        <div class="box-footer">
            {!! Form::button(trans('admins.add'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('js')

@endsection
