<link rel="stylesheet" href="{!! asset('codemirror/codemirror.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/material.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/lint/lint.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/hint/show-hint.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/fold/foldgutter.css') !!}">
<style>
nav{background-color:#252E36}
/*main{background-color:#4E5D6B}*/
.code_box textarea{ position:relative; left:0; right:0; top:30px; bottom:0; resize:none; border:0; padding:10px; font-family:monospace }
.code_box textarea:focus {outline:none;background:#EFEFEF}
#mocha h1,h2{margin:0}
#mocha h1{margin-top:15px;font-size:1em;font-weight:200}
#mocha .suite .suite h1{margin-top:0;font-size:.8em}
#mocha h2{font-size:12px;font-weight:400;cursor:pointer}
#mocha .suite{margin-left:15px}
#mocha .test{margin-left:15px}
#mocha .test:hover h2::after{position:relative;top:0;right:-10px;content:'(view source)';font-size:12px;font-family:arial;color:#888}
#mocha .test.pending:hover h2::after{content:'(pending)';font-family:arial}
#mocha .test.pass.medium .duration{background:#C09853}
#mocha .test.pass.slow .duration{background:#B94A48}
#mocha .test.pass::before{content:'✓';font-size:12px;display:block;float:left;margin-right:5px}
#mocha .test.pass .duration{font-size:9px;margin-left:5px;padding:2px 5px;color:#fff;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.2);-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,.2);box-shadow:inset 0 1px 1px rgba(0,0,0,.2);-webkit-border-radius:5px;-moz-border-radius:5px;-ms-border-radius:5px;-o-border-radius:5px;border-radius:5px}
#mocha .test.pass.fast .duration{display:none}
#mocha .test.pending{color:#0b97c4}
#mocha .test.pending::before{content:'◦';color:#0b97c4}
#mocha .test.fail{color:#c00}
#mocha .test.fail pre{color:#000}
#mocha .test.fail::before{content:'✖';font-size:12px;display:block;float:left;margin-right:5px;color:#c00}
#mocha .test pre.error{color:#c00}
#mocha .test pre{display:inline-block;font:12px/1.5 monaco,monospace;margin:5px;padding:15px;border:1px solid #eee;border-bottom-color:#ddd;-webkit-border-radius:3px;-webkit-box-shadow:0 1px 3px #eee}
#error{color:#c00;font-size:1.5px em;font-weight:100;letter-spacing:1px}
#stats{font-size:12px;margin:0;color:#888}
#stats .progress{float:right;padding-top:0;height:40px}
#stats em{color:#000}
#stats li{display:inline-block;margin:0 5px;list-style:none;padding-top:11px}
/*code .comment{color:#ddd}
code .init{color:#2F6FAD}
code .string{color:#5890AD}
code .keyword{color:#8A6343}
code .number{color:#2F6FAD}*/
</style>
