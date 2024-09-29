@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | خدمات الجنود@endsection

@section('css')

<style>
  .dataTables_paginate .pagination{
    display:none;
  }
</style>

@endsection



@php
     use Carbon\Carbon;
@endphp

@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <p class="m-0 text-dark f-z-50">خدمات الجنود</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  خدمات الجنود</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container-fluid mt-5 shadow  typle ">

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
        <div class="data_table">
          @can('create-service-solider')
              <div class="btn-btn-add">
                  <a  data-toggle="modal" data-target="#create-service"   class="btn btn-info btn-add active"> إضافة خدمة</a>
              </div>
            @endcan
               <table id="example" class="table table-striped active table-bordered">
                   <thead class="table-dark">
                       <tr>
                           <th>#</th>
                           <th>الاســــم</th>
                           <th>نوع الخدمة</th>
                           <th>مكان الخدمة</th>
                           <th>الدرجة</th>
                           <th> الشيفت </th>
                           <th>العنوان</th>
                           <th>الحالة</th>
                           <th> الاضافة بواسطة</th>
                           <th> التعديل بواسطة</th>
                           <th class="d-print-none">اجراءات</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach($soliderServices as $soliderService)

                        @php
                        $today = Carbon::today();
                        $drop_date = Carbon::parse($soliderService->solider->soliderStatus?->go_date);
                        $return_date = Carbon::parse($soliderService->solider->soliderStatus?->return_date);
                        @endphp



                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>  <a href="{{ route('admin.service.history.index',$soliderService->solider?->id) }}">{{ $soliderService->solider?->full_name }} </a> </td>
                            <td>{{ $soliderService->service?->name }}</td>
                            <td>{{ $soliderService->servicePlace?->name }}</td>
                            <td>{{ $soliderService->degree?->name }}</td>
                            <td>{{ $soliderService->shift?->name }}</td>

                            <td>{{ $soliderService->solider?->address }}</td>
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

                            <td>{{ $soliderService->createdBy?->full_name }} : <span class="text-success text-bold">{{ $soliderService->createdBy?->role }}</span></td>
                            <td>{{ $soliderService->updatedBy?->full_name }} : <span class="text-info text-bold">{{ $soliderService->updatedBy?->role }}</span></td>
                            <td class="d-flex justify-content-center ">
                              @can('delete-service-solider')
                              <a data-toggle="modal" data-target="#delete-service{{$soliderService->id}}" class="envelope-table ml-2"> <i class="fas fa-trash text-danger"></i></a>
                             @endcan

                             @can('edit-service-solider')
                          {{--    <a data-toggle="modal" data-target="#edit-service{{$soliderService->id}}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a> --}}
                              <a href="{{ route('admin.serviceSoliders.edit',$soliderService->id) }}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>

                              @endcan
                            </td>


                        </tr>
                     {{--   @include('admin.solider-service.edit',['soliderService'=>$soliderService]) --}}

                        @include('admin.solider-service.delete',['soliderService'=>$soliderService])
                        @endforeach


                      

                   </tbody>
                  
                  
               </table>

               {!! $soliderServices->links() !!}

           </div>
       </div>
  </div>
</div>


  @include('admin.solider-service.create')
@endsection







