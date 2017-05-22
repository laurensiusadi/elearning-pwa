<?php use Carbon\Carbon; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
    <div class="col l8 m7 s12">
        @if(Auth::user()->hasRole('admin'))
        @include('admin.home')
        @else
        <h4>Classroom Saya</h4>
        @foreach(Auth::user()->classrooms as $classroom)
        <div class="card z-depth-0">
            <div class="card-content">
                <span class="card-title">{{ $classroom->nama }}</span>
                <p>{{ $classroom->subject->nama }}</p>
                <p>{{ $classroom->period->nama }}</p>
            </div>
            <div class="card-action">
            <a class="btn gradient-2 waves-effect waves-light" href="/classroom/{{ $classroom->id }}/quiz/">Masuk</a>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <div class="col l4 m5 s12">
        <h4>Pengumuman</h4>
            @foreach($posts as $post)
                <div class="card-panel z-depth-0">
                    @if(Auth::user()->hasRole('admin|dosen'))
                    <a class="delete modal-trigger right" href="#modal{{ $post->id }}">Delete</a>
                    @component('partials.deletemodal')
                        @slot('id')
                            {{ $post->id }}
                        @endslot
                        @slot('action')
                            /post/{{ $post->id }}
                        @endslot
                    @endcomponent
                    @endif
                    <p>{{ $post->content }}<br />
                    <span class="grey-text small">{{ $post->user->name }}&nbsp;&bull;
                    {{ Carbon::parse($post->created_at)->diffForHumans() }}
                    @if($post->classroom_id != 0)
                        &bull;&nbsp;{{ $post->classroom->nama }}
                    @else
                        &bull;&nbsp;Umum
                    @endif</span>
                    </p>
                </div>
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
