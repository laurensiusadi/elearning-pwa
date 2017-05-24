<?php use Carbon\Carbon; ?>
@extends('layouts.code')

@section('style')
@include('partials.codestyle')
<style>
/*[class*="scr-"] {padding: 0.1%; float: left; position: relative; min-height: 1px; transition: 0.3s ease}
.scr-full { width:80% }
.scr-min { width:10% }
.scr-min>div:before { content: ""; position: absolute; top: 0; left; 0; width: 100%; height: 100%; background: #0072FF; z-index: 10 }
.scr-normal { width: 33.33333333% }
#desc-full, #code-full, #rend-full { float: right; position: relative; top: 10px; right: 10px; z-index: 11}*/
</style>
@endsection

@section('content')
    <div class="row" style="margin: 5px;">
        <div id="desc" class="col l4 m12 s12">
            <div class="card-panel z-depth-0" style="padding-bottom:20px; height: 490px; overflow-y: auto">
                <!-- <a id="desc-full" class="right"><i class="material-icons">fullscreen</i></a> -->
                <h5>{{ $question->topik }}</h5>
                <p>{!! $question->deskripsi !!}</p>
            </div>
        </div>
        <div id="code" class="col l4 m12 s12" style="margin-top:0.5rem; margin-bottom: 1rem; max-height:490px">
            <!-- <a id="code-full" class="right"><i class="material-icons">fullscreen</i></a> -->
            <!-- Code Editors -->
            <div class="col s12">
                <ul class="tabs" style="background-color: #1a2327">
                    <li class="tab col s4"><a href="#html">HTML</a></li>
                    <li class="tab col s4"><a href="#css">CSS</a></li>
                    <li class="tab col s4"><a href="#js">JS</a></li>
                </ul>
            </div>
    		<div id="html" class="col s12 code_box">
<textarea name="html">
<h1 id="coba">Hello World!</h1>
</textarea>
    		</div>
    		<div id="css" class="col s12 code_box">
<textarea name="css">
body {
    margin: 0;
    padding: 1em;
    font-family: arial, sans-serif;
    color: #000;
}
</textarea>
    		</div>
    		<div id="js" class="col s12 code_box">
<textarea name="js">
</textarea>
    		</div>
            <div class="col s12" style="position:relative;top:-44px;z-index:7;padding:0 8px;float:right">
                <button id="run" class="btn white-text green accent-4 left waves-effect waves-light">Run</button>
                <button class="btn white-text gradient-2 right waves-effect waves-light">Submit</button>
            </div>
        </div>
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
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<!-- <script>
$(document).ready(function(){
    $("#desc-full").click(function(){
        if($("#desc").hasClass("scr-full")){
            $("#desc").attr('class','scr-normal');
            $("#code").attr('class','scr-normal');
            $("#rend").attr('class','scr-normal');
        } else {
            $("#desc").attr('class','scr-full');
            $("#code").attr('class','scr-min');
            $("#rend").attr('class','scr-min');
        }
    });
    $("#code-full").click(function(){
        if($("#code").hasClass("scr-full")){
            $("#desc").attr('class','scr-normal');
            $("#code").attr('class','scr-normal');
            $("#rend").attr('class','scr-normal');
        } else {
            $("#desc").attr('class','scr-min');
            $("#code").attr('class','scr-full');
            $("#rend").attr('class','scr-min');
        }
    });
    $("#rend-full").click(function(){
        if($("#rend").hasClass("scr-full")){
            $("#desc").attr('class','scr-normal');
            $("#code").attr('class','scr-normal');
            $("#rend").attr('class','scr-normal');
        } else {
            $("#desc").attr('class','scr-min');
            $("#code").attr('class','scr-min');
            $("#rend").attr('class','scr-full');
        }
    });
});
</script> -->
@endsection
