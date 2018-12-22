<?php
/**
 * Created by PhpStorm.
 * User: sergsova
 * Date: 25.09.18
 * Time: 9:21
 */
?>
@extends('admin.pages.form')

@section('sub_content')
    <div class="pad">
        <div class="h2">@lang('menu.buildings')</div>
        <div class="buildings-wrapp"></div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        //iCheck for checkbox and radio inputs
        var table;

        function initTable() {
            table = $('.example2').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
        }

        $(function () {
            $.get({
                url: '{{route('buildings.index')}}',
                success: function (resp) {
                    $('.buildings-wrapp').html($(resp).find('.content').html());
                    initTable();
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
                }
            });
        });

    </script>


@endsection
