@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | سجل الخدمات@endsection

@section('css')

<style>
  
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
            <p class="m-0 text-dark f-z-50">سجل الخدمات</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> / سجل الخدمات</li>
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
                           <th>تاريخ اضافة الخدمة</th>
                           <th class="d-print-none">اجراءات</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach($data as $item)

                        @php
                        $today = Carbon::today();
                        $drop_date = Carbon::parse($item->solider->soliderStatus?->go_date);
                        $return_date = Carbon::parse($item->solider->soliderStatus?->return_date);

                        @endphp


                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->solider?->full_name }}</td>
                            <td>{{ $item->service->name }}</td>
                            <td>{{ $item->servicePlace->name }}</td>
                            <td>{{ $item->degree->name }}</td>
                            <td>{{ $item->shift->name }}</td>

                            <td>{{ $item->solider?->address }}</td>
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
            
                            <td>{{ $item->assign_date ?  $item->assign_date->format('d/m/Y') : '' }}</td>
                            <td class="d-flex justify-content-center ">
                              <a data-toggle="modal" data-target="#delete-item{{$item->id}}" class="envelope-table ml-2"> <i class="fas fa-trash text-danger"></i></a>
                            </td>

                        
                        </tr>

                        @include('admin.service-history.delete',['item'=>$item])
                        @endforeach
                   
                   </tbody>
               </table>
           </div>
       </div>
  </div>
</div>


@endsection


@section('js') @endsection
