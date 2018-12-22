<?php
/**
 * @var \App\Models\StaticPages $model
 */
?>
<footer>
    <div class="footer-row">
        <div class="footer-contact">
            <div class="footer-logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('assets/images/footer-logo.png')}}" alt="">
                </a>
            </div>
            <div class="footer-phone">
                <img src="{{asset('assets/images/footer-phone.svg')}}" alt="" width="18" height="18">
                <a href="tel:0445955955">(044) 595-59-55</a>
            </div>
            <div class="footer-mail">
                <img src="{{asset('assets/images/footer-mail.svg')}}" alt="" width="18" height="18">
                <a href="mailto:info@kuzia.net.ua">info@kuzia.net.ua</a>
            </div>
            <div class="footer-facebook">
                <img src="{{asset('assets/images/facebook.svg')}}" alt="" width="18" height="18">
                <a href="https://www.facebook.com/kuzia.ua/" target="_blank">@lang('site.subscribe')</a>
            </div>
        </div>

        <div class="footer-info" style="width: 26vw">
            <p class="footer-info-title">@lang('site.footer_info_title')</p><br>
            <div class="seo-text">{{--todo сделать ограничение ширины блока стилем--}}
                @isset($model)
                    @isset($model->seo)
                        <p>{!! str_limit($model->seo->seo_text,100,'... <a href="/technology">'.Lang::get('site.more_').'</a>') !!}</p>
                    @endisset
                @endisset
                <div class="popup-bg" style="display: none;">
                    <div class="popup">
                        @isset($model->seo)
                            <p>{!! $model->seo->seo_text !!}</p>
                        @endisset
                        <span class="popup-close-btn">X</span>
                    </div>
                </div>
            </div>
            <br>
            <div class="copyright">
                <p>@lang('site.cooperate')</p>
            </div>
        </div>
        <div class="footer-pay">
            <h3>@lang('site.pay_variant')</h3>
            <div class="footer-pay-row">
                <div class="footer-pay-item">
                    <p>@lang('site.terminal')</p>
                    <div class="pay-footer">
                        <a href="/oplata-uslug"><img src="{{asset('assets/images/sity24.png')}}" alt=""></a>
                        <a href="/oplata-uslug"> <img src="{{asset('assets/images/ibox.png')}}" alt=""></a>
                        <a href="/oplata-uslug"> <img src="{{asset('assets/images/non-stop.png')}}" alt=""></a>
                        <a href="/oplata-uslug"> <img src="{{asset('assets/images/tachcard.png')}}" alt=""></a>
                    </div>

                </div>
                <div class="footer-pay-item">
                    <p>@lang('site.online')</p>
                    <div class="pay-footer">
                        <a href="/oplata-uslug"> <img src="{{asset('assets/images/tyme.png')}}" alt=""></a>
                        {{--<a href="/oplata-uslug"><img src="{{asset('assets/images/webmoney.png')}}" alt=""></a>--}}
                        <a href="/oplata-uslug"> <img src="{{asset('assets/images/portmone.png')}}" alt=""></a>
                        <a href="/oplata-uslug"> <img src="{{asset('assets/images/plategka.png')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-logo">
            <a href="{{route('home')}}"><img src="{{asset('assets/images/fresh.png')}}" alt="Logo"></a>
        </div>
    </div>
</footer>
@if($technical)
    <div class="technical">
        <h3>{{ $technical->title }}</h3>
    </div>
@endif

