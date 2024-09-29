
<div class="modal fade" id="edit-shift{{$shift->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> تعديل شيفت</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
          <form action="{{ route('admin.shifts.update', $shift->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PATCH')
                <div class="form-group">
                  <label for="name"> الشيفت</label>
                  <input type="text" class="form-control" value="{{ $shift->name }}" name="name" id="name">
                    <input type="hidden" name="id" value="{{ $shift->id}}">
                </div>
  
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default active" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-success active">حفظ </button>
                  </div>
          </form>
        </div>
       
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>