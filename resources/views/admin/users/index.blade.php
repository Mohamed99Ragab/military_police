@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | المستخدمين@endsection

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
            <p class="m-0 text-dark f-z-50">المستخدمين</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  المستخدمين</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container-fluid mt-5 shadow  typle ">
  <div class="row">
      <div class="col-12">
        <div class="data_table">
            {{-- <div class="btn-btn-add"> 
                <div class="btn btn-info btn-add">  إضافة مستخدم  <i class="ion-person-add mr-2"></i> </div>
            </div> --}}
            <div class="btn-btn-add">
                <a href="{{ route('admin.users.create') }}" class="btn btn-info btn-add"> إضافة مستخدم</a>

            </div>
               <table id="example" class="table table-striped active table-bordered">
                   <thead class="table-dark">
                       <tr>
                           <th>#</th>
                           <th>الصورة</th>
                           <th>الاسم</th>
                           <th>اليوزرنيم</th>
                           <th>رقم الموبيل</th>
                           <th> الصلاحية</th>
                           <th class="d-print-none">اجراءات</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img class="user-image img-circle elevation-2" style="max-width: 50px" src="{{ asset($user->photo)}}" alt="" srcset="">
                            </td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="d-flex justify-content-center ">
                              <a data-toggle="modal" data-target="#delete-user{{$user->id}}" class="envelope-table ml-2"> <i class="fas fa-trash text-danger"></i></a>
                              <a href="{{ route('admin.users.edit',$user->id) }}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>
                            </td>
                        </tr>

                        @include('admin.users.delete-user',['user'=>$user])
                        @endforeach
                   
                   </tbody>
               </table>
           </div>
       </div>
  </div>
</div>

@endsection


@section('js') @endsection
