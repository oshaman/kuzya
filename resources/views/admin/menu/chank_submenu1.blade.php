<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 18.06.2018
 * Time: 16:38
 */
/**
 * @var \App\Models\Menu[] $models
 */
?>
@foreach($models as $model)
    <div class="box collapsed-box" style="margin-left: {{$lvl*5}}rem; width: auto">
        <div class="box-header with-border">
            <h3 class="box-title">{{$model->name}} [{{$model->id}}]</h3>
            <div class="box-tools pull-right">
                <span>{{$model->priority??0}}</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <a href="{{route('menus.edit',$model->id)}}"
                   class="text-info btn btn-link" data-original-title="@lang('admins.edit')"><i class="fa fa-pencil"></i></a>
                <a class="text-red btn btn-link btn-destr"
                   data-url="{{route('menus.destroy',$model->id)}}" data-original-title="@lang('admins.destroy')"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="box-body">
            <p>Alias: {{$model->slug}}</p>
            <p>Link: {{$model->menu_link??'---'}}</p>
        </div>
    </div>
    @if($model->childs()->count())
        @include('admin.menu.chank_submenu1',['models'=>$model->childs,'lvl'=>$lvl+1])
    @endif
@endforeach
