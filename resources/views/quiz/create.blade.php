@extends('layouts.template')

@section('content')
<div class="container">
<div class="row">
    <div class="col l4 m5 s12 side-content">
        <h5>Buat Quiz Baru</h5>
        <div class="card-panel">
            <form role="form" method="POST" action="/classroom/{{$classroom->enrollmentId($classroom)}}/quiz">
                {{ csrf_field() }}
                <div class="input-field">
                    <input placeholder="" name="nama" type="text" required>
                    <label class="active" for="nama">Nama Quiz</label>
                </div>
                <div class="input-field">
                    <input placeholder="" name="mulai" class="datepicker-m" required>
                    <label class="active" for="mulai">Tanggal Mulai</label>
                </div>
                <div class="input-field">
                    <input placeholder="" name="selesai" class="datepicker-s" required>
                    <label class="active" for="selesai">Tanggal Selesai</label>
                </div>
                <div class="input-field">
                    <button class="btn green waves-effect waves-dark right" type="submit" name="action" style="padding-inline-start:45px">Buat
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form><div class="clearfix"></div>
        </div>
    </div>
    <div class="col l8 m7 s12 main-content">
        <h5>List Quiz dari Classroom {{$classroom->nama}}</h5>
        <ul class="collection">
        @if(count($quizes) > 0)
        @foreach( $quizes as $quiz)
        <li class="collection-item">{{ $loop->index+1 }}. {{ $quiz->nama }}
            <a href="/classroom/{{$classroom->enrollmentId($classroom)}}/quiz/{{$quiz->id}}/question" class="right">Masuk</a>
            <a href="#modal{{ $quiz->id }}delete" class="right" style="margin-right:14px">Delete</a>
            @component('partials.deletemodal')
                @slot('id')
                    {{ $quiz->id }}delete
                @endslot
                @slot('action')
                    /classroom/{{$classroom->id}}/quiz/{{$quiz->id}}
                @endslot
            @endcomponent
        </li>
        @endforeach
        @else
        <li class="collection-item">Belum ada soal</li>
        @endif
        </ul>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('.modal').modal();
    });
    $('.datepicker-m, .datepicker-s').pickadate({
        selectMonths: true,
        selectYears: 15
    });
</script>
@endsection
