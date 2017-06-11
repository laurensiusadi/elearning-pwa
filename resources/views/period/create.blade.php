@extends('layouts.template')

@section('content')
<div class="container">
<div class="row">
    <h5>Tambah Periode Perkuliahan</h5>
    <div class="card-panel">
        <form role="form" method="POST" action="{{ url('period') }}">
            {{ csrf_field() }}
            <div class="input-field">
                <input placeholder="Contoh: Semester Genap 2016/2017" name="nama" type="text" required>
                <label class="active" for="nama">Nama</label>
            </div>
            <div class="input-field">
                <input placeholder="Isi angka tahun" name="tahun" type="tel" required>
                <label class="active" for="tahun">Tahun</label>
            </div>
            <div class="input-field">
                <input placeholder="Isi dengan angka 1 atau 2" name="semester" type="tel" required>
                <label class="active" for="semester">Semester</label>
            </div>
            <div class="input-field">
                <input placeholder="Klik disini untuk memilih" name="mulai" type="date" class="datepicker">
                <label class="active" for="mulai">Tanggal Mulai</label>
            </div>
            <div class="input-field">
                <input placeholder="Klik disini untuk memilih" name="selesai" type="date" class="datepicker">
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
        selectYears: 5,
        format: 'yyyy-mm-dd',
    });
</script>
@endsection
