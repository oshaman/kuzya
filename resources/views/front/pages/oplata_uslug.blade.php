@extends('layouts.front')

@section('content')
    <main>
        <div class="page-header">
            <h1>{{$model->title}}</h1>
        </div>
        <div class="container">
            <div class="kyzya">
                <img alt="" src="/assets/images/kyzya.svg" width="175">
                <h2>@lang('site.pay_variant')</h2>
                {!! $model->content ?? __('site.pay_variant_desc')!!}
            </div>
            <div class="pay-container">
                <div class="pay">
                    <div class="pay-row">
                        <h2>@lang('site.terminal')</h2>
                        <p>
                            @lang('site.terminal_desc')
                        </p>
                        <div class="pay-item">
                            <a href="http://map.city24.kiev.ua/" target="_blank">
                                <img src="/assets/images/pay-sity24.png" alt="">
                            </a>
                            <a href="https://pay.ibox.ua/" target="_blank">
                                <img src="/assets/images/pay-ibox.png" alt="">
                            </a>
                            <a href="http://24nonstop.com.ua/Customers/TerminalMap/0" target="_blank">
                                <img src="/assets/images/pay-non-stop.png" alt="">
                            </a>
                            <a href="https://tyme.ua/ru/clients/where/" target="_blank">
                                <img src="/assets/images/pay-tyme.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="pay-row">
                        <h2>@lang('site.online')</h2>
                        <p>
                            @lang('site.online_desc')
                        </p>
                        <div class="pay-item">
                            <a href="https://www.portmone.com.ua/r3/uk/" target="_blank">
                                <img src="/assets/images/pay-portmone.png" alt="">
                            </a>
                            <a href="https://www.plategka.com/en/internet/" target="_blank">
                                <img src="/assets/images/plateka.jpg" alt="">
                            </a>
                            <a href="https://tachcard.com/ua" target="_blank">
                                <img src="/assets/images/pay-tachcard.png" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pay">
                    <h2>@lang('site.bank')</h2>
                    <p>
                        @lang('site.bank_desc')
                    </p>
                    <div class="bank-datails">
                        {!! $model->footertext ?? '' !!}
                    </div>
                    <p class="silver-italic">
                        @lang('site.bank_footer')
                    </p>
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