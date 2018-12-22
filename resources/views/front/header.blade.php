<?php

use App\Models\Menu;

//$menus = Menu::whereParentId(1)->get();
$languages = \App\Http\Middleware\Locale::$languages;
$route_name = request()->route() ? request()->route()->getName() : '';
?>
<header>
    <div class="header-top">
        <div class="header-top-block">
            <div class="clock">
                <p><img src="{{asset('assets/images/clock.-header.png')}}" alt="">@lang('site.work_24')</p>
            </div>
            <div class="header-contact-phone">
                <img src="{{asset('assets/images/phone.png')}}" alt="">
                <a href="tel:+ 044 595 59 55">(044) -595-59-55</a>
            </div>
            <a href="" class="modal"> <img src="{{asset('assets/images/call-me.png')}}" alt="">@lang('site.call_me')</a>
            <div class="modal_form">
                <h1>@lang('site.request_connection')</h1>
                <form action="{{route('header.request')}}" method="post" class="form-request">
                    <input type="hidden" name="link" value="{{url()->current()}}">
                    <input type="hidden" name="title" value="{{isset($model)?$model->name:''}}">
                    <input type="hidden" name="subject"
                           value="@lang('site.request_connection') @lang('site.from') @lang('site.page') '{{isset($model)?$model->name:''}}'">
                    <p>@lang('site.name') <input type="text" name="name" placeholder="@lang('site.name')" required></p>
                    <p>@lang('site.phone_numb') <input type="tel" class="phone" name="phone"
                                                       placeholder="@lang('site.phone')"
                                                       pattern="[\+]\d{1}\s[\(]\d{3}[\)]\s\d{3}[\-]\d{2}[\-]\d{2}"
                                                       minlength="18" maxlength="18"></p><br>
                    <input type="submit" value="@lang('site.form_contact_send')">
                </form>
                <span class="modal_close"><img src="{{asset('assets/images/close-popup.png')}}"></span>
            </div>
            <div class="overlay">
            </div>
            <div class="connect">
                <a href="https://kuzia.j2landing.com/connection">Подключится</a>
            </div>
        </div>
        <div class="header-top-block">
            @if(!empty($login_block->approved))
            <div class="login">
                <a href="{{ $login_block->link??'' }}"><p><img src="{{asset('assets/images/account.png')}}" alt="">@lang('site.enter')</p></a>
            </div>
            @endif
            <div class="lang">
                <ul class="drop-menu-main">
                    <li class="drop-down"><img src="{{asset('assets/images/'.app()->getLocale().'.png')}}" alt=""></li>
                    <li class="drop-menu-main-sub">
                        <span class="title"></span>
                        @foreach($languages as $language)
                            <a href="{{route('setlocale',$language)}}"
                               class="{{app()->getLocale()==$language?'active':''}}"><img
                                        src="{{asset('assets/images/'.$language.'.png')}}"
                                        alt="">{!! !$loop->first?'<span class="arrow"></span>':'' !!}</a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="logo">
            {{--<a href="{{route('home')}}"><img src="{{asset('assets/images/logo.png')}}" alt=""></a>--}}

            <a href="{{route('home')}}" class="navbar-brand">
                <div id="logo_1" class="logo_header">
                    <img id="logo_img" class="logo_header_kuzia" src="/assets/images/g141.png" alt="logo">
                    <img class="logo_header_text" src="/assets/images/logo_small_ru.png" alt="logo_text">
                </div>
                <div id="logo_2" class="logo_header logo_none">
                    <img id="logo_img" class="logo_header_kuzia" src="/assets/images/g142.png" alt="logo">
                    <img class="logo_header_text" src="/assets/images/logo_small_ru.png" alt="logo_text">
                </div>
                <div id="logo_3" class="logo_header logo_none">
                    <img id="logo_img" class="logo_header_kuzia" src="/assets/images/g143.png" alt="logo">
                    <img class="logo_header_text" src="/assets/images/logo_small_ru.png" alt="logo_text">
                </div>
                <div id="logo_4" class="logo_header logo_none">
                    <img id="logo_img" class="logo_header_kuzia" src="/assets/images/g144.png" alt="logo">
                    <img class="logo_header_text" src="/assets/images/logo_small_ru.png" alt="logo_text">
                </div>

            </a>
        </div>
        <nav>
            <ul>
                @forelse($menus->where('parent_id', 1) as $menu)
                    <li><a href="{{ $menu->getUrl() }}">{{ $menu->name }}</a>
                        @if($menu->childs->isNotEmpty())
                            <ul class="submenu">
                                @forelse($menu->childs as $child)
                                    <li><a href="{{ $child->getUrl() }}">{{ $child->name }}</a></li>

                                @empty

                                @endforelse
                                {{--<li><a href="https://kuzia.j2landing.com/aktsii">Акции</a></li>--}}
                                {{--<li><a href="https://kuzia.j2landing.com/novosti">Новости</a></li>--}}
                                {{--<li><a href="https://kuzia.j2landing.com/faq">Ответы на частые вопросы</a></li>--}}
                                {{--<li><a href="https://kuzia.ua/assets/templates/kuzia_new/images/dif/contract_2017.pdf"--}}
                                       {{--target="_blank">Публичный договор</a></li>--}}
                                {{--<li><a href="https://kuzia.j2landing.com/o-kompanii">О компании</a></li>--}}
                                {{--<li><a href="https://kuzia.j2landing.com/technology">Техническое описание</a></li>--}}
                                {{--<li><a href="https://kuzia.j2landing.com/metsenatstvo">Меценацтво</a></li>--}}
                                {{--<li><a href="https://kuzia.j2landing.com/kontakty">Контакты</a></li>--}}
                            </ul>
                        @endif
                    </li>
                @empty

                @endforelse
            </ul>
        </nav>
        <nav class="mobile-menu">
            <label for="show-menu" class="show-menu">
                <div class="lines"></div>
            </label>
            <input type="checkbox" id="show-menu">
            <ul id="menu">
                @forelse($menus as $menu)
                    <li><a href="{{ $menu->getUrl() }}">{{ $menu->name }}</a>
                @empty

                @endforelse

            </ul>
        </nav>
    </div>
</header>

@section('js')
    @parent
    {{--<script src="{{asset('assets/js/lib/rem.min.js')}}"></script>--}}
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>--}}
    <script src="{{asset('assets/js/lib/helper.js')}}"></script>
    <script src="{{asset('assets/js/lib/plugins.js')}}"></script>
    <script src="{{asset('assets/js/lib/script.js')}}"></script>
    <script src="{{asset('assets/js/lib/selectivizr-1.0.3.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/modernizr-2.5.3.min.js')}}"></script>
    {{--<meta http-equiv="cleartype" content="on">--}}
    {{--<script>window.jQuery || document.write('<script src="assets/js/lib/jquery-1.7.2.min.js"><\/script>')</script>--}}

@endsection