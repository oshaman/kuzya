<div class="col-lg-6">
    {{ Form::label('priority', 'Приоритет(0-100)') }}
    <div>
        {!! Form::number('priority', null , ['id'=>'priority', 'class'=>'form-control']) !!}
    </div>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="active"
               class="minimal"
               value="1"
                {{ $model->active?'checked':'' }}>
        Вкл\Выкл
    </label>
</div>