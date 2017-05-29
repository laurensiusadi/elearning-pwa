<?php use Carbon\Carbon; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h6 class="main-title">Daftar Soal</h6>
        <h4 class="main-title" style="margin: 0 0 5px 0">Quiz {{ $quiz->nama }}
        <h6 class="grey-text" style="margin: 0 0 25px 0"><strong>
            <i class="material-icons tiny">date_range</i>&nbsp;&nbsp;{{ Carbon::parse($quiz->mulai)->toFormattedDateString() }} &ndash; {{ Carbon::parse($quiz->selesai)->toFormattedDateString() }}&nbsp;&nbsp;
            <!-- <i class="material-icons tiny">today</i>&nbsp;&nbsp;{{ Carbon::parse($quiz->created_at)->diffForHumans() }}<br /> -->
            <i class="material-icons tiny">assignment</i>&nbsp;&nbsp;{{$quiz->questions->count()}} Soal
        </strong></h6>
        @if(Auth::user()->hasRole('dosen'))
        <a href="/classroom/{{$quiz->classroom->id}}/quiz/{{$quiz->id}}/edit"
            class="btn-link">Choose questions for this quiz <i class="material-icons tiny">edit</i></a>
        @endif</h4>
        <div class="card-panel">
            @if($quiz->questions->count() == 0)
            <h6>Belum ada soal</h6>
            @else
            <ul class="collection">
                <?php $beforeDone = false; ?>
                @foreach($questions as $question)
                @if(Auth::user()->hasRole('mhs'))
                    @if($question->answers()->count() > 0)
                        @if($question->answers()->where('user_id', Auth::user()->id)->first()->done == true)
                            <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                            <a href="/classroom/{{ $quiz->classroom->id }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="secondary-content"><i class="material-icons right">check</i></a>
                            </li>
                            <?php $beforeDone = true; ?>
                        @elseif($question->answers()->where('user_id', Auth::user()->id)->first()->done == false)
                        <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                            <a href="/classroom/{{ $quiz->classroom->id }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="secondary-content"><i class="material-icons right">arrow_forward</i></a>
                        </li>
                        @endif
                    @elseif($beforeDone == true)
                    <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                        <a href="/classroom/{{ $quiz->classroom->id }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="secondary-content"><i class="material-icons right">arrow_forward</i></a>
                        <?php $beforeDone = false; ?>
                    </li>
                    @else
                    <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                        <a disabled class="secondary-content right grey-text"><i class="material-icons right">lock_outline</i></a>
                    </li>
                    @endif
                @else
                <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                    <a href="/question/{{ $question->id }}/edit" class="btn-link right"><i class="material-icons tiny">edit</i>&nbsp;&nbsp;</a>
                </li>
                @endif
                @endforeach
            </ul>
            @endif
        </div>
    </div>
</div>
@endsection
