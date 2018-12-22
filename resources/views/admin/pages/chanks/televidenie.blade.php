<?php
/**
 * Created by PhpStorm.
 * User: sergsova
 * Date: 28.09.18
 * Time: 14:21
 */

/**
 * @var \App\Models\StaticPages $model
 */

foreach (\App\Http\Middleware\Locale::$languages as $lang) {
    $model->{'attrib_' . $lang} = json_decode($model->{'attr_' . $lang});
}
?>

@extends('admin.pages.form')

@section('inner')
    <div class="pad form-group localize">
        <div class="h3">Преймущества</div>
        @foreach(\App\Http\Middleware\Locale::$languages as $lang)
            <div data-lang="{{$lang}}" id="attr-advert" {{$loop->first?'class=active':'style=display:none;'}}>
                @foreach(json_decode($model->{'attr_'.$lang})->advert??[''] as $advert)
                    @include('admin.pages.chanks.advert_item',['advert'=>$advert,'lang'=>$lang])
                @endforeach
                {{--<div class="small-box">--}}
                    {{--<div class="icon"><i class="ion ion-android-add-circle add-advert"></i></div>--}}
                {{--</div>--}}
                <div class="clearfix"></div>
            </div>
        @endforeach
    </div>

@endsection

@section('sub_content')
    <div class="pad">
        <div class="h2">@lang('admins.partitions')</div>
        <div class="categoryi-wrapp"></div>
        <div class="h2">@lang('admins.channels')</div>
        <div class="channels-wrapp"></div>
    </div>
@endsection


@section('js')
    @parent
    <script>
        var table;

        function initTable() {

            table = $('.example2').DataTable({
                'paging': false,
                'lengthChange': true,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
        }

        $(function () {
            $.get({
                url: '{{route('partition.index')}}',
                success: function (resp) {
                    $('.categoryi-wrapp').html($(resp).find('.content').html());
                    $.get({
                        url: '{{route('channel.index')}}',
                        success: function (resp) {
                            $('.channels-wrapp').html($(resp).find('.content').html());
                            initTable();
                        }
                    });
                }
            });
        });

        $('.add-advert').on('click', addAdvert);

        function addAdvert() {
            const advercount = $('#attr-advert.active .desc').length;
            var adver = $('#attr-advert.active .desc:first-of-type').clone();
            adver.html(adver.html().replace(/\[0\]/gm, '[' + advercount + ']'));
            adver.html(adver.html().replace(/_0/gm, '_' + advercount));
            // adver.find('.rem-desc').on('click', function () {
            //     $(this).parents('.small-box').remove();
            // });
            adver.insertBefore($(this).parents('.small-box'));
            $('#lfm_advert_' + advercount).filemanager('image');
        }
    </script>
@endsection
