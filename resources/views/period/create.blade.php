@extends('layouts.template')

@section('content')
<div class="container">
<div class="row">
    <h5>Tambah Periode Perkuliahan</h5>
    <div class="card-panel z-depth-0">
        <form role="form" method="POST" action="{{ url('/period') }}">
            {{ csrf_field() }}
            <div class="input-field">
                <input placeholder="" name="nama" type="text" required>
                <label for="nama">Nama</label>
            </div>
            <div class="input-field">
                <input placeholder="" name="tahun" type="text" required>
                <label for="tahun">Tahun</label>
            </div>
            <div class="input-field">
                <input placeholder="" name="semester" type="text" required>
                <label for="semester">Semester</label>
            </div>
            <div class="input-field">
                <input placeholder="" name="mulai" type="date" class="datepicker">
                <label class="active" for="mulai">Tanggal Mulai</label>
            </div>
            <div class="input-field">
                <input placeholder="" name="selesai" type="date" class="datepicker">
                <label class="active" for="selesai">Tanggal Selesai</label>
            </div>
            <div class="input-field">
                <button class="btn green waves-effect waves-dark right" type="submit" name="action" style="padding-inline-start:45px">Buat
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form><p class="clearfix"></p>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 15
    });
</script>
@endsection
