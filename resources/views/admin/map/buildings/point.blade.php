<?php
/**
 * Created by PhpStorm.
 * User: sergsova
 * Date: 25.09.18
 * Time: 12:25
 */
?>

<div class="item point">
    <p>@lang('admins.point') {{$index+1}}</p>
    <label>X
        <input type="text" class="form-control " name="points[{{$index}}][pointX]" value="{{isset($point)?$point['pointX']:''}}">
    </label>
    <label>Y
        <input type="text" class="form-control " name="points[{{$index}}][pointY]" value="{{isset($point)?$point['pointY']:''}}">
    </label>
    @if ($index>3)
        <button class="delete-this" type="button" style="border: 1px solid red;">-</button>
    @endif
</div>


