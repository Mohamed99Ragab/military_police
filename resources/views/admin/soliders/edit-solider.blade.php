@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | الافراد@endsection

@section('css')

<style>
  .select2-selection__rendered{
    padding-right: 0;
  }
</style>

@endsection

@section('content')



<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <p class="m-0 text-dark f-z-50">الافراد</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  تعديل فرد</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


<div class="container mt-5 shadow  typle ">

      @if ($errors->any())
          <div class="alert alert-danger w-75 mx-auto text-center">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
  <div class="row">
      <div class="col-12">

        <form role="form" action="{{ route('admin.soliders.update',$solider->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

        <div class="card-body">
          <div class="form-group">
            <label for="name">الاسم رباعى</label>
            <input type="text" name="full_name" value="{{ $solider->full_name }}" class="form-control" id="name" >
            <input type="hidden" name="id" value="{{ $solider->id}}">
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="address">العنـــوان</label>
                <input type="text" name="address"  value="{{ $solider->address }}" class="form-control" id="address">
              </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                  <label for="degree"> الدرجة</label>
                  <select class="form-control select2" name="degree_id" id="degree">
                    <option value="" selected>اختر الدرجة</option>
                    @foreach($degrees as $degree)
                    <option {{ $degree->id == $solider->degree_id ? 'selected':'' }} value="{{ $degree->id }}"> {{ $degree->name }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label for="number">الرقم العسكرى</label>
              <input type="text" name="military_number" value=" {{ $solider->military_number }} " class="form-control" id="number">
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">رقم التليفون </label>
                <input type="text" name="phone_number" value="{{ $solider->phone_number }}"  class="form-control" id="phone">
              </div>
            </div>
          </div>

          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="service-select"> الخدمة</label>
                    <select class="form-control select2"   name="service_id" id="service">
                      <option class="px-4" value="" selected>اختر الخدمة</option>
                      @foreach($services as $service)
                      <option value="{{ $service->id }}" {{ $solider->soliderService?->service_id == $service->id ? 'selected':'' }}> {{ $service->name }}</option>

                      @endforeach
                    </select>
                  </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="place-select"> مكان التواجد</label>
                  <select id="place" class="form-control select2" name="service_place_id" data-selected="{{ $solider->soliderService?->service_place_id }}">
                    <option value="" selected>اختر مكان تواجد الخدمة</option>

                  </select>
                </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                    <label for="shift"> الشيفت</label>
                    <select class="form-control select2" name="shift_id" id="shift">
                      <option value="" selected>اختر الشيفت</option>
                      @foreach($shifts as $shift)
                      <option value="{{ $shift->id }}" {{ $solider->SoliderService?->shift_id == $shift->id ? 'selected':'' }} > {{ $shift->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
            </div>



              <div class="row justify-content-between">

                  <!-- /.form-group -->
                </div>
               <div class="col-12">
                <div class="form-group my-2">
                  <label for="exampleInputFile">إضافة صورة</label>
                  <br><br>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>

              </div>
               </div>

            </div>
          </div>

        </div>
        <!-- /.card-body -->

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default active" data-dismiss="modal">الغاء</button>
          <button type="submit" class="btn btn-primary active">حفظ </button>
        </div>
      </div>
      </form>



  </div>
</div>


@endsection


@section('js')

<script>
   // http://172.16.1.251:90/military_police/public

        $(document).ready(function() {
        var initialServiceId = $('#service').val();
        var selectedPlaceId = $('#place').data('selected');
        if (initialServiceId) { loadPlaces(initialServiceId, selectedPlaceId);}


        $('#service').change(function() {
        var serviceId = $(this).val();
            if (serviceId) { loadPlaces(serviceId);
            } else {
            $('#place').empty(); $('#place').append('<option value="">اختر مكان</option>');
            }
        });


        function loadPlaces(serviceId, selectedPlaceId = null) {
            $.ajax({ url: '/admin/places/' + serviceId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#place').empty(); $('#place').append('<option value="">اختر مكان</option>');
                $.each(data, function(key, value) {
                var isSelected = (selectedPlaceId == key) ? 'selected' : '';
                // تعيين المكان المحدد مسبقًا
                $('#place').append('<option value="'+ key +'" ' + isSelected + '>'+ value +'</option>'); });
            }
        });
        }

        });
 </script>
@endsection
