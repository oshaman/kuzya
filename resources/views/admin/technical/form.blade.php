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

        {!! Form::model($model,['url'=>route('technical.update',$model->id),'method'=>'PUT','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="name_ru">@lang('admins.title')</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'title'])
                @endforeach
            </div>
            {{--<div class="pad form-group">--}}
                {{--{!! Form::label('slug',Lang::get('admins.alias')) !!}--}}
                {{--{!! Form::text('slug',null,['class'=>'form-control']) !!}--}}
            {{--</div>--}}
            <div class="pad form-group localize">
                <label for="name_ru">Содержимое</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.textarea_lang',['field_name'=>'content','class_ex'=>'my-editor'])
                @endforeach
            </div>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="active"
                           class="minimal"
                           value="1"
                            {{ $model->active?'checked':'' }}>
                    Вкл\Выкл
                </label>
            </div>

            <div class="pad form-group">
                <label for="image">Изображение</label>
                <a id="lfm" data-input="thumbnail" data-preview="holder">
                    <img id="holder" class="img-fluid" style="min-height:50px;min-width:50px;max-height:100px;background-color:lightgrey;" src="{{$model->image}}">
                </a>
                <input id="thumbnail" class="form-control" type="text" name="image" value="{{$model->image}}">
            </div>

            <div class="pad form-group">
                <label for="background">Фон</label>
                <a id="background" data-input="thumbnail_background" data-preview="holder_background">
                    <img id="holder_background" class="img-fluid" style="min-height:50px;min-width:50px;max-height:100px;background-color:lightgrey;" src="{{$model->background}}">
                </a>
                <input id="thumbnail_background" class="form-control" type="text" name="background" value="{{$model->background}}">
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

@section('css')
    @parent
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/iCheck/all.css')}}">
@endsection
@section('js')
    @parent
    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#background').filemanager('image');
    </script>
    <script>
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
    </script>
@stop


