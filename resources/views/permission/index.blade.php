@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/dataTables.materialize.css') !!}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Permission</h4>
        <div class="card-panel">
            <a class="btn green accent-4 left" href="#modaladd">Add Permission</a>
            @include('permission.createmodal')
            <table id="datatable" class="table highlight bordered">
    			<thead>
    				<tr>
    					<th>Nama Permission</th>
                        <th>Create</th>
                        <th>View</th>
                        <th>Update</th>
                        <th>Delete</th>
    					<th>Deskripsi</th>
    					<th>Aksi</th>
    				</tr>
    			</thead>
    			<tbody>
    				@if(count($permissions) > 0)
    				@foreach($permissions as $permission)
    				<tr>
    					<td data-label="Nama Permission">{{ $permission->name }}</td>
    					<td data-label="Create">
    						@if($permission->slug['create'] == true)
    						<i class="material-icons">check_box</i>
    						@else
    						<i class="material-icons">check_box_outline_blank</i>
    						@endif
    					</td>
    					<td data-label="View">
    						@if($permission->slug['view'] == true)
    						<i class="material-icons">check_box</i>
    						@else
    						<i class="material-icons">check_box_outline_blank</i>
    						@endif
    					</td>
    					<td data-label="Update">
    						@if($permission->slug['update'] == true)
    						<i class="material-icons">check_box</i>
    						@else
    						<i class="material-icons">check_box_outline_blank</i>
    						@endif
    					</td>
    					<td data-label="Delete">
    						@if($permission->slug['delete'] == true)
    						<i class="material-icons">check_box</i>
    						@else
    						<i class="material-icons">check_box_outline_blank</i>
    						@endif
    					</td>
    					<td data-label="Deskripsi">{{ $permission->description }}</td>
    					<td data-label="Aksi">
                            <!-- <a class="btn btn-small blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Detail" href="{{ url('permission').'/'.$permission->id }}"><i class="material-icons">list</i></a> -->
                            <a class="btn btn-small amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="#modal{{$permission->id}}edit"><i class="material-icons">edit</i></a>
                            @include('permission.editmodal')
                            <a class="btn btn-small red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $permission->id }}delete"><i class="material-icons">delete</i></a>
                            @component('partials.deletemodal')
                                @slot('id')
                                    {{ $permission->id }}delete
                                @endslot
                                @slot('action')
                                    {{ url('permission').'/'.$permission->id }}
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
