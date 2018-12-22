<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 25.07.2018
 * Time: 13:49
 */
/**
 * @var \App\Models\Article $model
 */
?>
@extends('layouts.front')
@section('content')
    <main>
        <div class="page-header">
          
            <h1>@lang('admins.stocks')</h1>
        </div>
        <div class="container">
            <div class="stock-page">
                <div class="stock-page-row">
                    <h1>{{$model->name}}</h1>
                    <img src="{{$model->image}}" alt="{{$model->name}}" width="auto" height="300">
                    <p class="stock-data">{{$model->date_in->format('d.m.Y')}}</p>
                    <div class="">
                        {!! $model->content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="page-end">
            @include('front.chanks.page_end')
        </div>
    </main>
@stop

