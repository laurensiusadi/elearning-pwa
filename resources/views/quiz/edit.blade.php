@extends('layouts.template')

@section('content')
<div class="container">
<div class="row">
    <h4>Edit Quiz {{ $quiz->nama }}</h4>
    <div class="card-panel z-depth-0">
        <a href="/classroom/{{$classroom_id}}/quiz/{{$quiz_id}}/question/create"
            class="btn green accent-3 waves-effect">Tambah Question</a>
        @if($quiz->questions->count() > 0)
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
