@extends('layouts.template')
@section('style')
    <link rel="stylesheet" href="{!! asset('css/datatables.materialize.css') !!}" />
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Classroom</h4>
        <div class="card-panel z-depth-0">
        <a class="btn green accent-4 left" href="/classroom/create">Add Class</a>
        <table id="datatable" class="table highlight">
			<thead>
				<tr>
					<th>Nama Kelas</th>
					<th>Periode</th>
					<th>Matakuliah</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if(count($classrooms) > 0)
				@foreach($classrooms as $classroom)
				<tr>
					<td data-label="Nama Kelas">{{ $classroom->nama }}</td>
					<td data-label="Periode">{{ $classroom->period->nama }}</td>
					<td data-label="Matakuliah">{{ $classroom->subject->nama }}</td>
					<td data-label="Action">
						<!-- <a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('classroom').'/'.$classroom->id }}"><i class="material-icons">list</i></a> -->
                        <a class="btn btn-small green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Enrolled" href="{{ url('enroll').'/'.$classroom->id }}"><i class="material-icons">group</i></a>
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
