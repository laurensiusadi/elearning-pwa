@extends('layouts.template')

@section('content')
<div class="container">
<div class="row">
    <div class="col l4 m5 s12">
        <h5>Buat Quiz Baru</h5>
        <div class="card-panel z-depth-0">
            <form role="form" method="POST" action="/classroom/{{$classroom->id}}/quiz">
                {{ csrf_field() }}
                <div class="input-field">
                    <input placeholder="" name="nama" type="text" required>
                    <label for="nama">Nama Quiz</label>
                </div>
                <div class="input-field">
                    <input placeholder="" name="mulai" class="datepicker-m" required>
                    <label class="active" for="mulai">Mulai</label>
                </div>
                <div class="input-field">
                    <input placeholder="" name="selesai" class="datepicker-s" required>
                    <label class="active" for="selesai">Selesai</label>
                </div>
                <div class="input-field">
                    <button class="btn green waves-effect waves-dark right" type="submit" name="action" style="padding-inline-start:45px">Buat
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form><p class="clearfix"></p>
        </div>
    </div>
    <div class="col l8 m7 s12">
        <h5>List Quiz dari Classroom</h5>
        <ul class="collection">
        @if(count($quizes) > 0)
        @foreach( $quizes as $quiz)
        <li class="collection-item">{{ $loop->index+1 }}. {{ $quiz->nama }}</li>
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
    $('.datepicker-m, .datepicker-s').pickadate({
        selectMonths: true,
        selectYears: 15
    });
</script>
@endsection
