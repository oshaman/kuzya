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

        {!! Form::model($model,['url'=>route('advantage.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="name_ru">Name</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                @endforeach
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="in_main"
                           class="minimal"
                           value="1"
                            {{ $model->in_main?'checked':'' }}>
                    на главной
                </label>
            </div>            <div class="checkbox">
                <label>
                    <input type="checkbox" name="in_internet"
                           class="minimal"
                           value="1"
                            {{ $model->in_internet?'checked':'' }}>
                    на странице интернета
                </label>
            </div>            <div class="checkbox">
                <label>
                    <input type="checkbox" name="in_about"
                           class="minimal"
                           value="1"
                            {{ $model->in_about?'checked':'' }}>
                    на странице о нас
                </label>
            </div>
            <div class="pad form-group">
                <label for="lfm">@lang('admins.image')</label>
                <a id="lfm" data-input="thumbnail" data-preview="holder"  >
                    <img id="holder"  class="img-bordered-sm" style="max-height: 50px;max-width: 50px;background-color: cadetblue" src="{{$model->image}}">
                </a>
                <input id="thumbnail" class="form-control" type="text" name="image" value="{{$model->image}}">
            </div>
            <div class="pad form-group">
                <label for="lfm_dark">@lang('admins.image_dark')</label>
                <a id="lfm_dark" data-input="thumbnail_dark" data-preview="holder_dark"  >
                    <img id="holder_dark"  class="img-bordered-sm" style="max-height: 50px;max-width: 50px;background-color: cadetblue" src="{{$model->image_dark}}">
                </a>
                <input id="thumbnail_dark" class="form-control" type="text" name="image_dark" value="{{$model->image_dark}}">
            </div>
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
    <script>
        $('#lfm').filemanager('image');
        $('#lfm_dark').filemanager('image');
    </script>
@stop


