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
        {!! Form::open(['url'=>route('callbacks.update', $callback->id), 'class'=>'contact-form', 'method'=>'put']) !!}
        <div class="box-body">

            <div class="form-group">
                {!! Form::label('email', trans('admins.email')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {!! Form::email('email', $callback->email, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>trans('admins.enter_email')]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('copies', trans('admins.copies')) !!}
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {!! Form::text('copies', $callback->copies, ['class'=>'form-control', 'placeholder'=>trans('admins.enter_email')]) !!}
                </div>
            </div>


        </div>
        <!-- Submit -->
        <div class="box-footer">
            {!! Form::button(trans('admins.save'), ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('js')

@endsection
