<div id="modal{{ $user->id }}edit" class="modal">
  <div class="modal-content">
    <h4>Edit User</h4>
    <br/>
        <form role="form" method="POST" action="{{ url('user').'/'.$user->id }}">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put"/>
            <div class="input-field">
                <input name="nomorinduk" value="{{ $user->nomorinduk }}" type="text">
                <label class="active" for="nomorinduk">NRP / NIDN</label>
            </div>
            <div class="input-field">
                <input name="name" value="{{ $user->name }}" type="text" required>
                <label class="active" for="name">Nama User</label>
            </div>
            <div class="input-field">
                <input name="email" value="{{ $user->email }}" type="email" required>
                <label class="active" for="email">Email</label>
            </div>
            <div class="input-field">
                <input placeholder="" name="password" type="password">
                <label class="active" for="password">Password</label>
            </div>
            <div class="input-field">
                <input placeholder="" type="password" class="form-control" name="password_confirmation">
                <label class="active" for="password_confirmation">Re-type Password</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
