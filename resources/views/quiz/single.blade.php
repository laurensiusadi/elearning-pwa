@extends('layouts.template')

@section('style')
<link rel="stylesheet" href="{!! asset('css/codemirror/codemirror.css') !!}">
<link rel="stylesheet" href="{!! asset('css/codemirror/material.css') !!}">
<style>
    #code_editors { height: 100vh }
    #code_editors .code_box { height: 33%; width: 100%; position: relative }
    .code_box h3 { font-size: 13px; height: 30px; padding: 5px 10px; margin: 0; background: linear-gradient(#707070, #555); color: white; border-top: 1px solid #8F8F8F; border-bottom: 1px solid #202020; z-index: 10 }
    .code_box textarea { position: relative; left: 0; right: 0; top: 30px; bottom: 0; resize: none; border: 0; padding: 10px; font-family: monospace }
    .code_box textarea:focus { outline: none; background: #EFEFEF }
    #html.code_box { z-index: 101 }
    #css.code_box { z-index: 102 }
    #js.code_box { z-index: 103 }
    /* Output Area */
    #output { height: 100vh; left: 40%; top: 0; right: 0; bottom: 0; border: 5px solid #444; border-left-width: 10px; overflow: hidden }
    #output iframe { width: 100%; height: 100%; border: 0 }
    .cm-s-cc.CodeMirror{color:#fff}
    .cm-s-cc.CodeMirror .cm-comment{color:#939598}
    .cm-s-cc.CodeMirror .cm-property{color:#83fff5}
    .cm-s-cc.CodeMirror .cm-string{color:#ffe083}
    .cm-s-cc.CodeMirror .cm-atom{color:#cc7bc2}
    .cm-s-cc.CodeMirror .cm-attribute{color:#b4d353}
    .cm-s-cc.CodeMirror .cm-qualifier{color:#b4d353}
    .cm-s-cc.CodeMirror .cm-variable{color:#ff8973}
    .cm-s-cc.CodeMirror .cm-variable-2{color:#ff8973}
    .cm-s-cc.CodeMirror .cm-variable-3{color:#ff8973}
    .cm-s-cc.CodeMirror .cm-tag{color:#e85d7f}
    .cm-s-cc.CodeMirror .cm-bracket{color:#e85d7f}
    .cm-s-cc.CodeMirror .cm-keyword{color:#b3ccff}
    .cm-s-cc.CodeMirror .cm-def{color:#b3ccff}
    .cm-s-cc.CodeMirror .cm-number{color:#ff8973}
    .cm-s-cc.CodeMirror .cm-operator{color:#fff}
    .cm-s-cc.CodeMirror .cm-error{color:#fff}
    .cm-s-cc.CodeMirror .cm-builtin{color:#fff}
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col s12 l4">
            <h3>Detail Penugasan</h3>
            <!-- <a class="btn btn-sm btn-success pull-right" href="{{ url('enroll').'/'.$enrollid.'/quiz' }}">
    			<i class="fa fa-arrow-left"></i> Kembali
    		</a> -->
    		<p>Nama: {{ $quiz->nama }}</p>
    		<p>Waktu Pengerjaan: {{ $quiz->wmulai.' - '.$quiz->wselesai }}</p>
    		<p>Deskripsi: {{ $quiz->des }}</p>
    		@if($ismhs == false)
    		<h6>Jawaban</h6>
    		<div id="editor">{{ $quiz->jwb }}</div>
    		<br><a id="compile" class="btn btn-warning">Compilability Test</a>
    		@endif
        </div>
        <div class="col s12 l4">
        	<!-- Code Editors -->
        	<section id="code_editors">
        		<div id="html" class="code_box">
        			<h3>HTML</h3>
        			<textarea name="html"></textarea>
        		</div>
        		<div id="css" class="code_box">
        			<h3>CSS</h3>
        			<textarea name="css"></textarea>
        		</div>
        		<div id="js" class="code_box">
        			<h3>JavaScript</h3>
        			<textarea name="js"></textarea>
        		</div>
        	</section>
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
<script src="{!! asset('js/codemirror/codemirror.js') !!}"></script>
<script src="{!! asset('js/codemirror/mode/xml.js') !!}"></script>
<script src="{!! asset('js/codemirror/mode/htmlmixed.js') !!}"></script>
<script src="{!! asset('js/codemirror/mode/css.js') !!}"></script>
<script src="{!! asset('js/codemirror/mode/javascript.js') !!}"></script>
<script>
    (function() {

    // Base template
    var base_tpl =
            "<!doctype html>\n" +
            "<html>\n\t" +
      "<head>\n\t\t" +
      "<meta charset=\"utf-8\">\n\t\t" +
      "<title>Test</title>\n\n\t\t\n\t" +
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


    // EDITORS

    // CM OPTIONS
    var cm_opt = {
        mode: 'text/html',
        gutter: true,
        lineNumbers: true,
        lineWrapping: true,
        theme: "material",
    };

    // HTML EDITOR
    var html_box = document.querySelector('#html textarea');
    var html_editor = CodeMirror.fromTextArea(html_box, cm_opt);

    html_editor.on('change', function (inst, changes) {
    render();
    });

    // CSS EDITOR
    cm_opt.mode = 'css';
    var css_box = document.querySelector('#css textarea');
    var css_editor = CodeMirror.fromTextArea(css_box, cm_opt);

    css_editor.on('change', function (inst, changes) {
    render();
    });

    // JAVASCRIPT EDITOR
    cm_opt.mode = 'javascript';
    var js_box = document.querySelector('#js textarea');
    var js_editor = CodeMirror.fromTextArea(js_box, cm_opt);

    js_editor.on('change', function (inst, changes) {
    render();
    });

    // SETTING CODE EDITORS INITIAL CONTENT
    html_editor.setValue('<p>Hello World</p>');
    css_editor.setValue('body { color: red; }');


    // RENDER CALL ON PAGE LOAD
    // NOT NEEDED ANYMORE, SINCE WE RELY
    // ON CODEMIRROR'S onChange OPTION THAT GETS
    // TRIGGERED ON setValue
    // render();


    // NOT SO IMPORTANT - IF YOU NEED TO DO THIS
    // THEN THIS SHOULD GO TO CSS

    /*
        Fixing the Height of CodeMirror.
        You might want to do this in CSS instead
        of JS and override the styles from the main
        codemirror.css
    */
    var cms = document.querySelectorAll('.CodeMirror');
    for (var i = 0; i < cms.length; i++) {

        cms[i].style.position = 'absolute';
        cms[i].style.top = '30px';
        cms[i].style.bottom = '30px';
        cms[i].style.left = '0';
        cms[i].style.right = '0';
    cms[i].style.height = '100%';
    }
    /*cms = document.querySelectorAll('.CodeMirror-scroll');
    for (i = 0; i < cms.length; i++) {
        cms[i].style.height = '100%';
    }*/

    }());
    </script>
@endsection
