<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 20.06.2018
 * Time: 9:22
 */
$field = $field_name.'_'.$lang;
?>
<div data-lang="{{$lang}}" style="{{!$loop->first?" display: none;":''}}">
<textarea name="{{$field}}" id="{{$field_name}}" class="textarea {{$class_ex??''}}" placeholder="Place some text here"
          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$model->{$field}??''}}</textarea>
</div>