<div class="old-phone-container">
    <div class="old-phone">
        <div class="footer-contact">
            <div class="footer-logo">
                <a href="https://kuzia.j2landing.com">
                    <img src="https://kuzia.j2landing.com/assets/images/footer-logo.png" alt="">
                </a>
            </div>
            <div class="footer-phone">
                <img src="https://kuzia.j2landing.com/assets/images/footer-phone.svg" alt="" width="18" height="18">
                <a href="tel:0445955955">(044) 595-59-55</a>
            </div>
            <div class="footer-mail">
                <img src="https://kuzia.j2landing.com/assets/images/footer-mail.svg" alt="" width="18" height="18">
                <a href="mailto:info@kuzia.net.ua">info@kuzia.net.ua</a>
            </div>
            <div class="footer-facebook">
                <img src="https://kuzia.j2landing.com/assets/images/facebook.svg" alt="" width="18" height="18">
                <a href="https://www.facebook.com/kuzia.ua/" target="_blank">Подписывайтесь на нас</a>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="{{asset('assets/js/lib/jquery.maskedinput.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
<script type="text/javascript">
    if (screen.width < 280) {
        $('.old-phone-container').css({'display':'block'});
        $('header').css({'display':'none'});
        $('main').css({'display':'none'});
        $('footer').css({'display':'none'});
    }
