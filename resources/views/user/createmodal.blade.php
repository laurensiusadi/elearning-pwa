<div id="modaladd" class="modal">
  <div class="modal-content">
    <h4>Add User</h4>
    <br/>
        <form role="form" method="POST" action="{{ url('user') }}">
            {!! csrf_field() !!}
            <div class="input-field">
                <input name="nomorinduk" value="{{ old('nomorinduk') }}" type="text">
                <label for="nomorinduk">NRP / NIDN</label>
            </div>
            <div class="input-field">
                <input name="name" value="{{ old('name') }}" type="text" required>
                <label for="name">Nama User</label>
            </div>
            <div class="input-field">
                <input name="email" value="{{ old('email') }}" type="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-field">
                <input name="password" type="password" required>
                <label for="password">Password</label>
            </div>
            <div class="input-field">
                <input type="password" class="form-control" name="password_confirmation">
                <label for="password_confirmation">Re-type Password</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
