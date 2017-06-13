@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/datatables.materialize.css') !!}">
@endsection
@section('content')
<div class="container">
<div class="row">
    <form role="form" method="POST" action="/quizquestion/{{ $quiz->id }}">
    <h6 class="main-title">Edit Quiz</h6>
    <h4 class="main-title">
        <input type="text" name="nama" value="{{ $quiz->nama }}" style="font-size:inherit"/>
    </h4>
    <div class="card-panel">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put"/>
            <!-- <a href="/question/create" class="btn green accent-3 waves-effect">Tambah Question</a> -->
            @if($allQuestions->count() > 0)
            <table id="datatable" class="table highlight bordered">
            <thead>
                <tr>
                    <th>Assign</th>
                    <th>Topik</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allQuestions as $question)
                <tr>
                    <td data-label="Assign">
                    @if($quiz->questions()->where('question_id', $question->id)->exists())
                    <input type="checkbox" class="filled-in" id="check{{ $question->id }}" checked="checked" name="data::{{ $question->id }}"/><label class="active" for="check{{ $question->id }}">Yes</label>
                    @else
                    <input type="checkbox" class="filled-in" id="check{{ $question->id }}" name="data::{{ $question->id }}"/><label class="active" for="check{{ $question->id }}">No</label>
                    @endif
                    </td>
                    <td data-label="Topik">{{ $question->topik }}
                        <input type="hidden" name="questions_id[]" value="{{ $question->id }}"></input>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
            <button type="submit" class="btn gradient-2"><i class="material-icons left">save</i> Simpan</button>
            @endif
        </form>
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
