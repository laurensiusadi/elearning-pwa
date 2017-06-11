<div id="modaladd" class="modal">
  <div class="modal-content">
    <h4>Tambah Mata Kuliah</h4>
    <br/>
        <form role="form" method="POST" action="{{ url('subject') }}">
            {!! csrf_field() !!}
            <div class="input-field">
                <input name="kode" value="{{ old('kode') }}" type="text">
                <label class="active" for="kode">Kode Mata Kuliah</label>
            </div>
            <div class="input-field">
                <input name="nama" value="{{ old('nama') }}" type="text">
                <label class="active" for="nama">Nama Mata Kuliah</label>
            </div>
            <div class="input-field">
                <input name="sks" value="{{ old('sks') }}" type="tel">
                <label class="active" for="sks">Jumlah SKS</label>
            </div>
            <div class="input-field">
                <input name="kurikulum" value="{{ old('kurikulum') }}" type="tel">
                <label class="active" for="kurikulum">Tahun Kurikulum</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
