<div id="modal{{ $classroom->id }}edit" class="modal">
  <div class="modal-content">
    <h4>Edit Classroom</h4>
    <br/>
        <form role="form" method="POST" action="{{ url('classroom').'/'.$classroom->id }}">
            {!! csrf_field() !!}
            <input type="hidden" name="_method" value="put"/>
            <div class="input-field">
                <input value="{{ $classroom->nama }}" name="nama" type="text" required>
                <label class="active" for="nama">Nama Classroom</label>
            </div>
            <div class="input-field">
                <select name="period_id">
                    @foreach($periods as $period)
                    @if($classroom->period_id == $period->id)
                    <option value="{{ $period->id }}" selected> {{ $period->nama }} </option>
                    @else
                    <option value="{{ $period->id }}"> {{ $period->nama }} </option>
                    @endif
                    @endforeach
                </select>
                <label>Periode</label>
            </div>
            <div class="input-field">
                <select name="subject_id">
                    @foreach($subjects as $subject)
                    @if($classroom->subject_id == $subject->id)
                    <option value="{{ $subject->id }}" selected> {{ $subject->nama }} </option>
                    @else
                    <option value="{{ $subject->id }}"> {{ $subject->nama }} </option>
                    @endif
                    @endforeach
                </select>
                <label>Mata Kuliah</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-close btn btn-flat left">Cancel</button>
                <button type="submit" name="action" class="btn green right">Submit</button>
            </div>
        </form>
  </div>
</div>
