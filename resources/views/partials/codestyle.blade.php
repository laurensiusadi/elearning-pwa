<link rel="stylesheet" href="{!! asset('codemirror/codemirror.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/material.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/lint/lint.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/hint/show-hint.css') !!}">
<link rel="stylesheet" href="{!! asset('codemirror/addon/fold/foldgutter.css') !!}">
<style>
.code_box textarea {position:relative;left:0;right:0;top:30px;bottom:0;resize:none;border:0;padding:10px;font-family:monospace}
.code_box textarea:focus {outline:none;background:#EFEFEF}
#output {height:442px;border:1px solid #ddd;overflow:hidden;background-color:white}
#output iframe {width:100%;height:100%;border:0}
#browser{height:48px;border:1px solid #ddd;border-bottom:none;padding:6px}
#browser>div{padding-left:16px;height:36px;line-height:36px;border:1px solid #cacaca; border-radius:2px}
</style>
