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
            <div class="connection">
                <div class="connection-row">
                    <div class="connection-column">
                        <img src="assets/images/kuzia-test.svg" alt="" height="100" width="100">
                        <h2>@lang('site.site.connect')</h2>
                    </div>
                    <div class="connection-column">
                        {!! $model->content !!}
                    </div>
                </div>
                <div class="connection-row after_form">
                    <form action="{{route('footer.send')}}" method="post" class="footer-form">
                        <input type="hidden" name="link" value="{{url()->current()}}">
                        <input type="hidden" name="title" value="{{$model->name??''}}">
                        <input type="text" name="name" placeholder="@lang('site.name')"
                               {{--pattern="^[( )\w.,]+$u"--}} required>
                        <input id="house" type="text" name="house" placeholder="@lang('site.house')"
                               {{--pattern="^[( )\w.,]+$u"--}} required>
                        <input id="street" type="text" name="street" placeholder="@lang('site.street')"
                               {{--pattern="^[( )\w.,]+$u"--}} required>
                        <input type="text" name="email" placeholder="E-mail"
                               {{--pattern="[\+()]*(?:\d[\s\-\.()xX]*){10,14}"--}} required>
                        <input type="submit" value="@lang('site.form_send')">
                    </form>
                </div>
            </div>
        </div>
        {{--<div class="page-end">--}}
            {{--@include('front.chanks.page_end')--}}
        {{--</div>--}}
    </main>
@stop



@section('js')
    @parent

    <script>
        var key_storage = localStorage.getItem('selected_street');
        console.log(key_storage);
        var street_for_form = key_storage.split(',')[1];
         var house_for_form = key_storage.split(',')[2];

        $('.after_form').find('#street').val(street_for_form);
        $('.after_form').find('#house').val(house_for_form);


    </script>

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