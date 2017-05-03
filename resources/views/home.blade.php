<?php use Carbon\Carbon; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
    <div class="col l8 m7 s12">
        <h4>Kursus Saya</h4>
        @foreach($enrolls as $enroll)
        <div class="card z-depth-0">
            <div class="card-content">
                <span class="card-title">{{ $enroll->course->nama }}</span>
                <p>{{ $enroll->course->subject->nama }}</p>
                <p>{{ $enroll->course->period->nama }}</p>
            </div>
            <div class="card-action">
            <a class="btn gradient-2 waves-effect waves-light" href="{{ url('enroll').'/'.$enroll->id.'/quiz' }}">Masuk</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col l4 m5 s12">
        <h4>Pengumuman</h4>
        <!-- <ul class="collection"> -->
            @if(Auth::user()->hasRole('admin|dosen'))
            <!-- <li class="collection-item"> --><div class="card z-depth-0">
            <div class="card-content">
                <h5>Pengumuman Baru</h5></br>
                <form role="form" method="POST" action="{{ url('/post') }}">
                    {{ csrf_field() }}
                    <div class="input-field">
                        <input placeholder="" name="judul" type="text" required>
                        <label for="judul">Judul</label>
                    </div>
                    <div class="input-field">
                        <textarea placeholder="" class="materialize-textarea" name="text" type="text" required></textarea>
                        <label for="text">Deskripsi</label>
                    </div>
                    <div class="input-field">
                        <button class="btn btn-flat grey lighten-4 waves-effect waves-dark" type="submit" name="action" style="padding-inline-start:45px; width:100%">Buat
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form><p></p>
            <!-- </li> --></div></div>
            @endif
        @foreach($posts as $post)
            <!-- <li class="collection-item"> --><div class="card-panel z-depth-0">
                @if(Auth::user()->hasRole('admin|dosen'))
                <a class="modal-trigger right" href="#modal{{ $post->id }}">Delete</a>
                    @include('post.deletemodal')
                @endif
                <span class="title">{{ $post->judul }}</span>
                <p>{{ $post->text }}<br />
                <span class="grey-text">{{ $post->user->name }}<br />
                <!-- {{ date('F d, Y H:i', strtotime($post->created_at)) }}<br /> -->
                {{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                </p>
            <!-- </li> --></div>
        @endforeach
        <!-- </ul> -->
    </div>
    </div>
</div>
@endsection
@section('scripts')
@include('partials.session')
<script>
    $(document).ready(function(){
      $('.modal').modal();
    });
</script>
@endsection
