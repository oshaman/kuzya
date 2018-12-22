<?php

$isVideo = $isVideo ?? false;
?>
<div class="form-group col {{$subClass??''}}">
    <div class="input-group">
        <span class="input-group-btn">
          <a id="lfm{{$id}}" data-input="thumb{{$id}}" data-preview="holder{{$id}}" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> {{$title}}
          </a>
        </span>
        <input id="thumb{{$id}}" class="form-control" type="text" name="{{$name}}" value="{{ $value??$model->{$name} }}">
    </div>
    <div class="">
        <img id="holder{{$id}}" class=" img-thumbnail" style="margin-top:15px;max-height:100px;" src="{{ $value??$model->{$name} }}">
    </div>
</div>
@section('scripts')
    @parent
    <script>
        $('#lfm{{$id}}').filemanager('image');
    </script>
@endsection