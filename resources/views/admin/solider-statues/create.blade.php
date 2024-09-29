@php
     use App\Enums\SoliderStatusEnum;
@endphp



<div class="modal fade" id="create-vacation">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> إضافة حالة جديدة</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form role="form" action="{{ route('admin.soliderStatues.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="service-select"> الفرد</label>
            <select class="form-control select2" name="solider_id" required>
              <option class="px-4" value="" selected>اختر الفرد</option>
              @foreach($soliders as $solider)
              <option value="{{ $solider->id }}"> {{ $solider->full_name }}</option>

              @endforeach
            </select>
          </div>


          <div class="form-group">
            <label > الحالة</label>
            <select class="form-control select2" name="status" required>
              <option class="px-4" value="" selected>اختر الحالة</option>
              @foreach(SoliderStatusEnum::statues() as $status)
              <option value="{{ $status }}"> {{ $status }}</option>
              @endforeach
            </select>
          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="service-select"> معاد الذهاب</label>
               <input type="date" name="go_date" id="go-date"  placeholder="dd-mm-yyyy" class="form-control" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="service-select"> معاد العودة</label>
               <input type="date" name="return_date" id="return-date" placeholder="dd-mm-yyyy" class="form-control">
              </div>
            </div>


          </div>

          <div class="form-group">
            <label for="">ملاحظات</label>
            <textarea name="note" id="" cols="5" rows="4" class="form-control"></textarea>
          </div>

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default active" data-dismiss="modal">الغاء</button>
            <button type="submit" class="btn btn-primary active">حفظ </button>
          </div>


        </form>

      </div>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>






