@extends('layouts.template')

@section('content')
<div class="container">
    <h4 class="left">Daftar Soal</h4>
    <a class="btn green accent-4 right" href="/question/create">Add Question</a>
        <div class="row clearfix">
            @if($questions->count()>0)
            <ul class="collection">
                @foreach($questions as $question)
                <li class="collection-item">{{ $question->topik }}
                    <a href="#modal{{ $question->id }}delete" class="btn-link right">Delete</a>
                    @component('partials.deletemodal')
                        @slot('id')
                            {{ $question->id }}delete
                        @endslot
                        @slot('action')
                            {{ url('question').'/'.$question->id }}
                        @endslot
                    @endcomponent
                    <a href="/question/{{ $question->id }}/edit" class="btn-link right">Edit&nbsp;&nbsp;</a>
                </li>
                @endforeach
            </ul>
            @else
            <div class="card-panel">
                <div class="clearfix">
                    <h5>Belum ada soal</h5>
                </div>
            </div>
            @endif
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
      $('.modal').modal();
    });
</script>
@endsection
