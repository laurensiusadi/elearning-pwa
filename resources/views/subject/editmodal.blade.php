<div id="modal{{ $subject->id }}edit" class="modal">
  <div class="modal-content">
    <h4>Edit subject</h4>
    <br/>
        <form subject="form" method="POST" action="{{ url('subject').'/'.$subject->id }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put"></input>
            <div class="input-field">
                <input name="kode" value="{{ $subject->kode }}" type="text">
                <label class="active" for="kode">Kode Mata Kuliah</label>
            </div>
            <div class="input-field">
                <input name="nama" value="{{ $subject->nama }}" type="text">
                <label class="active" for="nama">Nama Mata Kuliah</label>
            </div>
            <div class="input-field">
                <input name="sks" value="{{ $subject->sks }}" type="tel">
                <label class="active" for="sks">Jumlah SKS</label>
            </div>
            <div class="input-field">
                <input name="kurikulum" value="{{ $subject->kurikulum }}" type="tel">
                <label class="active" for="kurikulum">Tahun Kurikulum</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
