<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 12.07.2018
 * Time: 10:20
 */

?>
@if($desc)
    <div class="desc col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <div class="checkbox col-lg-6 col-xs-6">
                    <label>
                        <input type="checkbox" name="attr_{{$lang}}[desc][{{$loop->index}}][enable]"
                               class=""
                               value="1"
                                {{ $desc->enable??''?'checked':'' }}>
                        Включено
                    </label>
                </div>
                <div class=" col-lg-6 col-xs-6">
                    <i class="fa fa-remove rem-desc"></i>
                </div>
                <input type="text"
                       name="attr_{{$lang}}[desc][{{$loop->index}}][name]"
                       class="form-control"
                       id="attr_{{$lang}}[desc][{{$loop->index}}][name]"
                       placeholder="Имя"
                       value="{{$desc->name??''}}">
                <input type="text"
                       name="attr_{{$lang}}[desc][{{$loop->index}}][value]"
                       class="form-control"
                       id="attr_{{$lang}}[desc][{{$loop->index}}][value]"
                       placeholder="Значение"
                       value="{{$desc->value??'' }}">
                <input type="number"
                       name="attr_{{$lang}}[desc][{{$loop->index}}][priority]"
                       class="form-control"
                       id="attr_{{$lang}}[desc][{{$loop->index}}][priority]"
                       placeholder="Приоритет"
                       value="{{$desc->priority??'' }}">

            </div>
        </div>
    </div>
@else
    <div class="desc col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <div class="checkbox col-lg-6 col-xs-6">
                    <label>
                        <input type="checkbox" name="attr_{{$lang}}[desc][0][enable]"
                               class=""
                               value="1"
                                >
                        Включено
                    </label>
                </div>
                <div class=" col-lg-6 col-xs-6">
                    <i class="fa fa-remove rem-desc"></i>
                </div>
                <input type="text"
                       name="attr_{{$lang}}[desc][0][name]"
                       class="form-control"
                       id="attr_{{$lang}}[desc][0][name]"
                       placeholder="Имя"
                       value="">
                <input type="text"
                       name="attr_{{$lang}}[desc][0][value]"
                       class="form-control"
                       id="attr_{{$lang}}[desc][0][value]"
                       placeholder="Значение"
                       value="">

            </div>
        </div>
    </div>
@endif
