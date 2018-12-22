<?php

/** @var \App\Models\StaticPages $model */
$model->load('lang');
$attr = json_decode($model->attr) ?? '';
?>
@section('title',$model->seo->seo_title??$model->name)

@extends('layouts.front')

@section('content')
    <main>
        <div class="page-header">
            <h1>{{$model->name}}</h1>
        </div>
        <div class="container">
            {!! $model->content !!}
        </div>
        <div class="philantropy-slider">
            <div class="philantropy-row">
                @php
                    $slides = collect(json_decode($model->attr_ru)->slider??['']);
                    $slides = $slides->sortBy('priority');
                @endphp
                @foreach($slides as $slide)
                    @empty($slide->active)
                        @continue
                    @endempty
                    <div class="philantropy-item" data-img="{{$slide->image}}">
                        <figure><img src="{{$slide->image}}" class="philantropy-image" alt=""></figure>
                        <div class="philantropy-item-title">
                            <p>{{$slide->title??''}}</p>
                        </div>
                        <div class="philantropy-item-address">
                            <p>{{$slide->address??''}}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="container">
            <h2>{{$attr->title_2??''}}</h2>
            <div class="philantropy">
                {!! $attr->text??'' !!}
            </div>
            <div class="internet-tariffs">
                <div class="advantages-row">
                    @foreach($attr->advert??[] as $advert)
                        <div class="advantages-item">
                            <img src="{{$advert->image}}" alt="" width="55" height="58">
                            <p>{{$advert->title}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="page-quote">{!! $attr->footer_text !!}</div>
        </div>

        <div class="page-end">
            @include('front.chanks.page_end')
        </div>

    </main>
@stop
@section('js')
    @parent
    <script type="text/javascript">
        var el1 = $('#error404-eye-left'), eyeBall1 = el1.find('div');
        var el2 = $('#error404-eye-right'), eyeBall2 = el2.find('div');
        el1.show();
        el2.show();
        var x1 = el1.offset().left + 37, y1 = el1.offset().top + 25;
        var r = 10, x, y, x2, y2, isEyeProcessed = false;
        $('html').mousemove(function (e) {
            if (!isEyeProcessed) {
                isEyeProcessed = true;
                var x2 = e.pageX, y2 = e.pageY;
                y = ((r * (y2 - y1)) / Math.sqrt((x2 - x1) * (x2 - x1) + (y2 - y1) * (y2 - y1))) + y1;
                x = (((y - y1) * (x2 - x1)) / (y2 - y1)) + x1;
                eyeBall1.css({
                    marginTop: (y - y1 + 1) + 'px',
                    marginLeft: (x - x1) + 'px'
                });
                eyeBall2.css({
                    marginTop: (y - y1 + 1) + 'px',
                    marginLeft: (x - x1) + 'px'
                });
                isEyeProcessed = false;
            }
        });
    </script>
@endsection