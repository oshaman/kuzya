<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 11:18
 */
/**
 * @var \App\Models\Menu[] $models
 */
?>

@extends('adminlte::page')

@section('css')
    @parent
    <style>
        .box{
            margin-bottom: 1px;
        }
    </style>
@endsection
@section('content_header')
    @if(Session::has('flash_message'))
        <div class="container">
            <div class="alert alert-success">
                {{Session::get('flash_message')}}
            </div>
        </div>
    @endif
@stop

@section('content')
    <a href="{{route('menus.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add_menu')</button>
    </a>
    @include('admin.menu.chank_submenu1',['models'=>$models->get(),'lvl'=>0])
@endsection
