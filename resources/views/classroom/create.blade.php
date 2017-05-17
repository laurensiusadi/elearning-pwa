@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <h4>Buat Classroom Baru</h4>
        <div class="card-panel z-depth-0">
            <form role="form" method="POST" action="{{ url('classroom') }}">
                {{ csrf_field() }}
                <div class="input-field">
                    <input placeholder="" name="nama" type="text" required>
                    <label for="nama">Nama Classroom</label>
                </div>
                <div class="input-field">
                    <select name="period_id">
                        <option value="" disabled selected>Choose your option</option>
                        @foreach($periods as $period)
                        <option value="{{ $period->id }}"> {{ $period->nama }} </option>
                        @endforeach
                    </select>
                    <label>Periode</label>
                </div>
                <div class="input-field">
                    <select name="subject_id">
                        <option value="" disabled selected>Choose your option</option>
                        @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}"> {{ $subject->nama }} </option>
                        @endforeach
                    </select>
                    <label>Mata Kuliah</label>
                </div>
                <div class="input-field">
                    <a href="/class" class="btn-flat white left" style="padding-left:0"><i class="material-icons left">arrow_back</i>Back</a>
                    <button class="btn green waves-effect waves-dark right" type="submit" name="action" style="padding-inline-start:45px">Buat<i class="material-icons right">send</i></button>
                </div>
            </form><p class="clearfix"></p>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
  $('select').material_select();
});
</script>
@endsection
