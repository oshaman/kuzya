<?php
/**
 * @var \App\Models\Stock[] $stocks
 */
?>
@extends('layouts.front')
@section('css')
    @parent
    <link rel="stylesheet" href="{{asset('/assets/css/pagination.css')}}">
@endsection
@section('content')
    <main>
        <div class="page-header">
            <h1>{{$model->name}}</h1>
        </div>
        <div class="container">
            <div class="stock-row">
                @foreach($stocks as $stock)
                    <div class="stock-item">
                        <div class="stock-news-row">
                            <div class="stock-news">
                                <p>{{$model->name}}</p>
                            </div>
                            <img src="{{$stock->image}}" alt="{{$stock->name}}">
                        </div>
                        <h3>{{$stock->name}}</h3>
                        <p class="stock-data">{{$stock->date_in->format('d.m.Y')}}</p>
                        <p>{{strip_tags($stock->content)}}</p>
                        <a href="{{route('stock-page',$stock->slug)}}">@lang('site.more_')</a>
                    </div>
                @endforeach
            </div>
            <div class="stock-container">
                {{ $stocks->links() }}
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
        $(document).ready(function () {
            /*
            $('#pagination-demo').twbsPagination({
                totalPages: 5,
// the current page that show on start
                startPage: 1,

// maximum visible pages
                visiblePages: 4,

                initiateStartPageClick: true,

// template for pagination links
                href: false,

                // hrefVariable: '',

// Text labels
                first: 'Первый',
                prev: '<',
                next: '>',
                last: 'Последний',

// carousel-style pagination
                loop: false,

// callback function
                onPageClick: function (event, page) {
                    $('.pages-active').removeClass('pages-active');
                    $('#page' + page).addClass('pages-active');
                },

// pagination Classes
                paginationClass: 'pagination',
                nextClass: 'next',
                prevClass: 'prev',
                lastClass: 'last',
                firstClass: 'first',
                pageClass: 'page',
                activeClass: 'active',
                disabledClass: 'disabled'
            });
            */
        });
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
