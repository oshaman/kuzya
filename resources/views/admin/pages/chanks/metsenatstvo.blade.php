<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 16.07.2018
 * Time: 14:10
 */
$languages = \App\Http\Middleware\Locale::$languages;
?>
@extends('admin.pages.form')

@section('inner')
    <div class="pad form-group localize">
        @foreach($languages as $lang)
            <div data-lang="{{$lang}}" id="attr-title_2" {{$loop->first?'class=active':'style=display:none;'}}>
                <label for="attr_{{$lang}}[title_2]">Заголовок "Помимо"</label>
                <input type="text" class="form-control" name="attr_{{$lang}}[title_2]"
                       id="attr_{{$lang}}[title_2]"
                       value="{{json_decode($model->{'attr_'.$lang})->title_2??''}}">
            </div>
        @endforeach
    </div>
    <div class="pad form-group localize">
        @foreach($languages as $lang)
            <div data-lang="{{$lang}}" id="attr-text" {{$loop->first?'class=active':'style=display:none;'}}>
                <label for="attr_{{$lang}}[text]">Текст "Помимо"</label>
                <textarea type="textarea" class="form-control my-editor" name="attr_{{$lang}}[text]"
                          id="attr_{{$lang}}[text]">
                          {{json_decode($model->{'attr_'.$lang})->text??''}}</textarea>
            </div>
        @endforeach
    </div>
    <div class="pad form-group">
        <div class="h3">Слайдер</div>
        <div class=" slider-row">
            @php
                $slides = collect(json_decode($model->attr_ru)->slider??['']);
                $slides = $slides->sortBy('priority');
            @endphp
            @foreach($slides as $slide)
                @include('admin.pages.chanks.slider_item',['slide'=>$slide])
            @endforeach
            <div class="small-box">
                <div class="icon"><i class="ion ion-android-add-circle add-desc"></i></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="pad form-group localize">
        <div class="h3">Преймущества</div>
        @foreach(\App\Http\Middleware\Locale::$languages as $lang)
            <div data-lang="{{$lang}}" id="attr-advert" {{$loop->first?'class=active':'style=display:none;'}}>
                @foreach(json_decode($model->{'attr_'.$lang})->advert??[''] as $advert)
                    @include('admin.pages.chanks.advert_item',['advert'=>$advert,'lang'=>$lang])
                @endforeach
                <div class="small-box">
                    <div class="icon"><i class="ion ion-android-add-circle add-advert"></i></div>
                </div>
                <div class="clearfix"></div>
            </div>
        @endforeach
    </div>
    <div class="pad form-group localize">
        @foreach($languages as $lang)
            <div data-lang="{{$lang}}" id="attr-footer_text" {{$loop->first?'class=active':'style=display:none;'}}>
                <label for="attr_{{$lang}}[footer_text]">Текст внизу страницы</label>
                <textarea type="textarea" class="form-control my-editor" name="attr_{{$lang}}[footer_text]"
                          id="attr_{{$lang}}[footer_text]">
                          {{json_decode($model->{'attr_'.$lang})->footer_text??''}}</textarea>
            </div>
        @endforeach
    </div>
@endsection

@section('css')
    @parent
@stop
@section('js')
    @parent
    <script>
        function addDesc() {
            const count = $('.slider-row .desc').length;
            var desc = $('.slider-row .desc:first-of-type').clone();
            desc.html(desc.html().replace(/\[0\]/gm, '[' + count + ']'));
            desc.html(desc.html().replace(/_0/gm, '_' + count));
            desc.find('.rem-desc').on('click', function () {
                $(this).parents('.small-box').remove();
            });
            desc.insertBefore($(this).parents('.small-box'));
            $('#lfm_' + count).filemanager('image');
        }

        $('.add-desc').on('click', addDesc);
        $('.add-advert').on('click', addAdvert);

        $('.rem-desc').on('click', function () {
            $(this).parents('.small-box').remove();
        });

        function addAdvert() {
            const advercount = $('#attr-advert.active .desc').length;
            var adver = $('#attr-advert.active .desc:first-of-type').clone();
            adver.html(adver.html().replace(/\[0\]/gm, '[' + advercount + ']'));
            adver.html(adver.html().replace(/_0/gm, '_' + advercount));
            adver.find('.rem-desc').on('click', function () {
                $(this).parents('.small-box').remove();
            });
            adver.insertBefore($(this).parents('.small-box'));
            $('#lfm_advert_' + advercount).filemanager('image');
        }
    </script>
@stop
