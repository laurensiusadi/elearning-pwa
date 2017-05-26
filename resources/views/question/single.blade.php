<?php use Carbon\Carbon; ?>
@extends('layouts.code')

@section('style')
@include('partials.codestyle')
@endsection

@section('content')
    <div class="row" style="margin: 5px;">
        <div id="desc" class="col l4 m12 s12">
            <div class="card-panel z-depth-0" style="padding-bottom:20px; height: 490px; overflow-y: auto">
                <h5>{{ $question->topik }}</h5>
                <span class="description">{!! $question->deskripsi !!}</span>
                <hr/>
                <h6>Challenges</h6>
                <ul class="collection" style="font-family:monospace">
                    @foreach($question->keys as $key)
                        <li class="collection-item">{{ $loop->index+1 }}.&nbsp;{{ $key->checklist }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <form method="POST" action="/classroom/{{$quiz->classroom->id}}/quiz/{{$quiz->id}}/question/{{$question->id}}/answer">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put"/>
        <div id="code" class="col l4 m12 s12" style="margin-top:0.5rem; margin-bottom: 1rem; max-height:490px">
            <div class="col s12">
                <ul class="tabs" style="background-color: #1a2327">
                    <li class="tab col s4"><a href="#html">HTML</a></li>
                    <li class="tab col s4"><a href="#css">CSS</a></li>
                    <li class="tab col s4"><a href="#js">JS</a></li>
                </ul>
            </div>
    		<div id="html" class="col s12 code_box">
                <textarea name="html">{!! $answer->code_html !!}</textarea>
    		</div>
    		<div id="css" class="col s12 code_box">
                <textarea name="css">{!! $answer->code_css !!}</textarea>
    		</div>
    		<div id="js" class="col s12 code_box">
                <textarea name="js">{!! $answer->code_js !!}</textarea>
    		</div>
            <div class="col s12" style="position:relative;top:-44px;z-index:7;padding:0 8px;float:right">
                <button type="submit" class="btn white-text grey left waves-effect waves-light">Save</button>
                <button id="run" class="btn white-text gradient-2 right waves-effect waves-light">Run</button>
            </div>
        </div>
        </form>
        <div id="rend" class="col l4 m12 s12" style="margin-top:0.5rem; margin-bottom: 1rem">
        	<div class="col s12 grey lighten-4" id="browser">
                <div class="white">http://localhost/
                    <a id="rend-full"><i class="material-icons right" style="margin:5px 4px 0 0">fullscreen</i></a>
                </div>
            </div>
        	<section id="output">
        		<iframe></iframe>
        	</section>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('codemirror/codemirror.js') }}"></script>
@include('partials.codescript')
<script src="{{ asset('js/code-grammar.js') }}"></script>
<script src="{{ asset('js/code-render.js') }}"></script>
<script src="{{ asset('js/jquery.expect.js') }}"></script>
<script src="{{ asset('js/expect.js') }}"></script>
@endsection
