@extends('layouts.front')

@section('content')
    <main>
        <div class="error">
            <div class="error-row">
                {{--<img src="/assets/images/error-bg.png" alt="">--}}
                <div id="error404">
                    <div id="error404-eye-left" class="error404-eye">
                        <div class="error404-eyeball"></div>
                    </div>
                    <div id="error404-eye-right" class="error404-eye">
                        <div class="error404-eyeball"></div>
                    </div>
                    <div class="error-text">
                        <p>Страница не найдена</p>
                        <p>За то есть Кузя</p>
                    </div>
                </div>
            </div>


        </div>
    </main>
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