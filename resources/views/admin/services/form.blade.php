<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\Models\Service $model
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

        {!! Form::model($model,['url'=>route('services.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="name_ru">Имя</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                @endforeach
            </div>
            <div class="pad row">
                <div class="col-lg-6 form-group localize">
                    <label for="price_ru">Цена</label>
                    @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                        @include('admin.locale_inputs.input_lang',['field_name'=>'price'])
                    @endforeach
                </div>
                <div class="col-lg-6 form-group localize">
                    <label for="note_ru">Коментарий</label>
                    @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                        @include('admin.locale_inputs.input_lang',['field_name'=>'note'])
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('priority', 'Приоритет(0-100)') }}
            <div>
                {!! Form::number('priority', null , ['id'=>'priority', 'class'=>'form-control']) !!}
            </div>
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
    <script>
        function addDesc() {
            const count = $('#attr-desc.active .desc').length;
            var desc = $('#attr-desc.active .desc:first-of-type').clone();
            desc.html(desc.html().replace(/\[0\]/gm, '[' + count + ']'));
            desc.find('.rem-desc').on('click', function () {
                $(this).parents('.small-box').remove();
            });
            desc.insertBefore($(this).parents('.small-box'));
        }

        $('.add-desc').on('click', addDesc);

        $('.rem-desc').on('click', function () {
            $(this).parents('.small-box').remove();
        });
    </script>
@stop


