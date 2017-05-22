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
                        <select name="classroom">
                            <option value="0">Pengumuman Umum</option>
                            @foreach($classrooms as $classroom)
                                <option value="{{ $classroom->id }}">{{ $classroom->nama }}</option>
                            @endforeach
                        </select>
                        <label>Classroom</label>
                    </div>
                    <div class="input-field">
                        <textarea placeholder="" class="materialize-textarea" name="content" type="text" required></textarea>
                        <label for="text">Konten</label>
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
                <p>{{ $post->content }}<br />
                <span class="grey-text small">{{ $post->user->name }}&nbsp;&bull;
                <!-- {{ date('F d, Y H:i', strtotime($post->created_at)) }}<br /> -->
                {{ Carbon::parse($post->created_at)->diffForHumans() }}
                @if($post->classroom_id != 0)
                    &bull;&nbsp;{{ $post->classroom->nama }}
                @else
                    &bull;&nbsp;Umum
                @endif</span>
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
      $('select').material_select();
    });
</script>
@endsection
