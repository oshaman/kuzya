<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\Models\Review $model
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

        {!! Form::model($model,['url'=>route('reviews.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        {{Form::hidden('user_id', null)}}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="name_ru">Name</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                @endforeach
            </div>
            <div class="pad localize">
                <label for="content_ru">Content</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.textarea_lang',['field_name'=>'description','class_ex'=>'my-editor'])
                @endforeach
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="is_visible"
                           class="minimal"
                           value="1"
                            {{ $model->is_visible?'checked':'' }}>
                    Published
                </label>
            </div>
            <div class="pad form-group">
                <a id="lfm" data-input="thumbnail" data-preview="holder"  >
                    <img id="holder"  class="img-fluid" style="min-height:50px;min-width:50px;max-height:100px;background-color:lightgrey;" src="{{$model->image}}">
                </a>
                <input id="thumbnail" class="form-control" type="hidden" name="image" value="{{$model->image}}">
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('js')
    @parent
    <script>$('#lfm').filemanager('image');</script>
@stop


