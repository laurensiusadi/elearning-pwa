@extends('layouts.template')
@section('style')
<link rel="stylesheet" href="{!! asset('css/dataTables.materialize.css') !!}">
<style>
    #datatable_wrapper > .row > div { float:none!important; width:100%;}
    #datatable_filter { margin: 8px 3% 0 3% }
    #datatable_filter input { width: 94% }
</style>
@endsection
@section('content')
<div class="container">
<div class="row">
    <h4>Edit Quiz {{ $quiz->nama }}</h4>
    <div class="card-panel z-depth-0">
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
                    <th>Tipe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allQuestions as $question)
                <tr>
                    <td data-label="Assign">
                    @if($quiz->questions()->where('question_id', $question->id)->exists())
                    <input type="checkbox" class="filled-in" id="check" checked="checked" name="data::{{ $question->id }}"/><label for="check"><!--&nbsp;--></label>
                    @else
                    <input type="checkbox" class="filled-in" id="check" name="data::{{ $question->id }}"/><label for="check">No</label>
                    @endif
                    </td>
                    <td data-label="Topik">{{ $question->topik }}</td>
                    <td data-label="Tipe">{{ $question->tipe }}
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
