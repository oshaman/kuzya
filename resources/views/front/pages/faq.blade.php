<?php

/**
 * @var \App\Models\StaticPages $model
 */
?>

@extends('layouts.front')

@section('content')
    <main>
        <div class="page-header">
            <h1>{{$model->name}}</h1>
        </div>
        <div class="container">
            <div class="container-acordion">
                <div class="tabs-box">
                    <ul class="tabs">
                        @foreach(\App\Models\Category::all() as $category)
                            <li class="{{$loop->first?'active':($loop->last?'tab_last':'')}}" rel="{{$category->slug}}">{{$category->name}}</li>
                        @endforeach
                    </ul>
                    <div class="tab_container">
                        @foreach(\App\Models\Category::all() as $category)
                            <div class="tab-wrap">
                                <h3 class="{{$loop->first?'d_active':''}} tab_accordion" rel="{{$category->slug}}">{{$category->name}}</h3>
                                <div id="{{$category->slug}}" class="{{$loop->first?'active':''}} tab_content">
                                    <div class="faq">
                                        @foreach($category->questions as $question)
                                            <h2 class="question">{{$question->question}}</h2>
                                            <div class="answer">
                                                {!! $question->answer !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="page-end">
            @include('front.chanks.page_end')
        </div>
    </main>
@stop

@section('js')
    @parent
    <script>
        $(function () {
            $('.answer').css({'display':'none'});

            $('.question').click(function(){
                $('.question').not($(this)).removeClass('open');
                $('.answer').not($(this).next('.answer')).slideUp(500);
                $(this).next('.answer').slideToggle(500);
                $(this).toggleClass('open');
            });
        });


        // вкладки с содержанием
        // http://dbmast.ru
        $(".tab_content").hide();
        $(".tab_content:first").show();
        /* в режиме вкладок */
        $("ul.tabs li").click(function () {
            $(".tab_content").hide();
            var activeTab = $(this).attr("rel");
            $("#" + activeTab).fadeIn();
            $("ul.tabs li").removeClass("active");
            $(this).addClass("active");
            $(".tab_accordion").removeClass("d_active");
            $(".tab_accordion[rel^='" + activeTab + "']").addClass("d_active");
        });
        /* в режиме аккордеона */
        $(".tab_accordion").click(function () {
            $(".tab_content").hide();
            var d_activeTab = $(this).attr("rel");
            $("#" + d_activeTab).fadeIn();
            $(".tab_accordion").removeClass("d_active");
            $(this).addClass("d_active");
            $("ul.tabs li").removeClass("active");
            $("ul.tabs li[rel^='" + d_activeTab + "']").addClass("active");
        });
        /* дополнительный класс tab_last,
        чтобы добавить границу к правой
        стороне последней вкладки. */
        $('ul.tabs li').last().addClass("tab_last");

    </script>
@endsection
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