<div id="modal{{ $period->id }}edit" class="modal">
  <div class="modal-content">
    <h4>Edit period</h4>
    <br/>
        <form period="form" method="POST" action="{{ url('period').'/'.$period->id }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put"></input>
            <div class="input-field">
                <input value="{{$period->nama}}" name="nama" type="text" required>
                <label for="nama">Nama</label>
            </div>
            <div class="input-field">
                <input value="{{$period->tahun}}" name="tahun" type="text" required>
                <label for="tahun">Tahun</label>
            </div>
            <div class="input-field">
                <input value="{{$period->semester}}" name="semester" type="text" required>
                <label for="semester">Semester</label>
            </div>
            <div class="input-field">
                <input value="{{$period->mulai}}" name="mulai" type="date" class="datepicker">
                <label class="active" for="mulai">Tanggal Mulai</label>
            </div>
            <div class="input-field">
                <input value="{{$period->selesai}}" name="selesai" type="date" class="datepicker">
                <label class="active" for="selesai">Tanggal Selesai</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
