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
                @if(count($period->courses) > 0)
                <table class="table highlight">
    			<thead>
    				<tr>
    					<th>Nama Kursus</th>
    					<th>Matakuliah</th>
    					<th>Action</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($period->courses as $course)
    				<tr>
    					<td>{{ $course->nama }}</td>
    					<td>{{ $course->subject->nama }}</td>
    					<td>
    						<a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('course').'/'.$course->id }}"><i class="material-icons">list</i></a>
                            <a class="btn btn-small green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Enrollment" href="{{ url('enroll').'/'.$course->id }}"><i class="material-icons">group</i></a>
    						<a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="{{ url('course').'/'.$course->id }}/edit"><i class="material-icons">edit</i></a>
                            <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $course->id }}"><i class="material-icons">delete</i></a>
                            @component('partials.deletemodal')
                                @slot('id')
                                    {{ $course->id }}
                                @endslot
                                @slot('action')
                                    {{ url('course').'/'.$course->id }}
                                @endslot
                            @endcomponent
    					</td>
    				</tr>
                    @endforeach
    			</tbody>
    		</table>
            @else
            <h6>No course yet. <a href="/course/create">Add Course</a></h6>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
