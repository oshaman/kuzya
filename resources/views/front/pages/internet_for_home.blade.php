<?php
/**
 * @var \App\Models\StaticPages $model
 */
?>
@extends('layouts.front')
@section('content')
    <main>
        <div class="internet-header">
            <h1>{{$model->name}}</h1>
        </div>
        <div class="container">
            <div class="tariffs-row">
                @foreach(\App\Models\Tariff::with('lang')->get() as $tariff)
                    @empty($tariff->active)
                        @continue
                    @endempty
                    <div class="tariffs-item item-{{$loop->index}}">
                        <img src="{{$tariff->image}}" alt="">
                        <h3>{{$tariff->name}}</h3>
                        <p>
                            <span class="span-tariffs-price first_price">{{$tariff->price}}</span>
                            <span class="span-tariffs-price second_price"
                                  style="display: none;">{{$tariff->village_price}}</span>
                            @lang('site.hrn_mes')
                        </p>
                        <div class="RadioGroup">
                            @if($tariff->in_apartment)
                                <div class="radio-tariffs">
                                    <input type="radio" name="in_apartment" id="in_apartment{{$loop->index}}1" value="1"
                                           autocomplete="off">
                                    <label for="in_apartment{{$loop->index}}1">{{$tariff->apartment}}</label>
                                </div>
                                <div class="radio-tariffs">
                                    <input type="radio" name="in_apartment" id="in_apartment{{$loop->index}}0"
                                           value="0 "
                                           autocomplete="off">
                                    <label for="in_apartment{{$loop->index}}0">{{$tariff->house}}</label>
                                </div>
                            @else
                                <div class="radio-tariffs">

                                </div>
                            @endif
                            <div class="tariffs1 active" class="desc">
                                @php
                                    $descs = collect(json_decode($tariff->attr)->desc??[]);
                                    $descs = $descs->sortBy('priority');
                                @endphp

                                @foreach($descs as $desc)
                                    <div class="tariffs-content">
                                        <p>
                                            <img src="{{$desc->enable??''?'/assets/images/tariffs-check.png':'/assets/images/remove-symbol.png'}}"
                                                 alt="">{{$desc->name??''}}
                                        </p>
                                        <p>{{$desc->value??''}}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="tariffs2" class="desc">
                                @foreach($descs as $desc)
                                    <div class="tariffs-content">
                                        <p>
                                            <img src="{{$desc->enable??''?'/assets/images/tariffs-check.png':'/assets/images/remove-symbol.png'}}"
                                                 alt="">{{$desc->name??''}}
                                        </p>
                                        <p>{{$desc->value??''}}</p>
                                    </div>
                                @endforeach
                            </div>
                            {{--<div class="tariffs2">
                                <div class="tariffs-content">
                                    <p>
                                        <img src="/assets/images/tariffs-check.png" alt="">Голандия
                                    </p>
                                    <p>1000мб</p>
                                </div>
                                <div class="tariffs-content">
                                    <p>
                                        <img src="/assets/images/remove-symbol.png" alt="">Мир
                                    </p>
                                    <p>20МБ</p>
                                </div>
                                <div class="tariffs-content">
                                    <p>
                                        <img src="/assets/images/tariffs-check.png" alt="">Лимитный тариф
                                    </p>
                                    <p></p>
                                </div>
                                <div class="tariffs-content">
                                    <p>
                                        <img src="/assets/images/remove-symbol.png" alt="">Каналов телевидения
                                    </p>
                                    <p>150</p>
                                </div>
                            </div>--}}
                        </div>
                        <a href="https://kuzia.j2landing.com/connection">@lang('site.connecting')</a>
                    </div>
                @endforeach
            </div>

            {!! $model->content !!}
            <div class="internet-tariffs">
                <div class="advantages">
                    <h1>@lang('site.advantages')</h1>
                    <div class="advantages-row">
                        @foreach(\App\Models\Advantages::all() as $advantage)
                            <div class="advantages-item">
                                <img src="{{$advantage->image_dark}}" alt="{{$advantage->name}}">
                                <p>{{$advantage->name}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <table width="100%">
                <thead>
                <tr>
                    <th>@lang('site.service')</th>
                    <th>@lang('site.price_one')</th>
                    <th>@lang('site.desc_service')</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Models\Service::getAllowed() as $service)
                    <tr>
                        <td>{{$service->name}}</td>
                        <td>{{$service->price}}</td>
                        <td>{{$service->note}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
            $("input[name$='tariffs']").click(function () {
                var test = $(this).val();

                $("div.desc").hide();
                $(".tariffs" + test).show();
            });
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