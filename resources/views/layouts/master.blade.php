<!DOCTYPE html>
<html dir='rtl' >


@include('admin.partial.head')

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <!-- Navbar -->
    @include('admin.partial.navbar')

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.partial.sidebar')

    <!-- Content Wrapper. Contains page content -->
        @yield('content')




  <!-- **************************************************************************** -->


    </div>
    <!-- /.content-wrapper -->
    @include('admin.partial.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  @include('admin.partial.scripts')
</body>

</html>
