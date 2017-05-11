<?php use Carbon\Carbon; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <h4>Pengumuman</h4>
    <div class="row">
        <div class="col l4 m5 s12">
            <div class="card z-depth-0">
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
            </div></div>
        </div>
        <div class="col l8 m7 s12">
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
                <p><strong>{{ $post->judul }}</strong><br />
                {{ $post->text }}<br />
                <span class="grey-text">{{ $post->user->name }}&nbsp;&bull;
                <!-- {{ date('F d, Y H:i', strtotime($post->created_at)) }}<br /> -->
                {{ Carbon::parse($post->created_at)->diffForHumans() }}</span>
                </p>
            </div>
            @endforeach
            <span class="center">{{ $posts->links() }}</span>
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