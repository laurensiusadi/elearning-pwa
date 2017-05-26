<?php use Carbon\Carbon; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col l8 m7 s12">
            <h5>Daftar Quiz</h5>
            <h4>Classroom {{ $classroom->nama }}</h4>
            @if($ismhs == false)
            <a href="/classroom/{{$classroom->id}}/quiz/create"
                class="btn green accent-3 waves-effect" style="margin-bottom: 0.5rem">Tambah Quiz</a>
            @endif
			@foreach($quizes as $quiz)
            <div class="card z-depth-0">
                <div class="card-content">
    				<span class="card-title">{{ $quiz->nama }}</span>
    				<p><span class="grey-text">Mulai:</span> {{ Carbon::parse($quiz->mulai)->toDayDateTimeString() }}</p>
                    <p><span class="grey-text">Selesai:</span> {{ Carbon::parse($quiz->selesai)->toDayDateTimeString() }}</p>
                    <p>{{$quiz->questions->count()}} Soal</p>
                </div>
                <div class="card-action">
					<a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="/classroom/{{ $classroom->id }}/quiz/{{$quiz->id}}/question"><i class="material-icons">list</i></a>
					@if($ismhs == false)
					<a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="/classroom/{{ $classroom->id }}/quiz/{{$quiz->id}}/edit"><i class="material-icons">edit</i></a>
                    <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $quiz->id }}"><i class="material-icons">delete</i></a>
                    @component('partials.deletemodal')
                        @slot('id')
                            {{ $quiz->id }}
                        @endslot
                        @slot('action')
                            {{ url('quiz').'/'.$quiz->id }}
                        @endslot
                    @endcomponent
					@endif
                </div>
            </div>
			@endforeach
        </div>
        <div class="col l4 m5 s12">
            <h5>&nbsp;</h5>
            <h4>Pengumuman</h4>
            @if(Auth::user()->hasRole('admin|dosen'))
            <div class="card z-depth-0">
            <div class="card-content">
                <h5>Pengumuman Baru</h5></br>
                <form role="form" method="POST" action="{{ url('/post') }}">
                    {{ csrf_field() }}
                    <div class="input-field">
                        <select name="classroom">
                            <option selected value="{{ $classroom->id }}">{{ $classroom->nama }}</option>
                        </select>
                        <label>Classroom</label>
                    </div>
                    <div class="input-field">
                        <textarea placeholder="" class="materialize-textarea" name="content" type="text" required></textarea>
                        <label for="text">Konten</label>
                    </div>
                    <div class="input-field">
                        <button class="btn btn-flat grey lighten-4 waves-effect waves-dark" type="submit" name="action" style="padding-inline-start:45px; width:100%">Buat<i class="material-icons right">send</i>
                        </button>
                    </div>
                </form><p></p>
            </div></div>
            @endif
            @foreach($classroom->posts as $post)
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
                    </p>
                </div>
            @endforeach
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
