@extends('layouts.front')

@section('content')
    <main>
        <div class="slider">
            <div class="slider-row">
                @foreach($banners as $banner)
                    <div class="slider_item">
                        <div class="wrap_slide">
                            <div class="slider_item_img">
                                <img src="{{$banner->image}}" alt="" width="850" height="300">
                                <div class="slider_item_btn">
                                    <a @if($banner->link)href="{{$banner->link}}" @endif class="slider-button">Заказать</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="slider-form">
                <h1 class="form-h1">@lang('site.request_connection')</h1>

                <form action="{{route('main-mail')}}" method="post" class="footer-form">
                    <input type="hidden" name="subject" value="@lang('site.request_connection')">
                    <input type="hidden" name="link" value="{{url()->current()}}">
                    <input type="hidden" name="title" value="{{$model->name??''}}">
                    <p>@lang('site.name') <input type="text" name="name" placeholder="@lang('site.name')" required></p>
                    <p>@lang('site.address') <input type="text" name="address" placeholder="@lang('site.address')" required></p>
                    <p>@lang('site.phone') <input type="tel" class="phones" autocomplete="none" name="phone" placeholder="@lang('site.phone')" required></p>
                    <br>
                    <input type="submit" value="@lang('site.form_contact_send')">
                </form>
            </div>
        </div>
        <div class="advantages">
            <h1>@lang('menu.advantages')</h1>
            <div class="advantages-row">
                @foreach($advantages as $advantage)
                    <div class="advantages-item">
                        <img src="{{$advantage->image}}" alt="{{$advantage->name}}">
                        <p>{{$advantage->name}}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="review">
            <h1>@lang('site.reviews_title')</h1>
            <div class="review-row">
                @each('front.chanks.review_item', $reviews,'model')
            </div>
        </div>
    </main>
@endsection


@section('js')
    @parent
    <script>
        window.localStorage.clear();
        $(function () {
            $('.footer-form').on('submit', sendMailAjax)
        });
    </script>
@endsection
