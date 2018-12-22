<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 16.07.2018
 * Time: 15:34
 */
?>
@if($advert)
    <div class="desc col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <div class=" col-lg-6 col-xs-6">
                    <i class="fa fa-remove rem-desc"></i>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label for="title_{{$loop->index}}">Текст</label>
                    <textarea type="text" name="attr_{{$lang}}[advert][{{$loop->index}}][title]" id="title_{{$loop->index}}" rows="3" class="form-control">{{$advert->title??''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="lfm_{{$loop->index}}">@lang('admins.image')</label>
                    <a id="lfm_advert_{{$loop->index}}" data-input="thumbnail_{{$loop->index}}" data-preview="holder_{{$loop->index}}">
                        <img id="holder_{{$loop->index}}" class="img-bordered-sm" style="max-height: 80px;max-width: 80px;background-color: cadetblue" src="{{$advert->image??''}}">
                    </a>
                    <input id="thumbnail_{{$loop->index}}" class="form-control" type="text" name="attr_{{$lang}}[advert][{{$loop->index}}][image]" value="{{$advert->image}}">
                </div>
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
                <div class="clearfix"></div>
                <div class="form-group">
                    <label for="title_0">Текст</label>
                    <textarea type="text" name="attr_{{$lang}}[advert][0][title]" id="title_0" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="lfm_0">@lang('admins.image')</label>
                    <a id="lfm_advert_0" data-input="thumbnail_0" data-preview="holder_0">
                        <img id="holder_0" class="img-bordered-sm" style="max-height: 80px;max-width: 80px;background-color: cadetblue" src="">
                    </a>
                    <input id="thumbnail_0" class="form-control" type="text" name="attr_{{$lang}}[advert][0][image]" value="">
                </div>
            </div>
        </div>
    </div>
@endif

@section('js')
    @parent
    @if($advert)
        <script>$('#lfm_advert_{{$loop->index}}').filemanager('image');</script>
    @else
        <script>$('#lfm_advert_0').filemanager('image');</script>
    @endif
@endsection
