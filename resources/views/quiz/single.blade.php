@extends('layouts.code')

@section('style')
<link rel="stylesheet" href="{!! asset('codemirror/codemirror.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/material.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/lint/lint.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/hint/show-hint.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/fold/foldgutter.css') !!}">
<style>
    /*#code_editors { height: 100vh }*/
    /*#code_editors .code_box { margin-bottom: 30px; height: 33.3333%; width: 100%; position: relative }*/
    .code_box textarea { position: relative; left: 0; right: 0; top: 30px; bottom: 0; resize: none; border: 0; padding: 10px; font-family: monospace }
    .code_box textarea:focus { outline: none; background: #EFEFEF }
    /*#html.code_box { z-index: 5 }
    #css.code_box { z-index: 6 }
    #js.code_box { z-index: 7 }*/
    /* Output Area */
    #output { height: 440px; border: 5px solid #DDD; overflow: hidden }
    #output iframe { width: 100%; height: 100%; border: 0 }
</style>
@endsection

@section('content')
    <div class="row" style="margin: 5px;">
        <div class="col s12 l4">
    		<!-- {{ $quiz->jwb }} -->

            <ul class="collapsible z-depth-1" data-collapsible="accordion">
                <li class="active">
                    <div class="collapsible-header active">Detail Penugasan</div>
                    <div class="collapsible-body">
                        <span>
                            <p>Nama: {{ $quiz->nama }}</p>
                            <p>Waktu Pengerjaan: {{ $quiz->wmulai.' - '.$quiz->wselesai }}</p>
                            <p>Deskripsi: {{ $quiz->des }}</p>
                        </span>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header">Pendahuluan</div>
                    <div class="collapsible-body">
                        <span>Lorem ipsum dolor sit amet.</span>
                    </div>
                </li>
                <li>
                    <div class="collapsible-header">Instruksi</div>
                    <div class="collapsible-body">
                        <span>Lorem ipsum dolor sit amet.</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col s12 l4">
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
<h4>Hello World!</h4>
                </textarea>
    		</div>
    		<div id="css" class="col s12 code_box">
    			<textarea name="css">
body {
    margin: 0;
    padding: 0.5em;
    font-family: arial, sans-serif;
    color: #000;
}
                </textarea>
    		</div>
    		<div id="js" class="col s12 code_box">
    			<textarea name="js"></textarea>
    		</div>
        </div>
        <div class="col s12 l4">
        	<!-- Sandboxing -->
        	<section id="output">
        		<iframe></iframe>
        	</section>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('codemirror/codemirror.js') }}"></script>
<script src="{{ asset('codemirror/addon/comment/comment.js') }}"></script>
<script src="{{ asset('codemirror/addon/lint/lint.js') }}"></script>
<script src="{{ asset('codemirror/addon/hint/show-hint.js') }}"></script>
<script src="{{ asset('codemirror/addon/fold/foldcode.js') }}"></script>
<script src="{{ asset('codemirror/addon/fold/foldgutter.js') }}"></script>
<script src="{{ asset('codemirror/grammars/css.js') }}"></script>
<script src="{{ asset('codemirror/grammars/htmlmixed.js') }}"></script>
<script src="{{ asset('codemirror/grammars/javascript.js') }}"></script>
<script src="{{ asset('codemirror/codemirror_grammar.min.js') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{ asset('codemirror/addon/mode/xml.js') }}"></script>
<script src="{{ asset('codemirror/addon/mode/htmlmixed.js') }}"></script>
<script src="{{ asset('codemirror/addon/mode/css.js') }}"></script>
<script src="{{ asset('codemirror/addon/mode/javascript.js') }}"></script>
<script>
    (function() {

    // Base template
    var base_tpl =
            "<!doctype html>\n" +
            "<html>\n\t" +
      "<head>\n\t\t" +
      "<meta charset=\"utf-8\">\n\t\t" +
      "<title>Render</title>\n\n\t\t\n\t" +
      "</head>\n\t" +
      "<body>\n\t\n\t" +
      "</body>\n" +
      "</html>";

    var prepareSource = function() {
        var html = html_editor.getValue(),
                css = css_editor.getValue(),
                js = js_editor.getValue(),
                src = '';

        // HTML
        src = base_tpl.replace('</body>', html + '</body>');

        // CSS
        css = '<style>' + css + '</style>';
        src = src.replace('</head>', css + '</head>');

        // Javascript
        js = '<script>' + js + '<\/script>';
        src = src.replace('</body>', js + '</body>');

        return src;
    };

    var render = function() {
        var source = prepareSource();

        var iframe = document.querySelector('#output iframe'),
                iframe_doc = iframe.contentDocument;

        iframe_doc.open();
        iframe_doc.write(source);
        iframe_doc.close();
    };

    // HTML EDITOR
    var html_editor = codemirror_grammar_demo(document.querySelector("#html textarea"), [
        {language : "htmlmixed", grammar : htmlmixed_grammar}
    ]);
    html_editor.on('change', function (inst, changes) {
        render();
    });

    // CSS EDITOR
    var css_editor = codemirror_grammar_demo(document.querySelector("#css textarea"), [
        {language : "css", grammar : css_grammar}
    ]);
    css_editor.on('change', function (inst, changes) {
        render();
    });

    // JAVASCRIPT EDITOR
    var js_editor = codemirror_grammar_demo(document.querySelector("#js textarea"), [
        {language : "javascript", grammar : js_grammar}
    ]);
    js_editor.on('change', function (inst, changes) {
        render();
    });

    window.onload = function() {
        render();
        $('.collapsible').collapsible('open', 0);
    };
    }());
    </script>
@endsection
