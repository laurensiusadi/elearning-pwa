@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/dataTables.materialize.css') !!}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Pengguna</h4>
        <div class="card-panel z-depth-0">
        <a class="btn green accent-4 left" href="#modaladd">Add User</a>
        @include('user.createmodal')
        <table id="datatable" class="table highlight bordered">
        <thead>
            <tr>
                <th>ID Number</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td data-label="ID Number">{{ $user->nomorinduk }}</td>
                <td data-label="Nama">{{ $user->name }}</td>
                <td data-label="Email">{{ $user->email }}</td>
                <td data-label="Action">
                    <a class="btn btn-small white-text waves-effect amber tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="#modal{{ $user->id }}edit"><i class="material-icons">edit</i></a>
                    @include('user.editmodal')
                    <a class="btn btn-small white-text waves-effect green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Role User" href="{{ url('roleuser').'/'.$user->id }}"><i class="material-icons">supervisor_account</i></a>
                    <a class="btn btn-small white-text waves-effect red modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete" href="#modal{{ $user->id }}delete"><i class="material-icons">delete</i></a>
                    @component('partials.deletemodal')
                        @slot('id')
                            {{ $user->id }}delete
                        @endslot
                        @slot('action')
                            {{ url('user').'/'.$user->id }}
                        @endslot
                    @endcomponent
                </td>
            </tr>
            @endforeach
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
