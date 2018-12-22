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
        {!! Form::open(['url'=>route('buttons.update', $button->id), 'class'=>'contact-form', 'method'=>'put']) !!}
        <div class="box-body">

            <div class="col-lg-6">
                {{ Form::label('link', 'Ссылка') }}
                <div>
                    {{Form::text('link', $button->link, ['class'=>'minimal'])}}
                </div>
            </div>

            <div class="col-lg-6">
                {{ Form::label('approved', 'Опубликовать') }}
                <div>
                    {{Form::checkbox('approved', true, $button->approved, ['class'=>'minimal'])}}
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
