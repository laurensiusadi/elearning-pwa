<?php use Carbon\Carbon; use App\Enrollment; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
    <div class="col l8 m7 s12 main-content">
        @if(Auth::user()->hasRole('admin'))
        @include('admin.home')
        @else
        <h5 class="main-title">Classroom Saya</h5>
        @foreach(Auth::user()->classrooms as $classroom)
        <div class="card">
            <div class="card-content">
                <span class="card-title">{{ $classroom->nama }}</span>
                <p>{{ $classroom->subject->nama }}</p>
                <p>{{ $classroom->period->nama }}</p>
            </div>
            <div class="card-action">
            <a class="btn gradient-2 waves-effect waves-light" href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/">Masuk</a>
            </div>
        </div>
        @endforeach
        @if(Auth::user()->hasRole('dosen'))
        <h5 class="main-title">Bank Soal</h5>
        <div class="card-panel">
            <h5>Ada {{ $questionsCount }} Soal</h5>
            <a href="/question">Lihat Bank Soal <i class="material-icons tiny">arrow_forward</i></a>
        </div>
        @endif
        @endif
    </div>
    <div class="col l4 m5 s12 side-content">
        <h5 class="main-title">Pengumuman</h5>
            @foreach($posts as $post)
                @if(in_array($post->classroom_id, Auth::user()->classrooms->pluck('id')->toArray()) OR $post->classroom_id == 0)
                    <p>{{ $post->content }}<br />
                    <span class="grey-text small">{{ $post->user->name }}&nbsp;&bull;
                    {{ Carbon::parse($post->created_at)->diffForHumans() }}
                    @if($post->classroom_id != 0)
                        <br/>{{ $post->classroom->nama }}
                    @else
                        <br/>Umum
                    @endif</span>
                    @if(Auth::user()->hasRole('admin|dosen') AND Auth::id() == $post->user_id)
                    <br/><a class="delete modal-trigger" href="#modal{{ $post->id }}">Delete</a></p>
                    @component('partials.deletemodal')
                        @slot('id')
                            {{ $post->id }}
                        @endslot
                        @slot('action')
                            /post/{{ $post->id }}
                        @endslot
                    @endcomponent
                    @else
                    </p>
                    @endif
                @endif
            @endforeach
            {{ $posts->links() }}
    </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
      $('.modal').modal();
    });
</script>
@endsection
