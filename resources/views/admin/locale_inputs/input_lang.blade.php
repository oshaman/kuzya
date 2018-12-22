<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 20.06.2018
 * Time: 9:22
 */
?>
<div data-lang="{{$lang}}" style="{{!$loop->first?"display: none":''}}">
    <input type="text"
           name="{{$field_name.'_'.$lang}}"
           class="form-control"
           id="{{$field_name}}"
           placeholder="Enter {{$field_name}}"
           value="{{$model->{$field_name.'_'.$lang}??'' }}">
</div>