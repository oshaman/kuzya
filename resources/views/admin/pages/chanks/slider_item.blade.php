<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 16.07.2018
 * Time: 14:48
 */
?>

@if($slide)
    <div class="desc col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <div class=" col-lg-6 col-xs-6">
                    <i class="fa fa-remove rem-desc"></i>
                </div>
                <label for="lfm_{{$loop->index}}">@lang('admins.image')</label>
                <a id="lfm_{{$loop->index}}" data-input="thumbnail_{{$loop->index}}" data-preview="holder_{{$loop->index}}">
                    <img id="holder_{{$loop->index}}" class="img-bordered-sm" style="max-height: 80px;max-width: 80px;background-color: cadetblue" src="{{$slide->image??''}}">
                </a>
                <input id="thumbnail_{{$loop->index}}" class="form-control" type="text" name="attr_ru[slider][{{$loop->index}}][image]" value="{{$slide->image}}">
                <input type="text" class="form-control" name="attr_ru[slider][{{$loop->index}}][title]" value="{{$slide->title??''}}" placeholder="@lang('site.name')">
                <input type="text" class="form-control" name="attr_ru[slider][{{$loop->index}}][address]" value="{{$slide->address??''}}" placeholder="@lang('site.address')">
                <input type="number" class="form-control" name="attr_ru[slider][{{$loop->index}}][priority]" value="{{$slide->priority??''}}" placeholder="@lang('admins.priority')">
                <label>
                    <input type="checkbox" name="attr_ru[slider][{{$loop->index}}][active]"
                           class="minimal"
                           value="1"
                            @if(!empty($slide->active)) checked @endif>
                    Вкл\Выкл
                </label>
            </div>
        </div>
    </div>
@else
    <div class="desc col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <div class=" col-lg-6 col-xs-6">
                    <i class="fa fa-remove rem-desc"></i>
                </div>
                <label for="lfm_0">@lang('admins.image')</label>
                <a id="lfm_0" data-input="thumbnail_0" data-preview="holder_0">
                    <img id="holder_0" class="img-bordered-sm" style="max-height: 80px;max-width: 80px;background-color: cadetblue" src="">
                </a>
                <input id="thumbnail_0" class="form-control" type="text" name="attr_ru[slider][0][image]" value="">
                <input type="text" class="form-control" name="attr_ru[slider][0][title]" placeholder="@lang('site.name')">
                <input type="text" class="form-control" name="attr_ru[slider][0][address]" placeholder="@lang('site.address')">
                <input type="number" class="form-control" name="attr_ru[slider][0][priority]" placeholder="@lang('admins.priority')">
                <label>
                    <input type="checkbox" name="attr_ru[slider][0][active]"
                           class="minimal"
                           value="1"
                    >
                    Вкл\Выкл
                </label>
            </div>
        </div>
    </div>
@endif

@section('js')
    @parent
    @if($slide)
        <script>$('#lfm_{{$loop->index}}').filemanager('image');</script>
    @else
        <script>$('#lfm_0').filemanager('image');</script>
    @endif
@endsection