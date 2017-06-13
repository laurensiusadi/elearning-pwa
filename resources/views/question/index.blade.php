<?php use Carbon\Carbon; ?>
@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/datatables.materialize.css') !!}">
@endsection
@section('content')
<div class="container">
    <div class="row">
    <h4>Bank Soal</h4>
    <div class="card-panel">
    <a class="btn green accent-4 left" href="/question/create">Add Question</a>
            @if($questions->count()>0)
            <table id="datatable" class="table highlight bordered">
            <thead>
                <tr>
                    <th>Topik Soal</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                <tr>
                <td data-label="Topik Soal">{{ $question->topik }}</td>
                <td data-label="Tanggal Dibuat">{{ Carbon::parse($question->created_at)->toFormattedDateString() }}</td>
                <td data-label="Aksi">
                    <a href="/question/{{ $question->id }}/edit" class="btn btn-small amber"><i class="material-icons">edit</i></a>
                    <a href="#modal{{ $question->id }}delete" class="btn btn-small red"><i class="material-icons">delete</i></a>
                    @component('partials.deletemodal')
                        @slot('id')
                            {{ $question->id }}delete
                        @endslot
                        @slot('action')
                            {{ url('question').'/'.$question->id }}
                        @endslot
                    @endcomponent
                </td>
                @endforeach
            </table>
            @else
            <h5>Belum ada soal</h5>
            @endif
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
@include('partials.datatable')
@endsection
