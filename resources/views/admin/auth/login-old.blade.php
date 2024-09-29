<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>فرع الشرطة العسكرية | تسجيل الدخول</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/fonts/Cairo/cairo-font.ttf')}}">
    {{-- favicon --}}
    <link rel="icon" href="{{asset('admin/dist/img/image 5.png')}}" type="image/png">
    @notifyCss

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>منظومة الشرطة العسكرية بقطاع اللاهون</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        @if(session()->has('error'))
        <div class="alert alert-danger">
            <p>{{ session()->get('error')}}</p>
        </div>
        @endif
           
       
      <p class="login-box-msg">تسجيل الدخول</p>

      <form action="{{ route('login.post') }}" method="post">
        @csrf
        <div class="input-group mb-3 mx-auto">
            <div>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="اسم المستخدم">

            </div>
            <div>
            @error('username')
            <span class="text-danger">{{ $message }}</span>
         @enderror
        </div>
          
        </div>
        <div class="input-group mb-3">
            <div>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="كلمة السر">

            </div>
            <div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            </div>
         
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                حفظ بيانات الدخول
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <br>
            <button type="submit" class="btn btn-primary active btn-block  w-100">دخول</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

   
   
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<x-notify::notify />

@notifyJs
</body>
</html>
