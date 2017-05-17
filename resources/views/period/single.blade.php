<?php use Carbon\Carbon; ?>
@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h5>Periode Perkuliahan</h5>
        <h4 style="margin-top:0">{{ $period->nama }}</h4>
        <div class="row">
            <div class="col s12 m6 l3">
                <div class="card-panel z-depth-0">
                    <h6 class="small grey-text">Tahun</h6>
                    <h5 class="light">{{ $period->tahun }}</h5>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card-panel z-depth-0">
                    <h6 class="small grey-text">Semester</h6>
                    <h5 class="light">{{ $period->semester }}</h5>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card-panel z-depth-0">
                    <h6 class="small grey-text">Mulai</h6>
                    <h5 class="light">{{ Carbon::parse($period->mulai)->toFormattedDateString() }}</h5>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card-panel z-depth-0">
                    <h6 class="small grey-text">Selesai</h6>
                    <h5 class="light">{{ Carbon::parse($period->selesai)->toFormattedDateString() }}</h5>
                </div>
            </div>
            <div class="col s12">
                <div class="card-panel z-depth-0">
                @if(count($period->classrooms) > 0)
                <table class="table highlight">
    			<thead>
    				<tr>
    					<th>Nama Classroom</th>
    					<th>Matakuliah</th>
    					<th>Action</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($period->classrooms as $classroom)
    				<tr>
    					<td>{{ $classroom->nama }}</td>
    					<td>{{ $classroom->subject->nama }}</td>
    					<td>
    						<a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('classroom').'/'.$classroom->id }}"><i class="material-icons">list</i></a>
                            <a class="btn btn-small green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Enrollment" href="{{ url('classroom').'/'.$classroom->id }}"><i class="material-icons">group</i></a>
    						<a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="{{ url('classroom').'/'.$classroom->id }}/edit"><i class="material-icons">edit</i></a>
                            <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $classroom->id }}"><i class="material-icons">delete</i></a>
                            @component('partials.deletemodal')
                                @slot('id')
                                    {{ $classroom->id }}
                                @endslot
                                @slot('action')
                                    {{ url('classroom').'/'.$classroom->id }}
                                @endslot
                            @endcomponent
    					</td>
    				</tr>
                    @endforeach
    			</tbody>
    		</table>
            @else
            <h6>No class yet. <a href="/classroom/create">Add Class</a></h6>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
