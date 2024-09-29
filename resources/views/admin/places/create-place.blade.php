
<div class="modal fade" id="create-place">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> إضافة مكان جديد</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form action="{{ route('admin.places.store') }}" method="POST" autocomplete="off">
              @csrf


              <div class="form-group">
                <label for="service"> الخدمة</label>
                <select class="form-control select2" name="service_id" id="service">
                  <option selected>اختر الخدمة</option>
                  @foreach($services as $service)
                  <option value="{{ $service->id }}"> {{ $service->name }}</option>

                  @endforeach
                </select>
              </div>


              <div class="form-group">
                <label for="name">اسم المكان</label>
                <input type="text" class="form-control" name="name" id="name">
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