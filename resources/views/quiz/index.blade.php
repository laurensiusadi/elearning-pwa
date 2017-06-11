<?php use Carbon\Carbon; use App\Enrollment; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col l8 m7 s12 main-content">
            <h6 class="main-title">Daftar Quiz</h6>
            <h4 class="main-title">Classroom {{ $classroom->nama }}</h4>
            @if($ismhs == false)
            <a href="/classroom/{{$classroom->enrollmentId($classroom)}}/quiz/create"
                class="btn green accent-3 waves-effect" style="margin-bottom: 0.5rem">Tambah Quiz</a>
            @endif
			@foreach($quizes as $quiz)
            <div class="card">
                <div class="card-content">
    				<span class="card-title">{{ $quiz->nama }}</span>
    				<p>
                        <i class="material-icons tiny">date_range</i>&nbsp;&nbsp;{{ Carbon::parse($quiz->mulai)->toFormattedDateString() }} &ndash; {{ Carbon::parse($quiz->selesai)->toFormattedDateString() }} <br />
                        <!-- <i class="material-icons tiny">today</i>&nbsp;&nbsp;{{ Carbon::parse($quiz->created_at)->diffForHumans() }}<br /> -->
                        <i class="material-icons tiny">assignment</i>&nbsp;&nbsp;{{$quiz->questions->count()}} Soal
                    </p>
                </div>
                <div class="card-action">
					<a class="btn btn-small gradient-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{$quiz->id}}/question">Masuk <i class="material-icons right">arrow_forward</i></a>
					@if($ismhs == false)
					<a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="/classroom/{{ $classroom->enrollmentId($classroom) }}/quiz/{{$quiz->id}}/edit"><i class="material-icons">edit</i></a>
                    <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $quiz->id }}delete"><i class="material-icons">delete</i></a>
                    @component('partials.deletemodal')
                        @slot('id')
                            {{ $quiz->id }}delete
                        @endslot
                        @slot('action')
                            /classroom/{{$classroom->enrollmentId($classroom)}}/quiz/{{$quiz->id}}
                        @endslot
                    @endcomponent
					@endif
                </div>
            </div>
			@endforeach
        </div>
        <div class="col l4 m5 s12 side-content">
            <h5 class="main-title">Pengumuman</h5>
            @if(Auth::user()->hasRole('admin|dosen'))
                <form role="form" method="POST" action="{{ url('/post') }}">
                    {{ csrf_field() }}
                    <h5>Pengumuman Baru</h5><br/>
                    <div class="input-field">
                        <select name="classroom">
                            <option selected value="{{ $classroom->id }}">{{ $classroom->nama }}</option>
                        </select>
                        <label>Classroom</label>
                    </div>
                    <div class="input-field">
                        <textarea placeholder="" class="materialize-textarea" name="content" type="text" required></textarea>
                        <label class="active" for="text">Konten</label>
                    </div>
                    <div class="input-field">
                        <button class="btn-flat white-text slate waves-effect waves-dark" type="submit" name="action" style="padding-inline-start:45px; width:100%">Buat<i class="material-icons right">send</i>
                        </button>
                    </div>
                </form><p></p>
            @endif
            @foreach($classroom->posts as $post)
                    <p>{{ $post->content }}<br />
                    <span class="grey-text small">{{ $post->user->name }}&nbsp;&bull;
                    {{ Carbon::parse($post->created_at)->diffForHumans() }}
                    @if($post->classroom_id != 0)
                        <br/>{{ $post->classroom->nama }}
                    @else
                        <br/>Umum
                    @endif</span>
                    @if(Auth::user()->hasRole('admin|dosen'))
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
