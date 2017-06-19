<?php use Carbon\Carbon; ?>
@extends('layouts.code')

@section('title')
    <a href="/classroom/{{$classroom->enrollmentId($classroom)}}/quiz/{{$quiz->id}}/question">
        <i class="material-icons left">arrow_back</i>{{ $quiz->nama }}
    </a>
@endsection

@section('style')
@include('partials.codestyle')
<style>
#output {height:442px;border:1px solid #ddd;overflow:hidden;background-color:white}
#output iframe {width:100%;height:100%;border:0; overflow: auto;}
#browser{height:48px;border:1px solid #ddd;border-bottom:none;padding:6px}
#browser>div{height:36px;line-height:36px;border:1px solid #cacaca; border-radius:2px}
.description code {padding: 1px 7px; margin:0 2px; background-color: rgba(0,0,0,0.08); border-radius: 5px}
@media screen and (min-width:993px){
    #code{ padding: 0 0 0 1rem }
    #rend.fullSize{ position: fixed; z-index: 100; width: 100%; right: 0%; -webkit-transition: all 0.6s cubic-bezier(0.53, 0.01, 0.36, 1.0); -moz-transition: all 0.6s cubic-bezier(0.53, 0.01, 0.36, 1.0); -o-transition: all 0.6s cubic-bezier(0.53, 0.01, 0.36, 1.0); transition: all 0.4s cubic-bezier(0.53, 0.01, 0.36, 1.0) }
}
</style>
@endsection

@section('content')
    <div class="row" style="margin: 0 5px;">
        <div id="desc" class="col l4 m12 s12">
            <div class="card-panel z-depth-0" style="padding-bottom:20px; height: 490px; overflow-y: auto">
                <h5>{{ $question->topik }}</h5>
                <span class="description">{!! $question->deskripsi !!}</span>
                <br/>
                <h6 class="main-title">CHALLENGES</h6>
                <div id="mocha">
                <ul id="challenges-list" class="collection" style="font-family:monospace">
                    @foreach($question->keys as $key)
                        <li class="collection-item">
                            <i class="material-icons left grey-text text-lighten-1">cancel</i>
                        &nbsp;{{ $key->message }}</li>
                    @endforeach
                </ul>
                </div>
                @include('question.modalnext')
            </div>
        </div>
        <form method="POST" action="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}/answer">
        {{ csrf_field() }}
        <div id="code" class="col l4 m12 s12" style="margin-top:0.5rem; margin-bottom: 1rem; max-height:490px ">
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
            <div class="col s12 slate" style="z-index:7;padding:8px;">
                <button id="judge" type="button" class="update run btn z-depth-3 white-text green accent-4 waves-effect waves-light">Run</button>
                <button type="submit" class="update btn z-depth-3 white-text gradient-2 right waves-effect waves-light">Save</button>
            </div>
        </div>
        </form>
        <div id="rend" class="col l4 m12 s12" style="margin-top:0.5rem; margin-bottom: 1rem">
        	<div class="col s12 grey lighten-4 scale-transition" id="browser">
                <div class="white">
                    <a type="button" class="run grey-text">
                        <i class="material-icons left" style="margin:5px 4px 0 4px">refresh</i>
                    </a>http://localhost/
                    <a type="button" id="rend-full" class="grey-text">
                        <i id="fullscreen" class="material-icons right" style="margin:5px 4px 0 0">fullscreen</i>
                        <i id="fullscreen-exit" class="hiddendiv material-icons right" style="margin:5px 4px 0 0"> fullscreen_exit</i>
                    </a>
                </div>
            </div>
        	<section id="output">
        		<iframe id="iframe"></iframe>
        	</section>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('codemirror/codemirror.js') }}"></script>
@include('partials.codescript')
<script src="{{ asset('js/code-grammar.js') }}"></script>
<script>
(function() {
    var prepareSource = function() {
        var code = "\<!DOCTYPE html\>\<html\>\<head\>";
        code += "\<style\>"  + css_editor.getValue() + "\<\/style\>";
        code += "\<body\>" + html_editor.getValue();
        code += "\<script\>" + js_editor.getValue() + "\<\/script\>";
        code += "\</body\>\<\/html\>";
        return code;
    };

    var render = function() {
        var source = prepareSource();

        var iframe = document.querySelector('#output iframe'),
        iframe_doc = iframe.contentDocument;

        iframe_doc.open();
        iframe_doc.write(source);
        iframe_doc.close();

        Materialize.toast('Rendered', 2000, 'grey');
    };

    // HTML EDITOR
    var html_editor = codemirror_grammar(document.querySelector("#html textarea"), [
        {language : "htmlmixed", grammar : htmlmixed_grammar}
    ], 390);

    // CSS EDITOR
    var css_editor = codemirror_grammar(document.querySelector("#css textarea"), [
        {language : "css", grammar : css_grammar}
    ], 390);

    // JAVASCRIPT EDITOR
    var js_editor = codemirror_grammar(document.querySelector("#js textarea"), [
        {language : "javascript", grammar : js_grammar}
    ], 390);

    $(".run").click(function(){
        render();
    });

    $(".update").click(function(e) {
        e.preventDefault();
        var url = "/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}/answer";
        var $answer = {};
        $answer.qid = '{{ $question->id }}';
        $answer.html = html_editor.getValue();
        $answer.css = css_editor.getValue();
        $answer.js = js_editor.getValue();

        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
            type: "POST",
            url: url,
            data: $answer,
            cache: false,
            success: function(data){
                render();
                Materialize.toast('Saved', 3000, 'blue');
                console.log(data);
            },
            error: function(data) {
                Materialize.toast('Not Saved', 3000, 'materialize-red');
                console.log(data);
            }
        });
    });

    window.onload = function() {
        render();
    };
}());

</script>
<!-- <script src="{{ asset('js/code-render.js') }}"></script> -->
<script src="{{ asset('js/mocha.js') }}"></script>
<!-- <script>mocha.setup({
  ui: 'bdd',
  ignoreLeaks: true,
  asyncOnly: true,
});</script> -->
<script src="{{ asset('js/expect.js') }}"></script>
<script src="{{ asset('js/jquery.expect.js') }}"></script>
<script>
$(document).ready(function(){
    $('.modal').modal({
        dismissible: false
    });
});
$('#rend-full').click(function(evt) {
    $('#rend').toggleClass('fullSize');
    $('#fullscreen').toggleClass('hiddendiv');
    $('#fullscreen-exit').toggleClass('hiddendiv');
});
</script>
<script>
window.DONE = false;
mocha.setup({
  ui: 'bdd',
  asyncOnly: true,
});
describe('Challenges', function () {
@foreach($keys as $key)
it('{{ $key->message }}', function () { {!! $key->checklist !!} });
@endforeach
});
$(function () {
    document.getElementById("judge").addEventListener("click", function(){
        if(window.DONE == true) {
            console.log(window.DONE);
            window.DONE = false;
            console.log(window.DONE);
            mocha.setup({
              ui: 'bdd',
              asyncOnly: true,
            });
            describe('Challenges', function () {
            @foreach($keys as $key)
            it('{{ $key->message }}', function () { {!! $key->checklist !!} });
            @endforeach
            });
        }
        if(window.DONE == false) {
            var checklist = $("#mocha>ul");
            if("checklist") {
                checklist.remove();
            }
            mocha.run(function () {
                window.DONE = true;
                var failures = document.querySelectorAll('.test.fail').length;
                if(!failures){
                    console.log("No failures");
                    $('#modalnext').modal('open');
                }
                Materialize.toast('Checked', 3000, 'blue');
            });
        }
    });
});
</script>
@endsection
