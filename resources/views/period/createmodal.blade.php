<div id="modaladd" class="modal">
  <div class="modal-content">
    <h4>Add Periode Perkuliahan</h4>
    <br/>
    <form role="form" method="POST" action="{{ url('/period') }}">
        {{ csrf_field() }}
        <div class="input-field">
            <input placeholder="" name="nama" type="text" required>
            <label class="active" for="nama">Nama</label>
        </div>
        <div class="input-field">
            <input placeholder="" name="tahun" type="text" required>
            <label class="active" for="tahun">Tahun</label>
        </div>
        <div class="input-field">
            <input placeholder="" name="semester" type="text" required>
            <label class="active" for="semester">Semester</label>
        </div>
        <div class="input-field">
            <input placeholder="" name="mulai" type="date" class="datepicker">
            <label class="active" for="mulai">Tanggal Mulai</label>
        </div>
        <div class="input-field">
            <input placeholder="" name="selesai" type="date" class="datepicker">
            <label class="active" for="selesai">Tanggal Selesai</label>
        </div>
        <div class="input-field">
            <button class="btn green waves-effect waves-dark right" type="submit" name="action" style="padding-inline-start:45px">Buat
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form><p class="clearfix"></p>
  </div>
</div>
