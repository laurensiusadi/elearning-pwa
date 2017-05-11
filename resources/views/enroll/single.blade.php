@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/dataTables.materialize.css') !!}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h5>Daftar Enrollment</h5>
        <h4 style="margin-top:0">Kursus {{ $course->nama }}</h4>
        <div class="card-panel z-depth-0">
        <form class="form" role="form" method="POST" action="{{ url('enroll').'/'.$course->id }}">
            <button type="submit" class="btn gradient-2 left"><i class="material-icons left">save</i> Simpan</button>
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put"></input>
            <table id="datatable" class="table highlight">
    			<thead>
    				<tr>
    					<th>*</th>
    					<th>NRP / NIDN</th>
    					<th>User</th>
    					<th>Email</th>
    					<th>Role</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($users as $user)
    				<tr>
    					<td data-label="Enrollment">
                            @if(!empty($user->enrollments->where('kursus_id',$course->id)->first()))
                            <div class="switch">
                                <label>
                                No
                                <input checked type="checkbox" name="data::{{ $user->id }}">
                                <span class="lever"></span>
                                Yes
                                </label>
                            </div>
                            @else
                            <div class="switch">
                                <label>
                                No
                                <input type="checkbox" name="data::{{ $user->id }}">
                                <span class="lever"></span>
                                Yes
                                </label>
                            </div>
    						@endif
    					</td>
    					<td data-label="NRP / NIDN">{{ $user->nomorinduk }}</td>
    					<td data-label="User">{{ $user->name }}</td>
    					<td data-label="Email">{{ $user->email }}</td>
    					<td data-label="Role">{{ $user->roles->first()->name }}
                            <input type="hidden" name="user_id[]" value="{{ $user->id }}"></input>
                        </td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
            <button type="submit" class="btn gradient-2"><i class="material-icons left">save</i> Simpan</button>
        </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@include('partials.datatable')
@endsection
