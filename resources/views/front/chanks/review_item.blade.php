<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.07.2018
 * Time: 12:22
 */

/**
 * @var \App\Models\Review $model
 */
?>
<div class="review-item">
    <div>{!! $model->description !!}</div>
    <div class="review-date">
        <p><img src="{{asset('assets/images/review-calendar.png')}}" alt="calendar">{{$model->review_data->format('d/m.y')}}</p>
        <p><img src="{{asset('assets/images/review-clock.png')}}" alt="clock">{{$model->review_data->format('H:i')}}</p>
    </div>
    <div class="review-names">
    <img src="{{$model->image}}" alt="{{$model->name}}">
    <p class="review-name">{{$model->name}}</p>
    </div>
</div>
