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

        {!! Form::model($model,['url'=>route('tariffs.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="name_ru">Имя</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                @endforeach
            </div>
            <div class="pad row">
                <div class="col-lg-6 form-group ">
                    <label for="price">Цена в квартире</label>
                    <input type="text" name="price" class="form-control" id="price"
                           value="{{$model->price??'' }}">
                </div>
                <div class="col-lg-6 form-group ">
                    <label for="village_price">Цена в приватном доме</label>
                    <input type="text" name="village_price" class="form-control" id="village_price"
                           value="{{$model->village_price??'' }}">
                </div>
            </div>

            <div class="pad row">
                <div class="col-lg-6 form-group localize">
                    <label for="apartment_ru">Квартира</label>
                    @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                        @include('admin.locale_inputs.input_lang',['field_name'=>'apartment'])
                    @endforeach
                </div>
                <div class="col-lg-6 form-group localize">
                    <label for="house_ru">Дом</label>
                    @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                        @include('admin.locale_inputs.input_lang',['field_name'=>'house'])
                    @endforeach
                </div>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="in_apartment"
                           class="minimal"
                           value="1"
                            {{ $model->in_apartment?'checked':'' }}>
                    Использовать оба варианта
                </label>
            </div>

            <div class="pad form-group localize">
                <label for="attr-desc">Детали</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    <div data-lang="{{$lang}}" id="attr-desc" {{$loop->first?'class=active':'style=display:none;'}}>
                        @foreach(json_decode($model->{'attr_'.$lang})->desc??[''] as $desc)
                            @include('admin.tariffs.desc_item_form',['desc'=>$desc,'lang'=>$lang])
                        @endforeach
                        <div class="small-box">
                            <div class="icon"><i class="ion ion-android-add-circle add-desc"></i></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
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
                <a id="lfm" data-input="thumbnail" data-preview="holder">
                    <img id="holder" class="img-fluid" style="min-height:50px;min-width:50px;max-height:100px;background-color:lightgrey;" src="{{$model->image}}">
                </a>
                <input id="thumbnail" class="form-control" type="text" name="image" value="{{$model->image}}">
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


