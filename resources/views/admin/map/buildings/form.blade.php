<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 12:23
 */

/**
 * @var \App\Models\Building $model
 */
$points = old('points', $model->points) ?? [];
?>

@extends('layouts.admin_form')

@section('title',$title)
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{$title}}</h3>
            @include('admin.locale_inputs.lang_menu_switch')
        </div>

        {!! Form::model($model,['url'=>route('buildings.'.($model->id ?'update':'store'),$model->id),'method'=>$model->id ?'PUT':'POST','class'=>'']) !!}
        {{Form::hidden('user_id', null)}}
        <div class="box-body">
            <div class="pad form-group localize">
                <label for="name_ru">Name</label>
                @foreach(\App\Http\Middleware\Locale::$languages as $lang)
                    @include('admin.locale_inputs.input_lang',['field_name'=>'name'])
                @endforeach
            </div>

            <div class="pad form-group">
                <label for="raw">RAW</label>
                <input class="form-control" type="text" id="raw" name="raw"
                       value="{{old('raw', join(' ', array_map(function($el){return join(',',array_reverse($el));},$points)))}}">
            </div>


            <div class="pad form-group">
                @if($points)
                    @foreach($points as $point)
                        @include('admin.map.buildings.point', ['index' => $loop->index,'last'=>$loop->last])
                    @endforeach
                    <button class="add-new" type="button">+</button>
                @else
                    @for ($i = 0; $i < 4; $i++)
                        @include('admin.map.buildings.point', ['index' => $i])
                    @endfor
                    <button class="add-new" type="button">+</button>
                @endif
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
    <script>


        var num_item = 0;
        $('.delete-this').css({'display':'none'});
        $('.add-new').click(function (e) {
            e.preventDefault(e);
            var length_item =  $('.form-group .item').length;

            if (20 > length_item) {
                length_item++;
                let sum = num_item + length_item;
                $('<div class="item point">' +
                    '<p>точка ' + sum + '</p>' +
                    '<label>X<br>' +
                    '<input type="text" name="points[' + length_item + '][pointX]" value="" style="padding: 6px 12px; margin: 0 3px 0 0px;">' +
                    '</label>' +
                    '<label>Y<br>' +
                    '<input type="text" name="points[' + length_item + '][pointY]" value="" style="padding: 6px 11px; margin: 0 2px 0 0">' +
                    '</label>' +
                    '<button class="delete-this" type="button" style="border: 1px solid red;">-</button>' +
                    '</div>'
                ).insertBefore(this);

                if (20 <= length_item) this.remove();
            } else {
                this.remove();
            }

            $('.delete-this').on('click', function () {
                $(this).parent().remove()
                $('.form-group .item').last().find('.delete-this').css({'display':'inline-flex'})
            })

            $('.form-group .item').each(function () {
                $('.delete-this').css({'display':'none'});
                $('.form-group .item').last().find('.delete-this').css({'display':'inline-flex'})
            });


        });


        $('.form-group .item').each(function () {
            $('.form-group .item').last().find('.delete-this').css({'display':'inline-flex'})
        });

        $('.delete-this').on('click', function () {
            $(this).parent().remove()
            $('.form-group .item').last().find('.delete-this').css({'display':'inline-flex'})
        });


    </script>
    <script src="{{asset('/assets/js/map_form.js')}}"></script>
@stop
