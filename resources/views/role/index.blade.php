@extends('layouts.template')
@section('style')
    <link rel="stylesheet" href="{!! asset('css/datatables.materialize.css') !!}" />
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Role</h4>
        <div class="card-panel">
        <a class="btn green accent-4 left" href="#modaladd">Add Role</a>
        @include('role.createmodal')
        <table id="datatable" class="table highlight bordered">
			<thead>
				<tr>
					<th>Nama Role</th>
					<th>Slug</th>
					<th>Deskripsi</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@if(count($roles) > 0)
				@foreach($roles as $role)
				<tr>
					<td data-label="Nama Role">{{ $role->name }}</td>
					<td data-label="Slug">{{ $role->slug }}</td>
					<td data-label="Deskripsi">{{ $role->description }}</td>
					<td data-label="Aksi">
                        <!-- <a class="btn-flat white-text waves-effect blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('role').'/'.$role->id }}"><i class="material-icons">list</i></a> -->
                        <a class="btn btn-small white-text waves-effect amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="#modal{{ $role->id }}edit"><i class="material-icons">edit</i></a>
                        @include('role.editmodal')
						<a class="btn btn-small white-text waves-effect green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Permission Role" href="{{ url('permissionrole').'/'.$role->id }}"><i class="material-icons">visibility_off</i></a>
                        <a class="btn btn-small white-text waves-effect red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $role->id }}delete"><i class="material-icons">delete</i></a>
                        @component('partials.deletemodal')
                            @slot('id')
                                {{ $role->id }}delete
                            @endslot
                            @slot('action')
                                {{ url('role').'/'.$role->id }}
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
