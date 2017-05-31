<div id="modalnext" class="modal">
  <div class="modal-content">
    <h4 class="center">Good job!</h4>
    <form method="POST" role="form" action="/classroom/{{ $quiz->classroom->id }}/quiz/{{ $quiz->id }}/question/{{ $question->id }}/answer/done">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="put"/>
    <div class="modal-footer">
        <button class="btn gradient-2 waves-effect waves-light" type="submit" name="action">Next Question</button>
    </div>
    </form>
  </div>
</div>
