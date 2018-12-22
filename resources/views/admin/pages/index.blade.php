<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.06.2018
 * Time: 11:18
 */
/**
 * @var \App\Models\StaticPages[] $models
 */
?>

@extends('adminlte::page')

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
   {{-- <a href="{{route('pages.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add_page')</button>
    </a>--}}
    <table id="example2" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.content')</th>
            <th>@lang('admins.alias')</th>
            <th>@lang('admins.visible')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </thead>
        @foreach($models as $model)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$model->id}}</td>
                <td>{{$model->name}}</td>
                <td>{!! str_limit(strip_tags($model->content),300) !!}</td>
                <td>{{$model->slug}}</td>
                <td>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" data-id="{{$model->id}}"
                                   class="minimal"
                                    {{ $model->published==1?'checked':'' }}>
                        </label>
                    </div>
                </td>
                <td class="text-center">
                    <a href="{{route('pages.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
                <td class="text-center"><a class="text-red btn btn-link  btn-destr"
                                           data-url="{{route('pages.destroy',$model->id)}}">@lang('admins.destroy')</a></td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>#</th>
            <th>@lang('admins.name')</th>
            <th>@lang('admins.content')</th>
            <th>@lang('admins.alias')</th>
            <th>@lang('admins.visible')</th>
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </tfoot>
    </table>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('vendor/iCheck/all.css')}}">
@stop
@section('js')
    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $('#example2').DataTable({
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
        $('.icheckbox_minimal-blue ins').on('click', function () {
            $.post({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/admin/pages/switch-pub/' + $(this).siblings('input[type="checkbox"].minimal').data('id'),
                success: function (resp) {
                    console.log(resp);
                    if (resp == 1) {
                        location.reload();
                    }
                }
            });
        });
    </script>
@endsection