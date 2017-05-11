<div id="modal{{ $id }}" class="modal">
  <div class="modal-content">
    <h4>Delete Confirmation</h4>
    <p>Are you sure want to delete this?</p>
  </div>
  <div class="modal-footer">
      <button type="button" class="modal-close btn btn-flat left">Cancel</button>
      <form action="{{ $action }}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" class="btn materialize-red right">Delete</button>
      </form>
  </div>
</div>
