<div id="modal{{ $role->id }}edit" class="modal">
  <div class="modal-content">
    <h4>Edit Role</h4>
    <br/>
        <form role="form" method="POST" action="{{ url('role').'/'.$role->id }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put"></input>
            <div class="input-field">
                <input name="name" value="{{ $role->name }}" type="text" required>
                <label class="active" for="name">Nama Role</label>
            </div>
            <div class="input-field">
                <input name="slug" value="{{ $role->slug }}" type="text" required>
                <label class="active" for="slug">Slug</label>
            </div>
            <div class="input-field">
                <textarea class="materialize-textarea" name="description" type="text" required>{{ $role->description }}</textarea>
                <label class="active" for="description">Deskripsi</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
