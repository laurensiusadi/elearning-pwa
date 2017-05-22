@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h5>Daftar Soal</h5>
        <h4>Quiz {{ $quiz->nama }}</h4>
        <div class="card-panel z-depth-0">
            @if(Auth::user()->hasRole('dosen'))
            <a href="/classroom/{{$quiz->classroom->id}}/quiz/{{$quiz->id}}/edit"
                class="btn green accent-3 waves-effect">Edit Quiz</a>
            @endif
            @if($quiz->questions->count() == 0)
            <h6>Belum ada soal</h6>
            @else
            <ul class="collapsible" data-collapsible="accordion">
                @foreach($quiz->questions as $question)
                <li>
                <div class="collapsible-header">{{ $question->topik }}</div>
                <div class="collapsible-body"><span>{{ $question->deskripsi }}</span></div>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>
@endsection
