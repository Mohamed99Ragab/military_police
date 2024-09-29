
<div class="modal fade" id="create-service">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> إضافة خدمة</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form role="form" action="{{ route('admin.serviceSoliders.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="service-select"> الفرد</label>
            <select class="form-control select2" name="solider_id" >
              <option class="px-4" value="" selected>اختر الفرد</option>
              @foreach($soliders as $solider)
              <option value="{{ $solider->id }}"> {{ $solider->full_name }}</option>

              @endforeach
            </select>
          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="service-select"> الخدمة</label>
                <select class="form-control select2"   name="service_id" id="service">
                  <option class="px-4" value="" selected>اختر الخدمة</option>
                  @foreach($services as $service)
                  <option value="{{ $service->id }}"> {{ $service->name }}</option>

                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="place-select"> مكان التواجد</label>
                <select id="place" class="form-control select2" name="service_place_id" required >
                  <option value="" selected>اختر مكان تواجد الخدمة</option>
                  @foreach($places as $place)
                  <option value="{{ $place->id }}"> {{ $place->name }}</option>

                  @endforeach
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
                <option value="{{ $degree->id }}"> {{ $degree->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
                  <label for="shift"> الشيفت</label>
                  <select class="form-control select2" name="shift_id" id="shift" required>
                    <option value="" selected>اختر الشيفت</option>
                    @foreach($shifts as $shift)
                    <option value="{{ $shift->id }}"> {{ $shift->name }}</option>
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



  <script>
    // http://172.16.1.251:90/military_police/public

    $(document).ready(function() {
    // عند فتح مودال الإنشاء
    $('#create-service').on('show.bs.modal', function() {
        var serviceSelect = $('#service');
        var placeSelect = $('#place');

        function loadPlaces(serviceId, placeSelect) {
            if (serviceId) {
                $.ajax({
                    url: '/admin/places/' + serviceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        placeSelect.empty();
                        placeSelect.append('<option value="">اختر مكان</option>');
                        $.each(data, function(key, value) {
                            placeSelect.append('<option value="'+ key +'">'+ value +'</option>');
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

        // إعادة تعيين الـ selects عند فتح المودال
        serviceSelect.val('');
        placeSelect.empty();
        placeSelect.append('<option value="">اختر مكان</option>');
    });
});

  </script>


@endsection
