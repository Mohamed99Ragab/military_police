<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <x-notify::notify />

  <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('admin/dist/img/image 5.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
      <span class="brand-text font-z-20 font-weight-light">الشرطة العسكرية <span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <li class="nav-item ">
      <a href="{{ route('admin.home')}}" class="nav-link icon-sidebar  {{ Request::is('admin/home') ? 'active' : ''}}">
        <i class="fas fa-home"></i>
        <p  class=" ">الرئـــــيســـــية</p>
      </a>
    </li>

    @can('manage-users')
    <li class="nav-item">
      <a href="{{ route('admin.users.index') }}" class="nav-link icon-sidebar {{ Request::is('admin/users*') ? 'active' : ''}}">
        <i class="fas fa-users-cog"></i>
        <p class="">المستخدمين</p>
      </a>
    </li>
    @endcan

    @can('view-soliders')
    <li class="nav-item">
      <a href="{{route('admin.soliders.index')}}" class="nav-link icon-sidebar {{ Request::is('admin/soliders*') ? 'active' : ''}}">
        <i class="fas fa-user-friends"></i>
        <p class="">أفـــراد</p>
      </a>
    </li>
    @endcan

    @can('view-service-solider')
    <li class="nav-item">
      <a href="{{route('admin.serviceSoliders.index')}}" class="nav-link icon-sidebar {{ Request::is('admin/serviceSoliders*') ? 'active' : ''}}">
        <i class="fas fa-hands-helping"></i>
        <p class="">خدمات الجنود</p>
      </a>
    </li>
    @endcan

    <li class="nav-item">
      <a href="{{ route('admin.soliderStatues.index')}}" class="nav-link icon-sidebar {{ Request::is('admin/soliderStatues*') ? 'active' : ''}}">
        <i class="fas fa-user-shield"></i>
        <p class="">حالات الجنود</p>
      </a>
    </li>

    <li class="nav-item has-treeview">
      <a href="#" class="nav-link {{ Request::is('admin/reports*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-chart-bar"></i>
        <p>التقارير <i class="right fas fa-angle-left"></i></p>
      </a>
      <ul class="nav nav-treeview">
        @can('view-solider-report')
        <li class="nav-item">
          <a href="{{route('admin.reports.solider.index')}}" class="nav-link {{ Request::is('admin/reports/solider*') ? 'active' : ''}}">
            <i class="far fa-file-alt nav-icon"></i>
            <p>تقارير الجنود</p>
          </a>
        </li>
        @endcan
        <li class="nav-item">
          <a href="{{route('admin.reports.daily')}}" class="nav-link {{ Request::is('admin/reports/daily*') ? 'active' : ''}}">
            <i class="far fa-calendar-alt nav-icon"></i>
            <p>تقارير يومية</p>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item has-treeview">
      <a href="#" class="nav-link {{ Request::is('admin/system-management*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cogs"></i>
        <p>إدارة النظام <i class="right fas fa-angle-left"></i></p>
      </a>
      <ul class="nav nav-treeview">
        @can('view-services')
        <li class="nav-item">
          <a href="{{route('admin.services.index')}}" class="nav-link {{ Request::is('admin/system-management/services*') ? 'active' : ''}}">
            <i class="fas fa-concierge-bell nav-icon"></i>
            <p>خدمات القطاع</p>
          </a>
        </li>
        @endcan

        @can('view-service-places')
        <li class="nav-item">
          <a href="{{route('admin.places.index')}}" class="nav-link {{ Request::is('admin/system-management/places*') ? 'active' : ''}}">
            <i class="fas fa-map-marker-alt nav-icon"></i>
            <p>اماكن التواجد</p>
          </a>
        </li>
        @endcan

        @can('view-degrees')
        <li class="nav-item">
          <a href="{{route('admin.degrees.index')}}" class="nav-link {{ Request::is('admin/system-management/degrees*') ? 'active' : ''}}">
            <i class="fas fa-chevron-circle-up nav-icon"></i>
            <p>الدرجات / الرتب</p>
          </a>
        </li>
        @endcan

        @can('view-shifts')
        <li class="nav-item">
          <a href="{{route('admin.shifts.index')}}" class="nav-link icon-sidebar {{ Request::is('admin/system-management/shifts*') ? 'active' : ''}}">
            <i class="fas fa-business-time nav-icon"></i>
            <p>الشيفتات</p>
          </a>
        </li>
        @endcan
      </ul>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
