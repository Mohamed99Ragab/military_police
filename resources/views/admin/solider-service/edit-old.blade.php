
<div class="modal fade" id="edit-service{{$soliderService->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> تعديل خدمة</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form role="form" action="{{ route('admin.serviceSoliders.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="service-select"> الفرد</label>
            <select class="form-control select2" name="solider_id" id="service-select">
              <option class="px-4" value="" selected>اختر الفرد</option>
              @foreach($soliders as $solider)
              <option  {{ $soliderService->solider_id == $solider->id ? 'selected':'' }} value="{{ $solider->id }}"> {{ $solider->full_name }}</option>

              @endforeach
            </select>
          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="service-select"> الخدمة</label>
                <select class="form-control select2 "   name="service_id" id="service">
                  <option class="px-4" value="" selected>اختر الخدمة</option>
                  @foreach($services as $service)
                  <option {{ $soliderService->service_id == $service->id ? 'selected':'' }} value="{{ $service->id }}"> {{ $service->name }}</option>

                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="place-select"> مكان التواجد</label>
                <select class="form-control select2" name="service_place_id" data-selected="{{ $soliderService->service_place_id }}" id="place">
                  <option value="" selected>اختر مكان تواجد الخدمة</option>

                </select>
              </div>
            </div>


          </div>

          <div class="row">
            <div class="col-md-6">
              <label for="degree"> الدرجة</label>
              <select class="form-control select2" name="degree_id" id="degree">
                <option value="" selected>اختر الدرجة</option>
                @foreach($degrees as $degree)
                <option  {{ $soliderService->degree_id == $degree->id ? 'selected':'' }} value="{{ $degree->id }}"> {{ $degree->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
                  <label for="shift"> الشيفت</label>
                  <select class="form-control select2" name="shift_id" id="shift">
                    <option value="" selected>اختر الشيفت</option>
                    @foreach($shifts as $shift)
                    <option {{ $soliderService->shift_id == $shift->id ? 'selected':'' }} value="{{ $shift->id }}"> {{ $shift->name }}</option>
                    @endforeach
                  </select>
            </div>


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


@section('js')
{{-- <script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script> --}}

<script>
  $(document).ready(function() {
    // عندما يتم فتح أي مودال
    $('.modal').on('show.bs.modal', function() {
        var modal = $(this); // احصل على المودال الحالي
        var serviceSelect = modal.find('select[name="service_id"]');
        var placeSelect = modal.find('select[name="service_place_id"]');
        var selectedPlaceId = modal.find('select[name="service_place_id"]').data('selected'); // استخدام data attribute لتخزين المكان المحدد مسبقاً

        // دالة لتحميل الأماكن بناءً على الخدمة المختارة
        // http://172.16.1.251:90/military_police/public

        function loadPlaces(serviceId, placeSelect, selectedPlaceId = null) {
            if (serviceId) {
                $.ajax({
                    url: 'http://172.16.1.251:90/military_police/public/admin/places/' + serviceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        placeSelect.empty();
                        placeSelect.append('<option value="">اختر مكان</option>');
                        $.each(data, function(key, value) {
                            placeSelect.append('<option value="'+ key +'" ' + (key == selectedPlaceId ? 'selected' : '') + '>'+ value +'</option>');
                        });
                    }
                });
            } else {
                placeSelect.empty();
                placeSelect.append('<option value="">اختر مكان</option>');
            }
        }

        // تحميل الأماكن عند تغيير الخدمة
        serviceSelect.change(function() {
            loadPlaces($(this).val(), placeSelect);
        });

        // تحميل الأماكن المحددة مسبقًا عند فتح المودال
        loadPlaces(serviceSelect.val(), placeSelect, selectedPlaceId);
    });
});

</script>
@endsection