</script>
<script>


    function timelive4() {
        $("#logo_4").addClass('logo_none');
        $("#logo_1").removeClass('logo_none');

    }
    function timelive3() {
        $("#logo_3").addClass('logo_none');
        $("#logo_4").removeClass('logo_none');
        setTimeout(timelive4, 50);
    }

    function timelive2() {
        $("#logo_2").addClass('logo_none');
        $("#logo_3").removeClass('logo_none');

        setTimeout(timelive3, 50);
    }

    function timelive() {
        $("#logo_1").addClass('logo_none');
        $("#logo_2").removeClass('logo_none');

        setTimeout(timelive2, 50);
    }
    setInterval(timelive, 3000);

    $('.item-0 #in_apartment01').on('click',function () {
        $('.item-0 .tariffs2').removeClass('active');
        if ( $('.item-0 .tariffs2').not('.active') ) {
            $(this).parents('.item-0').find('.second_price').css({'display':'none'})
        }
        $('.item-0 .tariffs1').addClass('active');
        if ( $('.item-0 .tariffs1').hasClass('active') ) {
            $(this).parents('.item-0').find('.first_price').css({'display':'inline-flex'});
        }
    })
    $('.item-0 #in_apartment00').on('click',function () {
        $('.item-0 .tariffs1').removeClass('active');
        if ( $('.item-0 .tariffs1').not('.active') ) {
            $(this).parents('.item-0').find('.first_price').css({'display':'none'})
        }
        $('.item-0 .tariffs2').addClass('active');
        if ( $('.item-0 .tariffs2').hasClass('active') ) {
            $(this).parents('.item-0').find('.second_price').css({'display':'inline-flex'});
        }
    })

    $('.item-1 #in_apartment11').on('click',function () {
        $('.item-1 .tariffs2').removeClass('active');
        if ( $('.item-1 .tariffs2').not('.active') ) {
            $(this).parents('.item-1').find('.second_price').css({'display':'none'})
        }
        $('.item-1 .tariffs1').addClass('active');
        if ( $('.item-1 .tariffs1').hasClass('active') ) {
            $(this).parents('.item-1').find('.first_price').css({'display':'inline-flex'});
        }
    })
    $('.item-1 #in_apartment10').on('click',function () {
        $('.item-1 .tariffs1').removeClass('active');
        if ( $('.item-1 .tariffs1').not('.active') ) {
            $(this).parents('.item-1').find('.first_price').css({'display':'none'})
        }
        $('.item-1 .tariffs2').addClass('active');
        if ( $('.item-1 .tariffs2').hasClass('active') ) {
            $(this).parents('.item-1').find('.second_price').css({'display':'inline-flex'});
        }
    })

    $('.item-2 #in_apartment21').on('click',function () {
        $('.item-2 .tariffs2').removeClass('active');
        if ( $('.item-2 .tariffs2').not('.active') ) {
            $(this).parents('.item-2').find('.second_price').css({'display':'none'})
        }
        $('.item-2 .tariffs1').addClass('active');
        if ( $('.item-2 .tariffs1').hasClass('active') ) {
            $(this).parents('.item-2').find('.first_price').css({'display':'inline-flex'});
        }
    })
    $('.item-2 #in_apartment20').on('click',function () {
        $('.item-2 .tariffs1').removeClass('active');
        if ( $('.item-2 .tariffs1').not('.active') ) {
            $(this).parents('.item-2').find('.first_price').css({'display':'none'})
        }
        $('.item-2 .tariffs2').addClass('active');
        if ( $('.item-2 .tariffs2').hasClass('active') ) {
            $(this).parents('.item-2').find('.second_price').css({'display':'inline-flex'});
        }
    })


    function sendMailAjax(e) {
        e.preventDefault(e);
        var _this = $(this);
        $.ajax({
            url: _this.attr('action'),
            type: _this.attr('method'),
            data: _this.serialize(),
            success: function (resp) {
                if (resp.success == 1) {
                    _this.trigger('reset');
                    // todo окно приветствия
                    window.localStorage.clear();
                   $('.after_form').find(_this).fadeOut(500, function () {
                        $('.after_form').append( "<p class='pop_up_after'>Ваше сообщение успешно доставлено.<br>Скоро вам напишет администратор</p>" );
                        setTimeout(function () {
                            $('.pop_up_after').css('display','none');
                            $('.after_form').find(_this).css('display', 'flex');
                        }, 3000);
                    });


                   $('.page-form').find(_this).fadeOut(500, function () {
                        $('.page-form').append( "<p class='pop_up_after'>Ваше сообщение успешно доставлено.<br>Скоро вам напишет администратор</p>" );
                        setTimeout(function () {
                            $('.pop_up_after').css('display','none');
                            $('.page-form').find(_this).css('display', 'block');
                        }, 3000);
                    });


                    $('.contact-page-form').find(_this).fadeOut(500, function () {
                        $('.page-form').append( "<p class='pop_up_after'>Ваше сообщение успешно доставлено.<br>Скоро вам напишет администратор</p>" );
                        setTimeout(function () {
                            $('.pop_up_after').css('display','none');
                            $('.contact-page-form').find(_this).css('display', 'block');
                        }, 3000);
                    });


                    $('.slider-form').find(_this).fadeOut(500, function () {
                        $('.slider-form').append( "<p class='pop_up_after'>Ваше сообщение успешно доставлено.<br>Скоро вам напишет администратор</p>" );
                        setTimeout(function () {
                            $('.pop_up_after').css('display','none');
                            $('.slider-form').find(_this).css('display', 'block');
                        }, 3000);
                    });

                }

            },

            errors: function (err) {
                //todo показать ошибку или просто сообщить что письмо не отправлено
                console.log(err);
            }
        });

    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.modal_form .form-request').on('submit', sendMailAjax);

        function hideallDropdowns() {
            $(".dropped .drop-menu-main-sub").hide();
            $(".dropped").removeClass('dropped');
            $(".dropped .drop-menu-main-sub .title").unbind("click");
        }

        function showDropdown(el) {
            var el_li = $(el).parent().addClass('dropped');
            el_li
                .find('.title')
                .click(function () {
                    hideallDropdowns();
                })
                .html($(el).html());

            el_li.find('.drop-menu-main-sub').show();
        }

        $(".drop-down").click(function () {
            showDropdown(this);
        });

        $(document).mouseup(function () {
            hideallDropdowns();
        });
        PopUpHide();
        $('.slider-row').slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true,
            centerMode: true
        });
        $('.review-row').slick({
            dots: false,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1650,
                    settings: {

                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 990,
                    settings: {
                        dots: false,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]

        });
        $('.philantropy-row').slick({
            dots: false,
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 2,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        dots: true,
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]

        });

        $(document).ready(function () {
            $('.tv-slider').slick({
                dots: false,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true
            });
        });

        $('.modal').click(function (event) {
            event.preventDefault();
            $('.overlay').fadeIn(400, // анимируем показ обложки
                function () { // далее показываем мод. окно
                    $('.modal_form')
                        .css('display', 'block')
                        .animate({opacity: 1, top: '50%'}, 200);
                });
        });

        // закрытие модального окна
        $('.modal_close, .overlay').click(function () {
            $('.modal_form')
                .animate({opacity: 0, top: '45%'}, 200,  // уменьшаем прозрачность
                    function () { // пoсле aнимaции
                        $(this).css('display', 'none'); // скрываем окно
                        $('.overlay').fadeOut(400); // скрывaем пoдлoжку
                    }
                );
        });
        $("input[name$='tariffs']").click(function () {
            var test = $(this).val();

            $("div.desc").hide();
            $(".tariffs" + test).show();
        });
    });

    function PopUpShow() {
        $("#popup1").show();
    }

    //Функция скрытия PopUp
    function PopUpHide() {
        $("#popup1").hide();
    }

