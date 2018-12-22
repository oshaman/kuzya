<?php
/**
 * @var \App\Models\StaticPages $model
 */

use App\Models\Advantages;

/** @var Advantages[] $advantages */
$advantages = Advantages::query()->where('in_about', 1)->get();
?>

@extends('layouts.front')

@section('title',$model->seo->seo_title??$model->name??'')

@section('content')
    <main>
        <div class="page-header">
            <h1>{{$model->name}}</h1>
        </div>
        <div class="container">
            <div class="kyzya">
                {!! $model->content !!}
            </div>
            <div class="internet-tariffs">
                <div class="advantages-row">
                    @foreach($advantages as $advantage)
                        <div class="advantages-item">
                            <img src="{{$advantage->image_dark}}" alt="{{$advantage->name}}">
                            <p>{{$advantage->name}}</p>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="page-quote">
                {!! $model->footertext??'' !!}
            </div>
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