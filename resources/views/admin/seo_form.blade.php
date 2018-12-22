<?php
/**
 * @var \App\Models\StaticPages $model
 */

$langi = $lang ?? '';
$index_title = isset($index) ? "[$index]" : '';
$index = $index ?? '';
?>
<div id="accordionSEO{{$langi}}" data-lang="{{$lang}}" style="{{!$loop->first?" display: none;":''}}">
    <div class="card bg-dark text-light">
        <div class="card-header" id="headingSEO{{$langi}}">
            <h5 class="mb-0">
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseSEO{{$langi}}" role="button"
                   aria-expanded="false" aria-controls="collapseSEO{{$langi}}">
                    SEO{{' '.$langi}}
                </a>
            </h5>
        </div>
        <div id="collapseSEO{{$langi}}" class="collapse" aria-labelledby="headingSEO{{$langi}}"
             data-parent="#accordionSEO{{$langi}}">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('Seo'.$index_title.'[seo_title]','SEO Title') }}
                    {{ Form::text('Seo'.$index_title.'[seo_title]', $model->{'seo'.$index}->seo_title ??null,['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('Seo'.$index_title.'[seo_keywords]','SEO Keywords') }}
                    {{ Form::text('Seo'.$index_title.'[seo_keywords]', $model->{'seo'.$index}->seo_keywords ??null,['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('Seo'.$index_title.'[seo_description]','SEO Description') }}
                    {{ Form::textarea('Seo'.$index_title.'[seo_description]', $model->{'seo'.$index}->seo_description ??null,['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('Seo'.$index_title.'[seo_text]','SEO Text') }}
                    {{ Form::textarea('Seo'.$index_title.'[seo_text]', $model->{'seo'.$index}->seo_text ??null,['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('Seo'.$index_title.'[og_title]','OG Title') }}
                    {{ Form::text('Seo'.$index_title.'[og_title]', $model->{'seo'.$index}->og_title ??null,['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('Seo'.$index_title.'[og_description]','OG Description') }}
                    {{ Form::textarea('Seo'.$index_title.'[og_description]', $model->{'seo'.$index}->og_description ??null,['class'=>'form-control']) }}
                </div>
                @include('admin.img_lfm',[
                'id'=>'og_image'.($index??''),
                'name'=>'Seo'.$index_title.'[og_image]',
                'title'=>'OG Image',
                'value'=>$model->{'seo'.$index}->image ??null
                ])
            </div>
        </div>
    </div>
</div>
@section('js')
    @parent
    <script>$('#lfmog_image{{$index}}').filemanager('image');</script>
@stop