<?php use Carbon\Carbon; use App\Enrollment; ?>
@extends('layouts.template')

@section('title')
    <a href="/classroom/{{$classroom->enrollmentId($classroom)}}/quiz">
        <i class="material-icons left">arrow_back</i>{{ $classroom->nama }}
    </a>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <h6 class="main-title">Daftar Soal</h6>
        <h4 class="main-title" style="margin: 0 0 5px 0">Quiz {{ $quiz->nama }}</h4>
        <h6 style="margin: 0 0 25px 0; font-weight: 400">
            <i class="material-icons tiny">date_range</i>&nbsp;&nbsp;{{ Carbon::parse($quiz->mulai)->toFormattedDateString() }} &ndash; {{ Carbon::parse($quiz->selesai)->toFormattedDateString() }}&nbsp;&nbsp;
            <!-- <i class="material-icons tiny">today</i>&nbsp;&nbsp;{{ Carbon::parse($quiz->created_at)->diffForHumans() }}<br /> -->
            <i class="material-icons tiny">assignment</i>&nbsp;&nbsp;{{$quiz->questions->count()}} Soal
        </h6>
        @if(Auth::user()->hasRole('dosen'))
        <a href="/classroom/{{$classroom->enrollmentId($classroom)}}/quiz/{{$quiz->id}}/edit"
            class="btn-link">Choose questions for this quiz <i class="material-icons tiny">edit</i></a>
        @else
        <a href="/classroom/{{$classroom->enrollmentId($classroom)}}/quiz/{{$quiz->id}}/edit"
            class="offline-btn btn gradient-2">Save offline <i class="material-icons tiny right">file_download</i>
        </a>
        @endif
        <div class="card-panel" style="margin-top:20px">
            @if($quiz->questions->count() == 0)
            <h6>Belum ada soal</h6>
            @else
            <ul class="collection">
                <?php $beforeDone = false; ?>
                @foreach($questions as $question)
                @if(Auth::user()->hasRole('mhs'))
                    @if($question->answers()->where('user_id', Auth::user()->id)->count() == 0 AND $loop->index == 0)
                    <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                        <a href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="secondary-content"><i class="material-icons right">arrow_forward</i></a>
                        <?php $beforeDone = false; ?>
                    </li>
                    @elseif($question->answers()->where('user_id', Auth::user()->id)->count() > 0)
                        @if($question->answers()->where('user_id', Auth::user()->id)->count() == 0 AND $loop->index == 0)
                        <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                            <a href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="secondary-content"><i class="material-icons right">arrow_forward</i></a>
                        </li>
                        @elseif($question->answers()->where('user_id', Auth::user()->id)->first()->done == false)
                        <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                            <a href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="secondary-content"><i class="material-icons right">arrow_forward</i></a>
                            <?php $beforeDone = false; ?>
                        </li>
                        @elseif($question->answers()->where('user_id', Auth::user()->id)->first()->done == true)
                            <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                            <a href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="green-text text-accent-4 secondary-content"><i class="material-icons right">check</i></a>
                            </li>
                            <?php $beforeDone = true; ?>
                        @endif
                    @elseif($beforeDone == true)
                    <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                        <a href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="secondary-content"><i class="material-icons right">arrow_forward</i></a>
                        <?php $beforeDone = false; ?>
                    </li>
                    @else
                    <li class="collection-item">{{ $loop->index+1 }}. {{ $question->topik }}
                        <a href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}" class="secondary-content grey-text"> <i class="material-icons right">arrow_forward</i></a>
                        <?php $beforeDone = false; ?>
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
@section('scripts')
<script>
    var cacheButton = document.querySelector('.offline-btn');
    if(cacheButton) {
        cacheButton.addEventListener('click', function(event) {
            event.preventDefault();
            var pages = [];

            @foreach($questions as $question)
pages.push(new Request('/classroom/{{ Enrollment::where('classroom_id',$classroom->id)->where('user_id', Auth::id())->first()->id }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}', {credentials: 'same-origin'}),);
            @endforeach

            caches.open('shell-content').then(function(cache) {
                $('.offline-btn').html('Saving offline <div class="preloader-wrapper tiny right active" style="top:8px;margin-left:15px"><div class="spinner-layer spinner-white-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>')
                var updateCache = cache.addAll(pages);
                updateCache.then(function() {
                     $('.offline-btn').html('Offline Ready <i class="material-icons right">check</i>');
                    // Materialize.toast('Quiz now available offline', 4000, 'gradient-2');
                }).catch(function (error) {
                    Materialize.toast('Quiz could not be saved offline', 4000, 'materialize-red');
                });
            });
        });
    }
</script>
@endsection
