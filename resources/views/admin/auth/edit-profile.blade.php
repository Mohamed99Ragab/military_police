@extends('layouts.master')

@section('title') فرع الشرطة العسكرية @endsection

@section('css') @endsection

@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <p class="m-0 text-dark f-z-50">الملف الشخصي</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  الملف الشخصي</li>
            </ol> 
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container mt-5 shadow  typle ">
  <div class="row">
 
            @if ($errors->any())
            <div class="alert alert-info w-75 mx-auto">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

      <div class="col-12">
        <div class="container">
            <form action="{{ route('admin.edit.profile.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for=""> اليوزرنيم</label>
                    <input type="text" class="form-control" name="username"  value="{{ auth()->user()->username }}">
                </div>

                <div class="form-group">
                  <label for="name"> اسم المستخدم</label>
                  <input type="text" value="{{ auth()->user()->full_name}}" name="full_name" class="form-control" id="name" >
                </div>

                <div class="form-group">
                  <label for=""> رقم الهاتف</label>
                  <input type="text" class="form-control" name="phone_number"  value="{{ auth()->user()->phone_number }}">
              </div>
                <div class="form-group">
                    <label for="">كلمة السر</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label for="">تأكيد كلمة السر</label>
                    <input type="password" class="form-control" name="password-confirm" >
                </div>


                <div class="form-group">
                    <label for="">صورة الملف الشخصي</label>
                    <br>
                    <input type="file" name="photo" >
                </div>

                <button type="submit" class="btn btn-outline-primary w-100 active">تحديث</button>
            </form>
        </div>
  </div>
</div>

@endsection


@section('js') @endsection
