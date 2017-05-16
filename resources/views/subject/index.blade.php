@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/dataTables.materialize.css') !!}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Mata Kuliah</h4>
        <div class="card-panel z-depth-0">
            <a class="btn green accent-4 left" href="#modaladd">Add Mata Kuliah</a>
            @include('subject.createmodal')
            <table id="datatable" class="table highlight">
    			<thead>
    				<tr>
    					<th>Kode</th>
    					<th>Nama</th>
    					<th>SKS</th>
    					<th>Kurikulum</th>
    					<th>Aksi</th>
    				</tr>
    			</thead>
    			<tbody>
    				@if(count($subjects) > 0)
    				@foreach($subjects as $subject)
    				<tr>
    					<td data-label="Kode">{{ $subject->kode }}</td>
    					<td data-label="Nama">{{ $subject->nama }}</td>
    					<td data-label="SKS">{{ $subject->sks }}</td>
    					<td data-label="Kurikulum">{{ $subject->kurikulum }}</td>
    					<td data-label="Aksi">
                            <a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('subject').'/'.$subject->id }}"><i class="material-icons">list</i></a>
                            <a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="{{ url('subject').'/'.$subject->id }}/edit"><i class="material-icons">edit</i></a>
                            <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $subject->id }}"><i class="material-icons">delete</i></a>
                            @component('partials.deletemodal')
                                @slot('id')
                                    {{ $subject->id }}
                                @endslot
                                @slot('action')
                                    {{ url('subject').'/'.$subject->id }}
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
