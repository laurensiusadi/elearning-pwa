<div id="modaladd" class="modal">
  <div class="modal-content">
    <h4>Add Role</h4>
    <br/>
        <form role="form" method="POST" action="{{ url('role') }}">
            {!! csrf_field() !!}
            <div class="input-field">
                <input name="name" value="{{ old('name') }}" type="text">
                <label for="name">Nama Role</label>
            </div>
            <div class="input-field">
                <input name="slug" value="{{ old('slug') }}" type="text" required>
                <label for="slug">Slug</label>
            </div>
            <div class="input-field">
                <input name="description" value="{{ old('description') }}" type="text" required>
                <label for="description">Deskripsi</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
