@php
     use App\Enums\SoliderStatusEnum;
@endphp


<div class="modal fade" id="edit-status{{$SoliderStatus->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> تعديل حالة</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      

     
        <form role="form" action="{{ route('admin.soliderStatues.update',$SoliderStatus->id) }}" method="POST" >
          @csrf
          @method('PATCH')

         


          {{-- <div class="form-group">
            <label for="service-select">الحالة</label>
            <select class="form-control select2" name="type" required>
              <option class="px-4" value="" selected>اختر الحالة</option>
              @foreach(SoliderStatusEnum::statues() as $status)
              <option   {{ $SoliderStatus->status == $status ? 'selected':''}}  value="{{ $status }}"> {{ $status }}</option>
              @endforeach
            </select>
          </div> --}}


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for=""> معاد الذهاب</label>
               <input type="date" name="go_date" value="{{ $SoliderStatus->go_date->format('Y-m-d') }}" class="form-control" required>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for=""> معاد العودة</label>
               <input type="date" name="return_date"  value="{{ $SoliderStatus->return_date?->format('Y-m-d') }}" class="form-control">
              </div>
            </div>


          </div>
          <div class="form-group">
            <label for="">ملاحظات</label>
            <textarea name="note" id="" cols="6" rows="4" class="form-control">{{ $SoliderStatus->note  }}</textarea>
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