@extends('layouts.code')

@section('title')
    Editing Question
@endsection

@section('style')
@include('partials.codestyle')
<link rel="stylesheet" href="{!! mix('css/trumbowyg.min.css') !!}">
<style>.code_box textarea{position:relative;left:0;right:0;top:30px;bottom:0;resize:none;border:0;padding:10px;font-family:monospace}.code_box textarea:focus{outline:none;background:#EFEFEF}</style>
@endsection

@section('content')
<div class="container full">
    <div class="row" style="margin-bottom: 0">
        <form role="form" action="/question/{{$question->id}}/" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put"/>
            <div class="col s12 m12 l4">
                <div class="card-panel z-depth-0" style="padding-bottom:20px">
                    <div class="input-field" style="margin-top:0.5rem">
                        <input placeholder="" value="{{ $question->topik }}" name="topik" type="text" required>
                        <label for="topik">Topik</label>
                    </div>
                    <div class="input-field">
                        <textarea id="desc" placeholder="Penjelasan tentang topik dan arahan mengerjakan" name="deskripsi">{!! $question->deskripsi !!}</textarea>
                        <label class="active" for="deskripsi" style="padding-bottom:6px">Deskripsi</label>
                    </div>
                    <div class="input-field">
                        <a href="/question" class="btn-flat white left" style="padding-left:0"><i class="material-icons left">arrow_back</i>Back</a>
                        <button class="btn gradient-2 waves-effect waves-light right" type="submit" name="action">Save<i class="material-icons right">save</i></button>
                    </div><p class="clearfix"></p>
                </div>
            </div>
            <div class="col s12 m12 l4" style="margin-top:0.5rem; margin-bottom: 1rem">
                <div class="col s12">
                    <ul class="tabs" style="background-color: #1a2327">
                        <li class="tab col s4"><a href="#html">HTML</a></li>
                        <li class="tab col s4"><a href="#css">CSS</a></li>
                        <li class="tab col s4"><a href="#js">JS</a></li>
                    </ul>
                </div>
        		<div id="html" class="col s12 code_box">
                    <textarea name="html">{!! $question->template_html !!}</textarea>
        		</div>
        		<div id="css" class="col s12 code_box">
                    <textarea name="css">{!! $question->template_css !!}</textarea>
        		</div>
        		<div id="js" class="col s12 code_box">
                    <textarea name="js">{!! $question->template_js !!}</textarea>
        		</div>
            </div>
        </form>
        <div class="col s12 m12 l4">
            <div class="card-panel z-depth-0">
                <form method="POST" action="/question/{{$question->id}}/key">
                    {{ csrf_field() }}
                    <div class="input-field">
                        <input placeholder="$expect('h1').to.be.attr('color', 'red')" type="text" name="checklist" style="font-family: monospace" required/>
                        <label for="checklist">Challenge</label>
                    </div>
                    <div class="input-field">
                        <input placeholder="H1 element must be red" type="text" name="message"/>
                        <label for="message">Message</label>
                    </div>
                    <div class="input-field">
                        <a class="grey-text lighten-2" href="https://github.com/Codecademy/jquery-expect/" target="_black"><i class="material-icons">help</i></a>
                        <!-- @include('key.helpmodal') -->
                        <button class="btn green waves-effect waves-dark right" type="submit" name="action">Add<i class="material-icons right">playlist_add</i></button>
                    </div><p class="clearfix"></p>
                </form>
                <h6 class="main-title" style="margin-top:30px">Challenges</h6>
                <ul class="collection" style="max-height:182px;overflow-y:auto; margin-bottom:0">
                    @if($question->keys->count() > 0)
                    @foreach($question->keys as $key)
                        <li class="collection-item">
                            <a href="#modal{{ $key->id }}delete" class="secondary-content right grey-text"><i class="material-icons tiny">delete</i></a>
                            @component('partials.deletemodal')
                                @slot('id')
                                    {{$key->id}}delete
                                @endslot
                                @slot('action')
                                    /question/{{$question->id}}/key/{{$key->id}}
                                @endslot
                            @endcomponent
                            <a href="#modal{{$key->id}}edit" class="secondary-content right grey-text"><i class="material-icons tiny">edit</i>&nbsp;</a>
                            @include('key.editmodal')
                            {{ $loop->index+1 }}.&nbsp;{{ $key->message }}<br/>
                            <code class="grey-text">{{ $key->checklist }}</code>
                        </br/>
                        </li>
                    @endforeach
                    @else
                        <li class="collection-item grey-text">No challenge yet. Add challenge above.</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('codemirror/codemirror.js') }}"></script>
@include('partials.codescript')
<script src="{{ asset('js/code-grammar.js') }}"></script>
<script>
    (function() {
        var html_editor = codemirror_grammar(document.querySelector("#html textarea"), [
            {language : "htmlmixed", grammar : htmlmixed_grammar}
        ]);
        var css_editor = codemirror_grammar(document.querySelector("#css textarea"), [
            {language : "css", grammar : css_grammar}
        ]);
        var js_editor = codemirror_grammar(document.querySelector("#js textarea"), [
            {language : "javascript", grammar : js_grammar}
        ]);
    }());
</script>
<script src="{{ asset('js/wyg.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.modal').modal();
    });
    $.trumbowyg.svgPath = '/images/icons.svg';
    $('#desc').trumbowyg({
        btns : [
            ['viewHTML'],
            ['formatting'],
            ['bold','italic','preformatted','orderedList'],
            ['link'],
            ['fullscreen']
        ],
        resetCss: true,
        removeformatPasted: true
    });
</script>
@endsection
