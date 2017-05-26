@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h5>Daftar Soal</h5>
        <h4>Quiz {{ $quiz->nama }}
        @if(Auth::user()->hasRole('dosen'))
        <a href="/classroom/{{$quiz->classroom->id}}/quiz/{{$quiz->id}}/edit"
            class="btn-link"><i class="material-icons">edit</i></a>
        @endif</h4>
        <div class="card-panel z-depth-0">
            @if($quiz->questions->count() == 0)
            <h6>Belum ada soal</h6>
            @else
            <ul class="collection">
                @foreach($quiz->questions as $question)
                <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                    <a href="/classroom/{{ $quiz->classroom->id }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="btn-link right">Enter</a>
                    @if(Auth::user()->hasRole('dosen'))
                    <a href="/question/{{ $question->id }}/edit" class="btn-link right"><i class="material-icons tiny">edit</i>&nbsp;&nbsp;</a>
                    @endif
                </li>
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>
@endsection
