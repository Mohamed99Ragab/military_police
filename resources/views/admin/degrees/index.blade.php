@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | الدرجات@endsection

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
            <p class="m-0 text-dark f-z-50"> الدرجات</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /   الدرجات</li>
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
            @can('create-degree')
              <div class="btn-btn-add">
                <a  data-toggle="modal" data-target="#create-degree"   class="btn btn-info btn-add active">إضافة درجة جديد</a>
            </div>
            @endcan
            


               <table id="example" class="table table-striped active table-bordered">
                   <thead class="table-dark">
                       <tr>
                           <th>#</th>
                           <th>الدرجة</th>
                           <th> الاضافة بواسطة</th>
                           <th> التعديل بواسطة</th>
                           <th class="d-print-none">اجراءات</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach($degrees as $degree)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $degree->name }}</td>
                            <td>{{ $degree->createdBy?->full_name }} : <span class="text-success text-bold">{{ $degree->createdBy?->role }}</span></td>
                            <td>{{ $degree->updatedBy?->full_name }} : <span class="text-info text-bold">{{ $degree->updatedBy?->role }}</span></td>
                            <td class="d-flex justify-content-center ">
                              @can('delete-degree')
                              <a data-toggle="modal" data-target="#delete-degree{{$degree->id}}" class="envelope-table ml-2"> <i class="fas fa-trash text-danger"></i></a>
                              @endcan
                              
                              @can('edit-degree')
                              <a data-toggle="modal" data-target="#edit-degree{{$degree->id}}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>
                             @endcan
                            </td>

                        
                        </tr>
                        @include('admin.degrees.edit-degree',['degree'=>$degree])

                        @include('admin.degrees.delete-degree',['degree'=>$degree])
                        @endforeach
                   
                   </tbody>
               </table>
           </div>
       </div>
  </div>
</div>


  @include('admin.degrees.create-degree')
@endsection


@section('js') @endsection
