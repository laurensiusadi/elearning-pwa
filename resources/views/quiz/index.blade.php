@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h3>Daftar Penugasan dari Kursus {{ $course->nama }}</h3>
		<table id="striped" class="striped">
			<thead>
				<tr>
					<th>Nama Penugasan</th>
					<th>Waktu Mulai</th>
					<th>Waktu Selesai</th>
					<th>Deskripsi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if(count($quizes) > 0)
				@foreach($quizes as $quiz)
				<tr>
					<td>{{ $quiz->nama }}</td>
					<td>{{ $quiz->wmulai }}</td>
					<td>{{ $quiz->wselesai }}</td>
					<td>{{ $quiz->des }}</td>
					<td>
						<a class="btn small blue" data-toggle="tooltip" title="Detail" href="{{ url('enroll').'/'.$enrollid.'/quiz/'.$quiz->id }}">
							<i class="material-icons">list</i>
						</a>
						<a class="btn small green" data-toggle="tooltip" title="Jawaban" href="{{ url('enroll').'/'.$enrollid.'/quiz/'.$quiz->id }}/answer">
							<i class="material-icons">class</i>
						</a>
						@if($ismhs == false)
						<a class="btn red" data-toggle="tooltip" title="Edit" href="{{ url('enroll').'/'.$enrollid.'/quiz/'.$quiz->id }}/edit">
							<i class="fa fa-edit"></i>
						</a>
						<span data-toggle="tooltip" title="Hapus">
							<a id="datatable-delete" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete" data-id="{{ url('enroll').'/'.$enrollid.'/quiz/'.$quiz->id }}" data-label="{{ $quiz->nama }}">
								<i class="fa fa-trash"></i>
							</a>
						</span>
						@endif
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
    </div>
</div>
@endsection
