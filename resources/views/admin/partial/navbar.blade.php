<nav class="main-header navbar navbar-expand navbar-white navbar-light nav-cut">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  
 

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
     
    
      <li class="nav-item dropdown user-menu ">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          @if (auth()->user()->photo)
          <img src="{{asset(auth()->user()->photo)}}" class="user-image img-circle elevation-2" alt="User Image">
          
          @else
          <img src="{{ asset('admin/avatar.png')}}" class="user-image img-circle elevation-2" alt="User Image">

          @endif
          <span class="d-none d-md-inline"> {{ auth()->user()->full_name }}</span> <i class="fas fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            @if (auth()->user()->photo)
            <img src="{{asset(auth()->user()->photo)}}" class="img-circle elevation-2" alt="User Image">
            
            @else
            <img src="{{ asset('admin/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
  
            @endif
            <p>
              {{ auth()->user()->username }}
              <small>الصلاحية / {{ auth()->user()->role }}</small>
            </p>
          </li>
          <!-- Menu Body -->
          
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('admin.edit.profile.index') }}" class="btn btn-info btn-flat">الملف  الشخصي</a>
            <a href="{{ route('admin.logout')}}" class="btn btn-danger btn-flat float-right">تسجيل الخروج</a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>