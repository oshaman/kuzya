<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\Models\Tariff $model
 */
?>

@extends('layouts.admin_form')

@section('title',$title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
            @include('admin.locale_inputs.lang_menu_switch')
        </div>

        {!! Form::model($model,['url'=>route('channel.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group localize">
                <div class="pad form-group">
                    <label for="partition_id">@lang('admins.partition')</label>
                    {!! Form::select('partition_id',$partitions,$model->partition_id??null,['class'=>'form-control','placeholder'=>Lang::get('admins.select').' '.Lang::get('admins.partition')]) !!}
                </div>
                <label for="name_ru">Имя</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                @endforeach
            </div>
            <div class="pad form-group">
                <a id="lfm" data-input="thumbnail" data-preview="holder">
                    <img id="holder" class="img-fluid" style="min-height:50px;min-width:50px;max-height:100px;background-color:lightgrey;" src="{{$model->image}}">
                </a>
                <input id="thumbnail" class="form-control" type="text" name="image" value="{{$model->image}}">
            </div>

            @include('admin.pages.chanks.sub_chanks.active_ratio')
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
        <a href="{{ URL::previous() }}" class="btn btn-warning">Cancel</a>
    </div>
@stop

@section('js')
    @parent
    <script>$('#lfm').filemanager('image');</script>
@stop


