@extends('layouts.code')

@section('title')
    Question Create
@endsection

@section('style')
<link rel="stylesheet" href="{!! asset('codemirror/codemirror.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/material.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/lint/lint.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/hint/show-hint.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/fold/foldgutter.css') !!}">
<link rel="stylesheet" href="{!! asset('css/trumbowyg.css') !!}">
<style>.code_box textarea{position:relative;left:0;right:0;top:30px;bottom:0;resize:none;border:0;padding:10px;font-family:monospace}.code_box textarea:focus{outline:none;background:#EFEFEF}#output{height:440px;border:5px solid #DDD;overflow:hidden}#output iframe{width:100%;height:100%;border:0}</style>
@endsection

@section('content')
<div class="container full">
    <!-- <h5>Buat Soal Baru</h5> -->
    <div class="row" style="margin-bottom: 0">
        <form role="form" action="{{ url('question') }}" method="POST">
            <div class="col s12 m12 l4">
                <div class="card-panel" style="padding-bottom:20px">
                    {{ csrf_field() }}
                    <div class="input-field" style="margin-top:0.5rem">
                        <input placeholder="" name="topik" type="text" required>
                        <label for="topik">Topik</label>
                    </div>
                    <div class="input-field">
                        <textarea id="desc" placeholder="Penjelasan tentang topik dan arahan mengerjakan" name="deskripsi"></textarea>
                        <label class="active" for="deskripsi" style="padding-bottom:6px">Deskripsi</label>
                    </div>
                    <div class="input-field">
                        <a href="/question" class="btn-flat white left" style="padding-left:0"><i class="material-icons left">arrow_back</i>Back</a>
                        <button class="btn green waves-effect waves-dark right" type="submit" name="action">Save<i class="material-icons right">save</i></button>
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
                    <textarea name="html"></textarea>
        		</div>
        		<div id="css" class="col s12 code_box">
                    <textarea name="css"></textarea>
        		</div>
        		<div id="js" class="col s12 code_box">
                    <textarea name="js"></textarea>
        		</div>
            </div>
        </form>
        <div class="col s12 m12 l4">
            <div class="card-panel">
                <form>
                    <div class="input-field">
                        <input placeholder="$expect('h1').to.be.attr('color', 'red')" type="text" name="checklist" class="autocomplete" style="font-family: monospace"/>
                        <label for="checklist">Challenges</label>
                    </div>
                    <div class="input-field">
                        <input placeholder="H1 element must be red" type="text" name="message"/>
                        <label for="message">Message</label>
                    </div>
                </form>
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
        var html_editor = codemirror_grammar_demo(document.querySelector("#html textarea"), [
            {language : "htmlmixed", grammar : htmlmixed_grammar}
        ]);
        var css_editor = codemirror_grammar_demo(document.querySelector("#css textarea"), [
            {language : "css", grammar : css_grammar}
        ]);
        var js_editor = codemirror_grammar_demo(document.querySelector("#js textarea"), [
            {language : "javascript", grammar : js_grammar}
        ]);
    }());
</script>
<script src="{{ asset('js/wyg.js') }}"></script>
<script>
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
