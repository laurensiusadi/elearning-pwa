@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/datatables.materialize.css') !!}">
@endsections
@section('content')
<div class="container">
    <div class="row">
        <h5>Detail Informasi</h5>
        <h4>Role User</h4>
        <div class="card-panel">
            <form class="form" role="form" method="POST" action="{{ url('roleuser').'/'.$userid }}">
                <span class="left">Nama: {{ $username }}</br>
                    Nomor Induk: {{ $nomorinduk }}
                    </span>
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="put"></input>
                <table id="datatable" class="table highlight bordered">
    			<thead>
    				<tr>
    					<th>Status</th>
    					<th>Nama Role</th>
    					<th>Slug</th>
    					<th>Deskripsi</th>
    				</tr>
    			</thead>
    			<tbody>
    				@if(count($roles) > 0)
    				@foreach($roles as $role)
    				<tr>
                        @if(!empty($role->user_id))
                        <td data-label="Status">
                        <div class="switch">
                            <label>
                            No
                            <input checked type="checkbox" name="data::{{ $role->id }}">
                            <span class="lever"></span>
                            Yes
                            </label>
                        </div></td>
    					@else
                        <td data-label="Status">
                        <div class="switch">
                            <label>
                            No
                            <input type="checkbox" name="data::{{ $role->id }}">
                            <span class="lever"></span>
                            Yes
                            </label>
                        </div>
                        </td>
    					@endif
    					<td data-label="Nama Role">{{ $role->name }}</td>
    					<td data-label="Slug">{{ $role->slug }}</td>
    					<td data-label="Deskripsi">{{ $role->description }}
                            <input type="hidden" name="roles_id[]" value="{{ $role->id }}"></input>
                        </td>
    				</tr>
    				@endforeach
    				@endif
    			</tbody>
    		    </table>
                <button type="submit" class="btn gradient-2"><i class="material-icons left">save</i> Simpan</button>
            </form>
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
