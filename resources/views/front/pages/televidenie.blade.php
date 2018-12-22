<?php
/**
 * @var \App\Models\StaticPages $model
 */

$model->attrib = json_decode($model->attr);

?>
@extends('layouts.front')

@section('content')
    <main>
        <div class="page-header">
            <h1>{{$model->name}}</h1>
        </div>
        <div class="container">
            <div class="tv-slider">
                <div class="tv-slider-text">
                    <div class="tv-block">
                        <h3>IPV6</h3>
                        <p>Кузя совместно с партнером , предлагает 150 каналов цифрового телевидения в формате IPTV.
                            IPTV – это цифровое интерактивное телевидение с помощью которого у Вас есть возможность
                            просматривать
                            любимые телепередачи на телевизоре, на компьютере, на планшете и даже на смартфоне.</p>
                        <a href="">Скачать плеер</a>
                    </div>
                    <img src="/assets/images/TV.png" alt="">

                </div>
                <div class="tv-slider-text">
                    <div class="tv-block">
                        <h3>IPV6</h3>S
                        <p>Кузя совместно с партнером , предлагает 150 каналов цифрового телевидения в формате IPTV.
                            IPTV – это цифровое интерактивное телевидение с помощью которого у Вас есть возможность
                            просматривать
                            любимые телепередачи на телевизоре, на компьютере, на планшете и даже на смартфоне.</p>
                        <a href="">Скачать плеер</a>
                    </div>
                    <img src="/assets/images/TV.png" alt="">
                </div>
                <div class="tv-slider-text">
                    <div class="tv-block">
                        <h3>IPV6</h3>
                        <p>Кузя совместно с партнером , предлагает 150 каналов цифрового телевидения в формате IPTV.
                            IPTV – это цифровое интерактивное телевидение с помощью которого у Вас есть возможность
                            просматривать
                            любимые телепередачи на телевизоре, на компьютере, на планшете и даже на смартфоне.</p>
                        <a href="">Скачать плеер</a>
                    </div>
                    <img src="/assets/images/TV.png" alt="">
                </div>
                <div class="tv-slider-text">
                    <div class="tv-block">
                        <h3>IPV6</h3>
                        <p>Кузя совместно с партнером , предлагает 150 каналов цифрового телевидения в формате IPTV.
                            IPTV – это цифровое интерактивное телевидение с помощью которого у Вас есть возможность
                            просматривать
                            любимые телепередачи на телевизоре, на компьютере, на планшете и даже на смартфоне.</p>
                        <a href="">Скачать плеер</a>
                    </div>
                    <img src="/assets/images/TV.png" alt="">
                </div>
            </div>


            <div class="tv">
                <div class="tv-rows">
                    @foreach($model->attrib->advert??[] as $advert)
                        <div class="tv-advantages">
                            <img src="{{$advert->image}}" alt="">
                            <p>{{$advert->title}}</p>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="tv2">
                <h2>@lang('site.channel_provider')</h2>

                @forelse ($partitions as $partition)
                    <button class="tv-button">{{ $partition->name }}</button>
                    <div class="tv-row">
                        @forelse ($partition->channels as $channel)

                            <div class="tv-item">
                                <img src="{{ $channel->image }}" alt="" height="75">
                                <p>{{ $channel->name }}</p>
                            </div>
                        @empty

                        @endforelse
                    </div>
                @empty

                @endforelse
            </div>
        </div>
        <div class="page-end">
            @include('front.chanks.page_end')
        </div>
    </main>
@stop
