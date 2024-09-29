@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | اماكن الخدمات@endsection

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
            <p class="m-0 text-dark f-z-50">اماكن الخدمات</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  اماكن الخدمات</li>
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
            @can('create-service-place')
            <div class="btn-btn-add">
              <a  data-toggle="modal" data-target="#create-place"   class="btn btn-info btn-add active">  إضافة مكان جديد</a>

          </div>
            @endcan
            
               <table id="example" class="table table-striped active table-bordered">
                   <thead class="table-dark">
                       <tr>
                           <th>#</th>
                           <th>الخدمة</th>
                           <th>مكان الخدمة</th>
                           <th> الاضافة بواسطة</th>
                           <th> التعديل بواسطة</th>
                           <th class="d-print-none">اجراءات</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach($places as $place)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $place->service?->name }}</td>
                            <td>{{ $place->name }}</td>
                            <td>{{ $place->createdBy?->full_name }} : <span class="text-success text-bold">{{ $place->createdBy?->role }}</span></td>
                            <td>{{ $place->updatedBy?->full_name }} : <span class="text-info text-bold">{{ $place->updatedBy?->role }}</span></td>
                            <td class="d-flex justify-content-center ">
                              @can('delete-service-place')
                              <a data-toggle="modal" data-target="#delete-place{{$place->id}}" class="envelope-table ml-2"> <i class="fas fa-trash text-danger"></i></a>
                             @endcan

                             @can('edit-service-place')
                              <a data-toggle="modal" data-target="#edit-place{{$place->id}}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>
                            @endcan
                            </td>

                        
                        </tr>
                        @include('admin.places.edit-place',['place'=>$place])

                        @include('admin.places.delete-place',['place'=>$place])
                        @endforeach
                   
                   </tbody>
               </table>
           </div>
       </div>
  </div>
</div>


  @include('admin.places.create-place')
@endsection


@section('js') @endsection
