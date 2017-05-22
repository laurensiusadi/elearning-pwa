@extends('layouts.code')

@section('style')
@include('partials.codestyle')
@endsection

@section('content')
    <div class="row" style="margin: 5px;">
        <div class="col s12 l4">

            <ul class="collapsible z-depth-1" data-collapsible="accordion">
                <li class="active">
                    <div class="collapsible-header active">Detail Quiz</div>
                    <div class="collapsible-body">
                        <span>
                            <p>Question: {{ $question->topik }}</p>
                            <p>Waktu Pengerjaan: {{ $quiz->mulai.' - '.$quiz->selesai }}</p>
                            <p>Deskripsi: {{ $quiz->deskripsi }}</p>
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
<h4 id="coba">Hello World!</h4>
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
<textarea name="js">
</textarea>
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
@include('partials.codescript')
@endsection
