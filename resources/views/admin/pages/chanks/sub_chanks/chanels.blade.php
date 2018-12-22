<?php
/**
 * Created by PhpStorm.
 * User: sergsova
 * Date: 28.09.18
 * Time: 15:57
 */

?>
@if (isset($category->chanels)&& count($category->chanels))
    @foreach ($category->chanels as $chanel)
        <input type="text"
               name="{{'attr_'.$lang}}[category][{{$index}}][chanels][{{$loop->index}}][title]"
               class="form-control"
               id="{{'attr_'.$lang}}[category][{{$index}}][chanels][{{$loop->index}}][title]"
               placeholder="Имя канала" value="{{$chanel->title??'' }}">
        <div class="form-group">
            <label for="lfm_{{$lang}}_{{$loop->index}}">@lang('admins.image')</label>
            <a class="lfm" id="lfm_{{$lang}}_advert_{{$loop->index}}"
               data-input="thumbnail_{{$lang}}_{{$loop->index}}"
               data-preview="holder_{{$lang}}_{{$loop->index}}">
                <img id="holder_{{$lang}}_{{$loop->index}}" class="img-bordered-sm "
                     style="max-height: 80px;max-width: 80px;background-color: cadetblue"
                     src="{{$chanel->image??''}}">
            </a>
            <input id="thumbnail_{{$lang}}_{{$loop->index}}" class="form-control"
                   type="text"
                   name="{{'attr_'.$lang}}[category][{{$index}}][chanels][{{$loop->index}}][image]"
                   value="{{$chanel->image??''}}">
        </div>
    @endforeach
@else
    <input type="text" name="{{'attr_'.$lang}}[category][{{$index??0}}][chanels][0][title]"
           class="form-control"
           id="{{'attr_'.$lang}}[category][{{$index??0}}][chanels][0][title]"
           placeholder="Имя канала" value="">
    <div class="form-group">
        <label for="lfm_{{$lang}}_0">@lang('admins.image')</label>
        <a class="lfm" id="lfm_{{$lang}}_advert_0"
           data-input="thumbnail_{{$lang}}_0"
           data-preview="holder_{{$lang}}_0">
            <img id="holder_{{$lang}}_0" class="img-bordered-sm "
                 style="max-height: 80px;max-width: 80px;background-color: cadetblue"
                 src="{{$chanel->image??''}}">
        </a>
        <input id="thumbnail_{{$lang}}_0" class="form-control"
               type="text"
               name="{{'attr_'.$lang}}[category][{{$index??0}}][chanels][0][image]"
               value="{{$chanel->image??''}}">
    </div>
@endif
