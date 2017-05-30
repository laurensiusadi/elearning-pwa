<div id="modal{{$permission->id}}edit" class="modal">
  <div class="modal-content">
    <h4>Add Permission</h4>
    <br/>
        <form role="form" method="POST" action="{{ url('permission').'/'.$permission->id }}">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put"></input>
            <div class="input-field">
                <input name="name" value="{{ $permission->name }}" type="text">
                <label for="name">Nama Permission</label>
            </div>
            <label>Permission</label>
            <div class="input-field" style="margin-top:0.25rem; padding-bottom: 1rem">
                <input checked="checked" type="checkbox" class="filled-in" name="create" id="create">
                <label for="create" style="padding: 0 2rem 0 1.75rem">Create</label>
				<input checked="checked" type="checkbox" class="filled-in" name="view" id="view">
                <label for="view" style="padding: 0 2rem 0 1.75rem">View</label>
				<input checked="checked" type="checkbox" class="filled-in" name="update" id="update">
                <label for="update" style="padding: 0 2rem 0 1.75rem">Update</label>
				<input checked="checked" type="checkbox" class="filled-in" name="delete" id="delete">
                <label for="delete" style="padding: 0 2rem 0 1.75rem">Delete</label>
            </div>
            <div class="input-field">
                <input name="description" value="{{ $permission->description }}" type="text" required>
                <label for="description">Deskripsi</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
