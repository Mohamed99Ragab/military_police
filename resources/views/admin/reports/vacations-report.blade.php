@extends('layouts.master')

@section('title') التقارير @endsection

@section('css') @endsection
@php
     use Carbon\Carbon;
     use App\Enums\VacctionTypeEnum;

@endphp
@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <p class="m-0 text-dark f-z-50">الرئـيســـــية</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  التقارير</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



<div class="container mt-5 shadow  typle ">
  <h2 style="font-size: 50px; font-weight:700">تقارير الاجازات</h2>

  <form action="{{ route('admin.reports.vacation')}}" method="POST">
    @csrf

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="service-select"> الفرد</label>
          <select class="form-control select2" name="solider_id" >
            <option class="px-4" value="" selected>اختر الفرد</option>
            @foreach($soliders as $solider)
            <option  {{ isset($requestData->solider_id) ? $requestData->solider_id == $solider->id ? 'selected' :'' :'' }}  value="{{ $solider->id }}"> {{ $solider->full_name }}</option>

            @endforeach
          </select>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="service-select"> نوع الاجازة</label>
          <select class="form-control select2" name="type" >
            <option class="px-4" value="" selected>اختر النوع</option>
            @foreach(VacctionTypeEnum::VacctionTypes() as $type)
            <option  {{ isset($requestData->type) ? $requestData->type == $type ? 'selected' :'' :'' }}   value="{{ $type }}"> {{ $type }}</option>
            @endforeach
          </select>
        </div>
      </div>


      
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="service-select"> معاد النزول</label>
         <input type="date"  value="{{ $requestData->drop_date?? '' }}" name="drop_date"  class="form-control">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="service-select"> معاد العودة</label>
         <input type="date" value="{{ $requestData->return_date?? '' }}" name="return_date" class="form-control">
        </div>
      </div>


    </div>

    <button type="submit" class="btn btn-primary active w-100 my-4">بحث</button>

  </form>



  <div class="row">
      <div class="col-12">
        <div class="data_table">
             <table id="example" class="table table-striped table-bordered table-responsive">
                 <thead class="table-dark">
                     <tr>
                      <th>#</th>
                      <th>الاســــم</th>
                      <th> معاد النزول</th>
                      <th>معاد العوده</th>
                      <th>نوع الاجازة</th>
                      <th>رقم التليفون</th>
                      <th> الرتبة </th>
                      <th>الحالة</th>
                      <th>ملاحظة</th>
                      <th> الاضافة بواسطة</th>
                      <th> التعديل بواسطة</th>
                      <th class="d-print-none">اجراءات</th>
                     </tr>
                 </thead>
                 <tbody>

                    @isset($vacations)
                        @foreach($vacations as $vacation)
                            @php
                              $today = Carbon::today();
                              $drop_date = Carbon::parse($vacation->drop_date);
                              $return_date = Carbon::parse($vacation->return_date);

                            @endphp

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vacation->solider?->full_name }}</td>
                        <td>{{ $vacation->drop_date->format('d/m/Y') }}</td>
                        <td>{{ $vacation->return_date->format('d/m/Y') }}</td>
                        <td>{{ $vacation->type }}</td>
                        <td>{{ $vacation->solider->phone_number }}</td>
                        <td>{{ $vacation->solider->degree->name }}</td>

                        <td>
                          @if($today->eq($return_date))
                          موجود
                            <span class="typle-active"></span>
                          @elseif($today->between($drop_date,$return_date) || $today->eq($drop_date))
                          غير موجود
                          <span class="typle-active-no"></span>
                            @else
                             موجود
                            <span class="typle-active"></span>

                          @endif

                        </td>

                        <td>{{ $vacation->note}}</td>
                  
                        <td>{{ $vacation->createdBy?->full_name }} : <span class="text-success text-bold">{{ $vacation->createdBy?->role }}</span></td>
                        <td>{{ $vacation->updatedBy?->full_name }} : <span class="text-info text-bold">{{ $vacation->updatedBy?->role }}</span></td>
                        <td class="d-flex justify-content-center ">
                          <a data-toggle="modal" data-target="#delete-vacation{{$vacation->id}}" class="envelope-table ml-2"> <i class="fas fa-trash text-danger"></i></a>
                          <a data-toggle="modal" data-target="#edit-vacation{{$vacation->id}}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>
                        </td>

                    
                    </tr>
                    @include('admin.vacations.edit',['vacation'=>$vacation])

                    @include('admin.vacations.delete',['vacation'=>$vacation])
                    @endforeach
                      
                    @endisset
                   
                 </tbody>
             </table>
         </div>
     </div>
  </div>
</div>

@endsection


@section('js') @endsection
