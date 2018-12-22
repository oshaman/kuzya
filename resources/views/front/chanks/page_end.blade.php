<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 25.07.2018
 * Time: 10:22
 */
?>

@isset($contact)
    <div class="container">
        <div class="page-form">
            <img class="img_block_mob" src="{{asset('/assets/images/kyzya.svg')}}" alt="" width="250" heigth="250">
            <div class="error footer_anim">
                <div class="error-row">
                    {{--<img src="/assets/images/error-bg.png" alt="">--}}
                    <div id="error404">
                        <div id="error404-eye-left" class="error404-eye">
                            <div class="error404-eyeball"></div>
                        </div>
                        <div id="error404-eye-right" class="error404-eye">
                            <div class="error404-eyeball"></div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="contact-page-form">
                <form action="{{route('footer.contact')}}" method="post" class="footer-form">
                    <div class="contact-form-row">
                        <input type="hidden" name="link" value="{{url()->current()}}">
                        <input type="hidden" name="title" value="{{$model->name??''}}">
                        <input type="text" name="surname" placeholder="@lang('site.surname')"
                               {{--pattern="^[( )a-zA-Z]+$" --}} required>
                        <input type="text" name="name" placeholder="@lang('site.name')"
                               {{--pattern="^[( )a-zA-Z]+$" --}} required>
                        <input type="text" name="email" placeholder="Email"
                               pattern="^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$"
                               required>
                    </div>
                    <div>
                        <textarea class="contact-textarea" name="content" placeholder="Сообщение"></textarea>
                    </div>
                    <input type="submit" value="@lang('site.form_contact_send')">
                </form>
            </div>
        </div>
    </div>
@else
    <div class="container">
        <div class="page-form">
            <img class="img_block_mob" src="{{asset('/assets/images/kyzya.svg')}}" alt="" width="250"
                 heigth="250">{{--todo инлайн стили--}}
            <div class="error footer_anim">
                <div class="error-row">
                    {{--<img src="/assets/images/error-bg.png" alt="">--}}
                    <div id="error404">
                        <div id="error404-eye-left" class="error404-eye">
                            <div class="error404-eyeball"></div>
                        </div>
                        <div id="error404-eye-right" class="error404-eye">
                            <div class="error404-eyeball"></div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="wrap_form_foot">
                <form action="{{route('footer.send')}}" method="post" class="footer-form">
                    <h2>@lang('site.form_title')</h2>
                    <p>@lang('site.form_desc')</p>
                    <input type="hidden" name="link" value="{{url()->current()}}">
                    <input type="hidden" name="title" value="{{$model->name??''}}">
                    <input type="text" name="street" placeholder="@lang('site.street')"
                           {{--pattern="^[( )\w.,]+$u"--}} required>
                    <input type="text" name="house" placeholder="@lang('site.house')"
                           {{--pattern="^[( )\w.,]+$u"--}} required>
                    <input type="text" name="name" placeholder="@lang('site.name')"
                           {{--pattern="^[( )\w.,]+$u"--}} required>
                    <input type="tel" class="phones" name="phone" placeholder="@lang('site.phone')"
                           {{--pattern="[\+()]*(?:\d[\s\-\.()xX]*){10,14}"--}} required>
                    <p class="litle-form">@lang('site.form_footer')</p>
                    <input type="submit" value="@lang('site.form_send')">
                </form>
            </div>
        </div>
    </div>
@endisset

@section('js')
    @parent
    <script>
        $(function () {
            $('.footer-form').on('submit', sendMailAjax)
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