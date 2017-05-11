<?php use Carbon\Carbon; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h3>Daftar Soal dari Kursus {{ $course->nama }}</h3>
        <div class="card-panel z-depth-0">
        @if($ismhs == false)
        <a href="{{ url('enroll').'/'.$enroll->id.'/quiz/create' }}"
            class="btn green accent-3 waves-effect">Tambah Soal</a>
        @endif
				@foreach($quizes as $quiz)
                <div class="card z-depth-0">
                    <div class="card-content">
        				<span class="card-title">{{ $quiz->nama }}</span>
                        <p>{{ $quiz->des }}</p><br/>
        				<p><span class="grey-text">Mulai:</span> {{ Carbon::parse($quiz->wmulai)->toDayDateTimeString() }}</p>
                        <p><span class="grey-text">Selesai:</span> {{ Carbon::parse($quiz->wselesai)->toDayDateTimeString() }}</p>
                    </div>
                    <div class="card-action">
    					<a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('enroll').'/'.$enroll->id.'/quiz/'.$quiz->id }}"><i class="material-icons">list</i></a>
    					<a class="btn btn-small green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Jawaban" href="{{ url('enroll').'/'.$enroll->id.'/quiz/'.$quiz->id }}/answer"><i class="material-icons">class</i></a>
    					@if($ismhs == false)
    					<a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="{{ url('enroll').'/'.$enroll->id.'/quiz/'.$quiz->id }}/edit"><i class="material-icons">edit</i></a>
                        <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $quiz->id }}"><i class="material-icons">delete</i></a>
                        @component('partials.deletemodal')
                            @slot('id')
                                {{ $quiz->id }}
                            @endslot
                            @slot('action')
                                {{ url('enroll').'/'.$enroll->id.'/quiz/'.$quiz->id }}
                            @endslot
                        @endcomponent
						<!-- <a id="datatable-delete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete" data-id="{{ url('enroll').'/'.$enroll->id.'/quiz/'.$quiz->id }}" data-label="{{ $quiz->nama }}"><i class="material-icons">delete</i></a> -->
    					@endif
                    </div>
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
    });
</script>
@endsection
