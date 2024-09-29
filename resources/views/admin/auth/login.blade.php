<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>فرع الشرطة العسكرية | تسجيل الدخول</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('admin/fonts/Cairo/cairo-font.ttf')}}"> --}}
    {{-- favicon --}}
    <link rel="icon" href="{{asset('admin/dist/img/image 5.png')}}" type="image/png">

    @notifyCss

    <link rel="stylesheet" href="{{ asset('admin/css/mycustomstyle.css') }}">



</head>
<body>


  <div class="home-page">
    <div class="section-from">
     <div class="from">
         <h2>تسجيل دخول</h2>
         <form  action="{{ route('login.post') }}" method="post">
          @csrf

          <div class="input-group">
             <label for="user"> اسم المستخدم</label>
               <input id="user" name="username" type="text" />
               @error('username')
                 <span class="text-danger">{{ $message }}</span>
               @enderror
          </div>
         <div class="input-group">
             <label for="pas"> كلمة المرور </label>
            <input id="pas"type="password" name="password" />
            @error('password')
               <span class="text-danger">{{ $message }}</span>
             @enderror
         </div>
         
          <input type="submit" value="تسجيل الدخول" />
         </form>
     </div>
    </div>
 </div>








<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<x-notify::notify />

@notifyJs
</body>
</html>
