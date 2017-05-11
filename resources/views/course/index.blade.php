@extends('layouts.template')
@section('style')
    <link rel="stylesheet" href="{!! asset('css/datatables.materialize.css') !!}" />
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Kursus</h4>
        <div class="card-panel z-depth-0">
        <a class="btn green accent-4 left" href="/course/create">Add Course</a>
        <table id="datatable" class="table highlight">
			<thead>
				<tr>
					<th>Nama Kursus</th>
					<th>Periode</th>
					<th>Matakuliah</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if(count($courses) > 0)
				@foreach($courses as $course)
				<tr>
					<td data-label="Nama Kursus">{{ $course->nama }}</td>
					<td data-label="Periode">{{ $course->period->nama }}</td>
					<td data-label="Matakuliah">{{ $course->subject->nama }}</td>
					<td data-label="Action">
						<!-- <a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('course').'/'.$course->id }}"><i class="material-icons">list</i></a> -->
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
