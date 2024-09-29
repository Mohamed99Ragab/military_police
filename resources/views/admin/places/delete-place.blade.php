
<div class="modal fade" id="delete-place{{$place->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">حذف مكان</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>هل انت متاكد من عملية الحذف</p>
          <form action="{{ route('admin.places.destroy',$place->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default active" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-danger active">حذف </button>
                  </div>
          </form>
        </div>
       
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>