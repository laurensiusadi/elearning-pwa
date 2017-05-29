<?php use Carbon\Carbon; ?>
@extends('layouts.code')

@section('title')
    {{ $quiz->nama }}
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
                <ul class="collection" style="font-family:monospace">
                    @foreach($question->keys as $key)
                        <li class="collection-item">
                            <!-- <i class="material-icons left green-text text-accent-4">check_circle</i> -->
                            <i class="material-icons left grey-text text-lighten-1">cancel</i>
                        &nbsp;{{ $key->message }}</li>
                    @endforeach
                </ul>
                <button id="judge" type="button" class="col s12 run btn white-text green accent-4 waves-effect waves-light">Run</button>
                <div class="col s12">
                    <div id="mocha"></div>
                </div>
            </div>
        </div>
        <form method="POST" action="/classroom/{{ $quiz->classroom->id }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}/answer">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put"/>
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
            <div class="col s12" style="position:relative;top:-44px;z-index:7;padding:0 8px;float:right">
                <button type="submit" class="btn white-text gradient-2 right waves-effect waves-light">Save</button>
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
<script src="{{ asset('js/mocha.js') }}"></script>
<script>mocha.setup({
  ui: 'bdd',
  ignoreLeaks: true,
  asyncOnly: true,
});</script>
<script src="{{ asset('js/expect.js') }}"></script>
<script src="{{ asset('js/jquery.expect.js') }}"></script>
<script>
$('#rend-full').click(function(evt) {
        $('#rend').toggleClass('fullSize');
        $('#fullscreen').toggleClass('hiddendiv');
        $('#fullscreen-exit').toggleClass('hiddendiv');
});
</script>
<script>
describe('$expect', function () {
@foreach($question->keys as $key)
it('{{ $key->message }}', function () {
    {!! $key->checklist !!}
});
@endforeach
});
</script>
<script>
window.DONE = false;
$(function () {
    document.getElementById("judge").addEventListener("click", function(){
        mocha.run(function () {
            window.DONE = true;
        });
        Materialize.toast('Checked', 4000, 'blue');
    });
});
</script>
@endsection
