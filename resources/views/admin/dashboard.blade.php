<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 11:07
 */
?>
@extends('adminlte::page')

@section('title','Welcome '.Auth::user()->name)

@section('content')
    <h1>Hello</h1>
@endsection