</script>
<script>
    $(function () {
        $(".phones").mask("+3(999)-999-99-99");
    });




</script>
<script>
    $('.popup-bg').hide();
    $('.footer-popup').click(function () {
        $('.popup-bg').show();
    });
    $('.popup-close-btn').click(function () {
        $('.popup-bg').hide();
    });
    $('.popup-bg').click(function () {
        $(this).hide();
    });
</script>
{{--<link rel="stylesheet" href="//cdn.leafletjs.com/leaflet-0.7.1/leaflet.css" />--}}

{{--<script src="//cdn.leafletjs.com/leaflet-0.7.1/leaflet.js"></script>--}}
<script>
    // this is a special type of icon. You can remove this class if you don't need it
    L.PopupIcon = L.Icon.extend({
        initialize: function( text, options ) {
            L.Icon.prototype.initialize.call(this, options);
            this._text = text;
        },

        createIcon: function() {
            var pdiv = document.createElement('div'),
                div = document.createElement('div'),
                width = 150;

            pdiv.style.position = 'absolute';
            div.style.position = 'absolute';
            div.style.width = width + 'px';
            div.style.bottom = '-3px';
            div.style.pointerEvents = 'none';
            div.style.left = (-width / 2) + 'px';
            div.style.margin = div.style.padding = '0';
            pdiv.style.margin = pdiv.style.padding = '0';

            var contentDiv = document.createElement('div');
            contentDiv.innerHTML = this._text;
            contentDiv.style.textAlign = 'center';
            contentDiv.style.lineHeight = '1.2';
            contentDiv.style.backgroundColor = 'white';
            contentDiv.style.boxShadow = '0px 1px 10px rgba(0, 0, 0, 0.655)';
            contentDiv.style.padding = '4px 7px';
            contentDiv.style.borderRadius = '5px';
            contentDiv.style.margin = '0 auto';
            contentDiv.style.display = 'table';
            contentDiv.style.pointerEvents = 'auto';

            var stop = L.DomEvent.stopPropagation;
            L.DomEvent
                .on(contentDiv, 'click', stop)
                .on(contentDiv, 'mousedown', stop)
                .on(contentDiv, 'dblclick', stop);

            var tipcDiv = document.createElement('div');
            tipcDiv.className = 'leaflet-popup-tip-container';
            tipcDiv.style.width = '20px';
            tipcDiv.style.height = '11px';
            tipcDiv.style.padding = '0';
            tipcDiv.style.margin = '0 auto';
            var tipDiv = document.createElement('div');
            tipDiv.className = 'leaflet-popup-tip';
            tipDiv.style.width = tipDiv.style.height = '8px';
            tipDiv.style.marginTop = '-5px';
            tipDiv.style.boxShadow = 'none';
            tipcDiv.appendChild(tipDiv);

            div.appendChild(contentDiv);
            div.appendChild(tipcDiv);
            pdiv.appendChild(div);
            return pdiv;
        },

        createShadow: function () {
            return null;
        }
    });

</script>


@stack('js')
@yield('js')
</body>
</html>