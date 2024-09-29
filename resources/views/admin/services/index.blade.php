@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | الخدمات@endsection

@section('css')

<style>
  
</style>

@endsection

@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <p class="m-0 text-dark f-z-50">الخدمات</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  الخدمات</li>
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

          @can('create-service')
          <div class="btn-btn-add">
            <a  data-toggle="modal" data-target="#create-service"   class="btn btn-info btn-add active"> إضافة خدمة</a>
        </div>
          @endcan
           
               <table id="example" class="table table-striped active table-bordered">
                   <thead class="table-dark">
                       <tr>
                           <th>#</th>
                           <th>الاســــم</th>
                           <th> الاضافة بواسطة</th>
                           <th> التعديل بواسطة</th>
                           <th class="d-print-none">اجراءات</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                          
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->createdBy?->full_name }} : <span class="text-success text-bold">{{ $service->createdBy?->role }}</span></td>
                            <td>{{ $service->updatedBy?->full_name }} : <span class="text-info text-bold">{{ $service->updatedBy?->role }}</span></td>
                            <td class="d-flex justify-content-center ">
                              @can('delete-service')
                              <a data-toggle="modal" data-target="#delete-service{{$service->id}}" class="envelope-table ml-2"> <i class="fas fa-trash text-danger"></i></a>
                              @endcan

                              @can('edit-service')
                              <a data-toggle="modal" data-target="#edit-service{{$service->id}}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>
                              @endcan
                            </td>

                        
                        </tr>
                        @include('admin.services.edit-service',['service'=>$service])

                        @include('admin.services.delete-service',['service'=>$service])
                        @endforeach
                   
                   </tbody>
               </table>
           </div>
       </div>
  </div>
</div>


  @include('admin.services.create-service')
@endsection


@section('js') @endsection
