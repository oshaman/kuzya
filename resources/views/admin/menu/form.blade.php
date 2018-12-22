<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

use App\Models\Menu;

/**
 * @var \App\Models\Menu          $model
 * @var \App\Models\StaticPages[] $pages
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


        {!! Form::model($model,['url'=>route('menus.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}

        <div class="box-body">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Page</label>
                    <select name="static_id" class="form-control select2">
                        <option value="">Empty</option>
                        @foreach($pages as $page)
                            @if($page->menu()->count())
                                @if($model->static_id==$page->id)
                                    <option selected="selected" value="{{$page->id}}">{{$page->name}}</option>
                                @else
                                    <option disabled="disabled" value="{{$page->id}}">{{$page->name}}</option>
                                @endif
                            @else
                                <option value="{{$page->id}}">{{$page->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Parent</label>
                    <select name="parent_id" class="form-control select2">
                        <option value="">Empty</option>
                        @foreach($parents as $menu)
                            @if($model->parent_id == $menu->id)
                                <option selected="selected" value="{{$menu->id}}">{{$menu->name}}</option>
                            @else
                                <option value="{{$menu->id}}">{{$menu->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group localize">
                    <label for="exampleInputName1">Name</label>
                    @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                        @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="Alias">Alias</label>
                    <input type="text" name="slug" class="form-control" id="Alias" placeholder="Enter slug" value="{{$model->slug??''}}">
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputLink1">Link</label>
                    <input type="text" name="menu_link" class="form-control" id="exampleInputLink1" placeholder="Enter link" value="{{$model->menu_link??''}}">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            {{ Form::label('priority', 'Приоритет(0-100)') }}
            <div>
                {!! Form::number('priority', null , ['id'=>'priority', 'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6">
            {{ Form::label('approved', 'Опубликовать') }}
            <div>
                {{Form::checkbox('approved', true, null, ['class'=>'minimal'])}}
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}

        <a href="{{ route('menus.index') }}" class="btn btn-warning">Cancel</a>
    </div>
@stop

@section('css')
    @parent
    <link rel="stylesheet" href="{{asset('vendor/select2/dist/css/select2.min.css')}}">
@stop
@section('js')
    @parent
    <script src="{{asset('vendor/select2/dist/js/select2.full.min.js')}}"></script>
    <script>
        $('.select2').select2();
    </script>
@stop


