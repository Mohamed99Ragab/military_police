
<div class="modal fade" id="edit-place{{$place->id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> تعديل مكان</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
          <form action="{{ route('admin.places.update', $place->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PATCH')

                <div class="form-group">
                  <label for="service"> الخدمة</label>
                  <select class="form-control select2" name="service_id" id="service">
                    @foreach($services as $service)
                    <option  {{ $service->id == $place->service_id ? 'selected':''}} value="{{ $service->id }}" selected> {{ $service->name }}</option>
  
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="name">اسم مكان الخدمة</label>
                  <input type="text" class="form-control" value="{{ $place->name }}" name="name" id="name">
                    <input type="hidden" name="id" value="{{ $place->id}}">
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