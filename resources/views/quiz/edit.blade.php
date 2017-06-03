@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/dataTables.materialize.css') !!}">
<style>
    #datatable_wrapper > .row > div { float:none!important; width:100%;}
    #datatable_filter { margin: 0 10px 0 auto }
    #datatable_filter input { width: 100% }
</style>
@endsection
@section('content')
<div class="container">
<div class="row">
    <h6 class="main-title">Edit Quiz</h6>
    <h4 class="main-title">{{ $quiz->nama }}</h4>
    <div class="card-panel">
        <form class="form" role="form" method="POST" action="/quizquestion/{{ $quiz->id }}">
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
                    <input type="checkbox" class="filled-in" id="check{{ $question->id }}" checked="checked" name="data::{{ $question->id }}"/><label for="check{{ $question->id }}">Yes</label>
                    @else
                    <input type="checkbox" class="filled-in" id="check{{ $question->id }}" name="data::{{ $question->id }}"/><label for="check{{ $question->id }}">No</label>
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
