<div id="modal{{ $key->id }}edit" class="modal">
  <div class="modal-content">
    <h4>Edit Challenge</h4>
    <br/>
        <form role="form" method="POST" action="/question/{{$question->id}}/key/{{$key->id}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put"/>
            <div class="input-field">
                <input value="{{ $key->checklist }}" type="text" name="checklist" style="font-family: monospace" required/>
                <label class="active" for="checklist">Challenges</label>
            </div>
            <div class="input-field">
                <input value="{{ $key->message }}" type="text" name="message"/>
                <label class="active" for="message">Message</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button class="btn green waves-effect waves-light right" type="submit" name="action">Save<i class="material-icons right">save</i></button>
            </div>
        </form>
  </div>
</div>
