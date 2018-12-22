<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\Models\Partition $model
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

        {!! Form::model($model,['url'=>route('partition.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="name_ru">Name</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                @endforeach
            </div>
            {{--<div class="pad form-group">--}}
                {{--<label for="slug">{{ucfirst(Lang::get('admins.alias'))}}</label>--}}
                {{--<input type="text" name="slug" class="form-control" id="slug"  value="{{$model->slug??''}}">--}}
            {{--</div>--}}
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
    <script>
        $('#lfm').filemanager('image');
        $('#lfm_dark').filemanager('image');
    </script>
@stop


