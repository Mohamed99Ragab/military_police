
<div class="modal fade" id="create-degree">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> إضافة درجة جديد</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form action="{{ route('admin.degrees.store') }}" method="POST" autocomplete="off">
              @csrf

              <div class="form-group">
                <label for="name"> الدرجة</label>
                <input type="text" class="form-control" name="name" id="name" autocomplete="off">
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