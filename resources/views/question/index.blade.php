@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h4>Daftar Soal</h4>
        <div class="card-panel z-depth-0">
            <a class="btn green accent-4 left" href="/question/create">Add Question</a>
            @if($questions->count()>0)
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
                @foreach($questions as $question)

                @endforeach
            </tbody>
            </table>
            @else
            <div class="clearfix">
                <h5>Belum ada soal</h5>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
