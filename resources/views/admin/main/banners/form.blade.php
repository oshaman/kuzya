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

        {!! Form::model($model,['url'=>route('banners.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="lfm_ru">Картинка</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    <div data-lang="{{$lang}}" style="{{!$loop->first?"display: none":''}}">
                        <a id="lfm_{{$lang}}" data-input="thumbnail_{{$lang}}" data-preview="holder_{{$lang}}">
                            <img id="holder_{{$lang}}" class="img-bordered-sm"
                                 style="max-height: 150px;max-width: 350px;background-color: cadetblue"
                                 src="{{$model->{'image_'.$lang} }}">
                        </a>
                        <input id="thumbnail_{{$lang}}" class="form-control" type="hidden" name="image_{{$lang}}"
                               value="{{$model->{'image_'.$lang} }}">
                    </div>
                @endforeach
            </div>
            <div class="pad form-group">
                <label for="link">Ссылка</label>
                <input id="link" class="form-control" type="text" name="link" value="{{$model->link}}">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="in_main"
                           class="minimal"
                           value="1"
                            {{ $model->in_main?'checked':'' }}>
                    на главной
                </label>
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
    <script>
        @foreach(\App\Http\Middleware\Locale::$languages as $lang)
            $('#lfm_{{$lang}}').filemanager('image');
        @endforeach
    </script>
@stop


