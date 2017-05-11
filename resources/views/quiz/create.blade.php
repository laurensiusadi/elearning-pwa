@extends('layouts.template')

@section('content')
<div class="container">
<div class="row">
    <div class="col l4 m5 s12">
        <h5>List Soal dari Kursus</h5>
        <ul class="collapsible z-depth-0" data-collapsible="accordion">
        @foreach( $quizes as $quiz)
        <li>
            <div class="collapsible-header">{{ $loop->index+1 }}. {{ $quiz->nama }}</div>
            <div class="collapsible-body">{{ $quiz->des }}</div>
        </li>
        @endforeach
        </ul>
    </div>
    <div class="col l8 m7 s12">
        <h5>Buat Soal Baru</h5>
        <div class="card-panel z-depth-0">
            <form role="form" method="POST" action="{{ url('/post') }}">
                {{ csrf_field() }}
                <div class="input-field">
                    <input placeholder="" name="judul" type="text" required>
                    <label for="judul">Topik</label>
                </div>
                <div class="input-field">
                    <textarea placeholder="" class="materialize-textarea" name="text" type="text" required></textarea>
                    <label for="text">Instruksi</label>
                </div>
                <div class="input-field">
                    <button class="btn green waves-effect waves-dark right" type="submit" name="action" style="padding-inline-start:45px">Buat
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form><p class="clearfix"></p>
        </div>
    </div>
</div>
</div>
@endsection
