<?php
/**
 * @var \App\Models\Article[] $newss
 */
?>
@extends('layouts.front')

@section('content')
    <main>
        <div class="page-header">
            <h1>{{$model->name}}</h1>
        </div>
        <div class="container">
            <div class="stock-row">
                @foreach($newss as $news)
                    <div class="stock-item">
                        <div class="stock-news-row">
                            <div class="stock-news">
                                <p>{{$model->name}}</p>
                            </div>
                            <img src="{{$news->image}}" alt="{{$news->name}}">
                        </div>
                        <h3>{{$news->name}}</h3>
                        <p class="stock-data">{{$news->date_in->format('d.m.Y')}}</p>
                        <p>{!! str_limit(strip_tags($news->content),250,'...') !!}</p>
                        <a href="{{route('news-page',$news->slug)}}">@lang('site.more_')</a>
                    </div>
                @endforeach
            </div>
            <div class="stock-container">
                {{ $newss->links() }}
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