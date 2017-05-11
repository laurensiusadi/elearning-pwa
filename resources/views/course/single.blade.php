@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h5>Detail Informasi</h5>
        <h4 style="margin-top:0">Kursus {{ $course->nama }}</h4>
        <div class="card-panel z-depth-0">
        </div>
    </div>
</div>
@endsection
