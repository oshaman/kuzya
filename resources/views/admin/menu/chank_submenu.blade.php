<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 18.06.2018
 * Time: 16:38
 */

?>
@foreach($models as $model)
    <tr>
        <td>{{$lvl}}-{{$loop->iteration}}</td>
{{--        <td>{{$model->id}}</td>--}}
        <td>{{$model->name}}</td>
        <td>{{$model->slug}}</td>
        <td>{{$model->menu_link}}</td>
        <td class="text-center">
            <a href="{{route('menus.edit',$model->id)}}"
               class="text-info btn btn-link">@lang('admins.edit')</a>
        </td>
        <td class="text-center"><a class="text-red btn btn-link btn-destr"
                                   data-url="{{route('menus.destroy',$model->id)}}">@lang('admins.destroy')</a></td>
    </tr>
    @if($model->childs()->count())
        @include('admin.pages.chank_submenu',['models'=>$model->childs,'lvl'=>$lvl+1])
    @endif
@endforeach
