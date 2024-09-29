@extends('layouts.master')

@section('title') فرع الشرطة العسكرية @endsection

@section('css') @endsection
@php
    use App\Enums\RoleEnum;  
  @endphp
  
@section('content')
<div class="content-wrapper ">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <p class="m-0 text-dark f-z-50">اضافة مستخدم</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">  المستخدمين<a></li>
              <li class="breadcrumb-item active"> /  اضافة مستخدم</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

            @if ($errors->any())
            <div class="alert alert-info w-75 mx-auto">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


  
    <form role="form" action="{{ route('admin.users.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
    <div class="row container justify-content-between py-5">
        <div class="col-8 section-from shadow">
         <!-- ************************* -->
          <div class="card-body">
            <div class="form-group">
              <label for="name">  اليوزرنيم</label>
              <input type="text" name="username" class="form-control" id="name" >
            </div>

            <div class="form-group">
              <label for="name"> اسم المستخدم</label>
              <input type="text" name="full_name" class="form-control" id="name" >
            </div>

            <div class="form-group">
                <label for="phone_number"> رقم الموبيل</label>
                <input type="text" name="phone_number" class="form-control" id="phone_number" >
              </div>

            <div class="form-group">
              <label for="password">كلمة السر</label>
              <input type="password" name="password" class="form-control" id="address">
            </div>
            <div class="form-group">
              <label for="password-confirm"> تأكيد كلمة السر</label>
              <input type="password" name="password-confirm" class="form-control" id="password-confirm">
            </div>
            
            <div class="form-group">
              <label>الصلاحية</label>
              <select name="role" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="{{ RoleEnum::Solider}}">{{ RoleEnum::Solider}}</option>
                <option value="{{ RoleEnum::OfficerClass}}"> {{ RoleEnum::OfficerClass }}</option>
                <option value="{{ RoleEnum::Admin}}">{{ RoleEnum::Admin}}</option>
              
              </select>
            </div>
            <!-- /.form-group -->
          </div>

          <div class="modal-footer border-none justify-content-between">
            <button type="submit" class="btn btn-primary w-25 active">حفظ </button>
            <button type="button" class="btn btn-danger active" data-dismiss="modal">الغاء</button>
          </div>
     







         <!-- *************************** -->
        
        </div>
        <!-- ./col-8 -->
        <div class="col-3 section-phone shadow">
          <!-- ***************************** -->
           <img src="{{ asset('admin/dist/img/AdminLTELogo.png')}}" alt="" srcset="">
          <div class="form-group">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="photo"  id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">إضافة صورة</label>
              </div>
           
        </div>
         </div>
         

          <!-- ***************************** -->
        
         </div>
      <!-- ./col-4 -->
      </div>
    </form>
       

@endsection


@section('js') @endsection
