@extends('layouts.master')

@section('title') فرع الشرطة العسكرية @endsection

@section('css') @endsection

@section('content')
<div class="content-wrapper ">

  @php
    use App\Enums\RoleEnum;  
  @endphp
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <p class="m-0 text-dark f-z-50">تعديل مستخدم</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">  المستخدمين<a></li>
              <li class="breadcrumb-item active"> /  تعديل مستخدم</li>
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


  
    <form role="form" action="{{ route('admin.users.update',$user->id)}}" enctype="multipart/form-data" method="POST" autocomplete="off">
        @csrf
        @method('PATCH')
        
    <div class="row container justify-content-between py-5">
        <div class="col-8 section-from shadow">
         <!-- ************************* -->
          <div class="card-body">
            <div class="form-group">
              <label for="name">  اليوزرنيم</label>
              <input type="hidden" name="id" value="{{ $user->id}}">
              <input type="text" value="{{ $user->username}}" name="username" class="form-control" id="name" >
            </div>

            <div class="form-group">
              <label for="name"> اسم المستخدم</label>
              <input type="text" value="{{ $user->full_name}}" name="full_name" class="form-control" id="name" >
            </div>

            <div class="form-group">
                <label for="phone_number"> رقم الموبيل</label>
                <input type="text" value="{{ $user->phone_number}}" name="phone_number" class="form-control" id="phone_number" >
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
                <option {{ $user->role == RoleEnum::Solider ?'selected':''}} value="{{ RoleEnum::Solider}}">{{ RoleEnum::Solider}}</option>
                <option {{ $user->role ==RoleEnum::OfficerClass ?'selected':''}} :value="RoleEnum::OfficerClass"> {{ RoleEnum::OfficerClass }}</option>
                <option {{ $user->role ==RoleEnum::Admin ?'selected':''}} :value="RoleEnum::Admin">{{ RoleEnum::Admin }}</option>
                
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
          @if($user->photo)
              <img src="{{ asset($user->photo)}}" class="mb-4" alt="" srcset="">
          @else
          <img src="{{ asset('admin/dist/img/AdminLTELogo.png')}}" alt="" srcset="">

          @endif
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
