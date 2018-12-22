<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 11.07.2018
 * Time: 16:02
 */

?>

@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{asset('vendor/iCheck/all.css')}}">
@stop
@section('js')
    <script src="{{asset('vendor/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"></script>
    <script>
        var minimal = $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    </script>
    <script src="{{asset('assets/js/tinymce/tinymce.min.js')}}"></script>
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: "textarea.my-editor",
            language: "ru",
            content_css: "{{asset('assets/css/style.css')}}",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            rel_list: [
                {title: 'follow', value: 'follow'},
                {title: 'nofollow', value: 'nofollow'}
            ],
            importcss_file_filter: "",
            importcss_append: true,
            style_formats: [
                /*{
                    title: 'Шаблоны', items: [

                        {title: 'Две колонки', block: 'div', classes: 'blog-two-column', exact: true, wrapper: 1},
                        {title: 'Коментарий', block: 'div', classes: 'quotes', exact: true, wrapper: 0},
                        {title: 'Всторенное видео', block: 'iframe', classes: 'blog-video', exact: true, wrapper: 1},
                    ]
                },*/
            ],
            textcolor_map: [
                '314c9b','Blue',
                'ffd54e', 'Yellow',
                "000000", "Black",
                "808080", "Gray",
                "333333", "Very dark gray",
                "FF0000", "Red",
                "008000", "Green",
                "FFFFFF", "White",
            ],
            templates: [
                /*{
                    title: 'Слайдер',
                    description: 'Место куда будет вставлен слайдер',
                    content: '<div class="slide-insert"><h2 style="color: red">Слайдер</h2></div>'
                },*/
            ],

            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor",
            relative_urls: false,
            file_browser_callback: function (field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
    <script src="{{asset('assets/admin/js/localize.admin.js')}}"></script>
@stop