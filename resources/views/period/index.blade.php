<?php use Carbon\Carbon; ?>
@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/dataTables.materialize.css') !!}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Periode Perkuliahan</h4>
        <div class="card-panel">
            <a class="btn green accent-4 left" href="/period/create">Add Periode</a>
            <table id="datatable" class="table highlight bordered">
    			<thead>
    				<tr>
    					<th>Nama Periode</th>
    					<th>Tahun</th>
    					<th>Semester</th>
    					<th>Tanggal Mulai</th>
    					<th>Tanggal Selesai</th>
    					<th>Aksi</th>
    				</tr>
    			</thead>
    			<tbody>
    				@if(count($periods) > 0)
    				@foreach($periods as $period)
    				<tr>
    					<td data-label="Nama Periode">{{ $period->nama }}</td>
    					<td data-label="Tahun">{{ $period->tahun }}</td>
    					<td data-label="Semester">{{ $period->semester }}</td>
    					<td data-label="Tanggal Mulai">{{ Carbon::parse($period->mulai)->toFormattedDateString() }}</td>
    					<td data-label="Tanggal Selesai">{{ Carbon::parse($period->selesai)->toFormattedDateString() }}</td>
    					<td data-label="Aksi">
                            <a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('period').'/'.$period->id }}"><i class="material-icons">list</i></a>
                            <a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="{{ url('period').'/'.$period->id }}/edit"><i class="material-icons">edit</i></a>
                            <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $period->id }}"><i class="material-icons">delete</i></a>
                            @component('partials.deletemodal')
                                @slot('id')
                                    {{ $period->id }}
                                @endslot
                                @slot('action')
                                    {{ url('period').'/'.$period->id }}
                                @endslot
                            @endcomponent
    					</td>
    				</tr>
    				@endforeach
    				@endif
    			</tbody>
    		</table>
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
