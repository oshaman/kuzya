<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\Models\StaticPages $model
 */

$languages = \App\Http\Middleware\Locale::$languages;
?>

@extends('layouts.admin_form')

@section('title',$title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
            @include('admin.locale_inputs.lang_menu_switch')

            <a href="{{route('pages.show', $model->id)}}" class="btn btn-primary" target="_blank">Preview</a>
        </div>

        {!! Form::model($model,['url'=>route('pages.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}

        <div class="box-body">
            <div class="pad form-group localize">
                <label for="name_ru">@lang('admins.name')</label>
                @foreach($languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                @endforeach
            </div>
            <div class="pad row">
                <div class="col-lg-6 col-md-6 form-group">
                    <label for="Alias">@lang('admins.alias')</label>
                    <input type="text" name="slug" class="form-control" id="Alias" placeholder="Enter slug"
                           value="{{old('slug', $model->slug)}}">
                </div>
                <div class="col-lg-6 col-md-6 form-group" style="display: none;">
                    <label for="template">@lang('admins.template')</label>
                    <small class="text-aqua"> *ИМЯ*.blade.php</small>
                    <input type="text" name="template" class="form-control" id="template" placeholder="Enter template"
                           value="{{$model->template??''}}">
                </div>
            </div>
            <div class="pad localize">
                <label for="content_ru">@lang('admins.content')</label>
                @foreach($languages as $lang)
                    @include('admin.locale_inputs.textarea_lang',['field_name'=>'content','class_ex'=>'my-editor'])
                @endforeach
            </div>
            @yield('inner','')
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="published"
                           class="minimal"
                           value="1"
                            {{ $model->published?'checked':'' }}>
                    Published
                </label>
            </div>

            <div class="pad form-group localize">
                <label for="accordionSEO_ru">SEO</label>
                @foreach($languages as $lang)
                    @include('admin.seo_form',['lang'=>$lang,'index'=>$lang])
                @endforeach
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
    @yield('sub_content','')
@stop

@section('js')
    @parent
    <script>$('#lfm').filemanager('image');</script>
@stop


