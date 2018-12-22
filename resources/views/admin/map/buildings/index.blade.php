<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 11:06
 */
/**
 * @var \App\Models\Building[] $models
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
    <a href="{{route('buildings.create')}}">
        <button class="btn btn-sm btn-primary">@lang('admins.add_building')</button>
    </a>
    <form id="import-csv" action="{{route('buildings.parseCSV')}}" method="post" enctype="multipart/form-data">
        <input type="file" accept="text/csv" name="file_csv" value="{{@old('file_csv')}}">
        <button>Импортировать CSV</button>
    </form>
    <table class="example2 table table-bordered table-hover buildings">
        <thead>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>@lang('admins.name')</th>
            {{--<th>@lang('admins.points')</th>--}}
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </thead>
        @foreach($models as $model)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$model->id}}</td>
                <td>{{$model->name}}</td>
                {{--<td>--}}
                    {{--@foreach($model->points as $point)--}}
                        {{--<p>@lang('admins.point') {{$loop->index}}: {X:{{$point['pointX']}}; Y:{{$point['pointY']}}}</p>--}}
                    {{--@endforeach--}}
                {{--</td>--}}
                <td class="text-center">
                    <a href="{{route('buildings.edit',$model->id)}}"
                       class="text-info btn btn-link">@lang('admins.edit')</a>
                </td>
                <td class="text-center"><a class="text-red btn btn-link  btn-destr"
                                           data-url="{{route('buildings.destroy',$model->id)}}">@lang('admins.destroy')</a>
                </td>
            </tr>
        @endforeach
        <tfoot>
        <tr>
            <th>#</th>
            <th>Id</th>
            <th>@lang('admins.name')</th>
            {{--<th>@lang('admins.points')</th>--}}
            <th class="text-center">@lang('admins.edit')</th>
            <th class="text-center">@lang('admins.destroy')</th>
        </tr>
        </tfoot>
    </table>
@endsection

@section('js')
    <script>
        $('.example2').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    </script>

    <script>
        $(function () {
            //init form ajax import csv
            $('#import-csv').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.post({
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false

                }).done(function(data){
                    location.reload();
                });
            });
            //end init form import csv
        });
    </script>

@endsection
