@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
    <div class="col l8 m7 s12">
        <h4>Kursus Saya</h4>
        @foreach($enrolls as $enroll)
        <div class="card">
            <div class="card-content">
                <span class="card-title">{{ $enroll->nama }}</span>
            </div>
            <div class="card-action">
                <a href="{{ url('enroll').'/'.$enroll->enrole_id.'/quiz' }}">Masuk</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col l4 m5 s12">
        <h4>Pengumuman</h4>
        <ul class="collection">
        @foreach($posts as $post)
            <li class="collection-item">
                <span class="title">{{ $post->judul }}</span>
                <p>{{ $post->text }}<br />
                <span class="grey-text">{{ $post->name }}<br />
                {{ $post->created_at }}</span>
                </p>
            </li>
        @endforeach
        </ul>
    </div>
    </div>
</div>
@endsection
