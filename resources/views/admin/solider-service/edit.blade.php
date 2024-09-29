@extends('layouts.master')
@section('title') فرع الشرطة العسكرية @endsection
 @section('css') @endsection
@section('content')
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-12">
<p class="m-0 text-dark f-z-50">خدمات الجنود</p>
</div><!-- /.col -->
<div class="col-sm-12">
 <ol class="breadcrumb font-z-25">
<li class="breadcrumb-item"><a href="#">لوحة التحكم</a></li>
<li class="breadcrumb-item active"> / تعديل </li> </ol> </div>
<!-- /.col --> </div>
<!-- /.row --> </div><!-- /.container-fluid -->
 </div> <!-- /.content-header -->
<div class="container mt-5 shadow typle">
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
 <form role="form" action="{{ route('admin.serviceSoliders.store') }}" method="POST" enctype="multipart/form-data">
 @csrf <div class="form-group">
 <label for="service-select"> الفرد</label>
 <select class="form-control select2" name="solider_id" id="service-select">
 <option class="px-4" value="" selected>اختر الفرد</option>
@foreach($soliders as $solider)
 <option {{ $soliderService->solider_id == $solider->id ? 'selected':'' }} value="{{ $solider->id }}">{{ $solider->full_name }}</option>
@endforeach
 </select>
</div>
<div class="row">
 <div class="col-md-6">
 <div class="form-group">
<label for="service-select"> الخدمة</label>
 <select class="form-control select2" name="service_id" id="service">
<option class="px-4" value="" selected>اختر الخدمة</option>
 @foreach($services as $service)
 <option {{ $soliderService->service_id == $service->id ? 'selected':'' }} value="{{ $service->id }}">{{ $service->name }}</option>
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
<option {{ $soliderService->degree_id == $degree->id ? 'selected':'' }} value="{{ $degree->id }}">{{ $degree->name }}</option>
@endforeach
 </select>
 </div> <div class="col-md-6">
 <label for="shift"> الشيفت</label>
 <select class="form-control select2" name="shift_id" id="shift">
 <option value="" selected>اختر الشيفت</option>
@foreach($shifts as $shift)
 <option {{ $soliderService->shift_id == $shift->id ? 'selected':'' }} value="{{ $shift->id }}">{{ $shift->name }}</option>
@endforeach
 </select>
</div>
 </div>
<div class="modal-footer justify-content-between">
 <button type="button" class="btn btn-default active" data-dismiss="modal">الغاء</button> <button type="submit" class="btn btn-primary active">حفظ</button>
 </div>
 </form>
</div>
</div>
</div>
</div>


 @endsection @section('js')
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
