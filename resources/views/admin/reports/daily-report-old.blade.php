@extends('layouts.master')

@section('title') فرع الشرطة العسكرية @endsection

@section('css')
<style>

.table-bordered td, .table-bordered th {
    border: 3px solid black;
}

@media print {
    .row {
        display: flex !important;
        width: 100% !important;
    }
    .col-md-4 {
        width: 33.33% !important;
        float: none !important;
    }
    .table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    .table td, .table th {
        border: 1px solid black !important;
    }
    /* إخفاء أي عناصر غير ضرورية للطباعة */
    .no-print {
        display: none !important;
    }
}





</style>



@endsection

@php
  use Carbon\Carbon;

@endphp

@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <p class="m-0 text-dark f-z-50"></p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
                <li class="breadcrumb-item active"> /  التقارير اليومية</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


        <div class="container-fluid mt-5 shadow  typle ">
          <div class="row">
            <div class="col-md-4">
              <div>
                <p style="font-weight: 700">وزارة الدفـــــــــــــــــــــــــــــــــــــــاع<br>
                  جهاز مستقبل مصر للتنمية المستدامة<br>
                  قطاع اللاهون للزراعات المحميــــــــة<br>
                  فرع الشرطـــــــــة العسكريـــــــــــــــة
                </p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="container-fluid">
                <img src="{{asset('admin/dist/img/image 5.png')}}" alt="AdminLTE Logo" style="max-width: 100px" class=" img-circle container-fluid">

              </div>
            </div>


            <div class="col-md-4">
              <div class="container-fluid">
                <img src="{{asset('admin/dist/img/future-logo.jpg')}}" alt="AdminLTE Logo" style="max-width: 180px" class="container-fluid">

              </div>
            </div>

          </div>
          <div class="row">
              <div class="col-12">
                <h2 class="text-center my-4" style="font-size:30px; text-decoration:underline">يومية تمام بقوة جنود فرع الشرطة العسكرية قطاع اللاهون عن يوم  {{ Carbon::today()->format('d/m/Y') }}</h2>
                <div class="data_table">


                  <button class="no-print btn btn-success my-2" onclick="printTable()">طباعة التقرير</button>

                  <table  cellpadding="10" cellspacing="0" class="table table-striped table-bordered">
                      <thead class="table-dark" cellpadding="10">

                        <tr style="background-color: #fff;border:solid 3px black">
                          <th colspan="4" style="color: black">البيان العام</th>

                          <th colspan="9" style="color: black;border:2px"> تمام الخوارج</th>


                        </tr>
                        <tr style="background-color: rgb(211, 203, 203)">
                           <th style="color: black">الخدمة</th>
                           <th style="font-weight: 700;color:rgb(40, 66, 235);"> القوة</th>
                           <th style="font-weight: 700;color:green;"> موجود</th>
                           <th style="font-weight: 700;color:red;"> خارج</th>

                           <th style="font-weight: 400;color:rgb(150, 65, 65);"> إجازة</th>
                           <th style="font-weight: 400;color:rgb(150, 65, 65);">  مأمورية</th>
                           <th style="font-weight: 400;color:rgb(150, 65, 65);">  غياب</th>
                           <th style="font-weight: 400;color:rgb(150, 65, 65);"> هروب</th>

                           <th style="font-weight: 400;color:rgb(150, 65, 65);"> مرضية</th>
                           <th style="font-weight: 400;color:rgb(150, 65, 65);">  سجن</th>
                           <th style="font-weight: 400;color:rgb(150, 65, 65);">  سجن مركزي</th>
                           <th style="font-weight: 400;color:rgb(150, 65, 65);">  مستشفى</th>
                          </tr>
                      </thead>
                      <tbody>
                       @foreach($data as $row)
                       <tr>
                           <td>{{ $row['service'] }}</td>
                           <td>{{ $row['total'] }}</td>
                           <td>{{ $row['present'] }}</td>
                           <td>{{ $row['notPresent'] }}</td>
                           <td>{{ $row['onVacation'] }}</td>
                           <td>{{ $row['onMission'] }}</td>
                           <td>{{ $row['absentStatus'] }}</td>
                           <td>{{ $row['escaped'] }}</td>
                           <td> {{ $row['onIllnessVacation'] }} </td>
                           <td>{{ $row['inJail'] }}</td>
                           <td>{{ $row['inCentralJail'] }}</td>
                           <td>{{ $row['inHospital'] }}</td>
                       </tr>
                   @endforeach
                   <!-- Add the summary row here -->
                   <tr id="rowToMove" style="background-color: rgb(211, 203, 203)">
                       <td><strong>الإجمالي</strong></td>
                       <td style="font-weight: 700;color:rgb(40, 66, 235);"><strong>{{ $totals['totalSoliders'] }}</strong></td>
                       <td style="font-weight: 700;color:green;"><strong>{{ $totals['totalPresent'] }}</strong></td>
                       <td style="font-weight: 700;color:red;"><strong>{{ $totals['totalNotPresent'] }}</strong></td>
                       <td style="font-weight: 400;color:rgb(150, 65, 65);"><strong>{{ $totals['totalOnVacation'] }}</strong></td>
                       <td style="font-weight: 400;color:rgb(150, 65, 65);"><strong>{{ $totals['totalOnMission'] }}</strong></td>
                       <td style="font-weight: 400;color:rgb(150, 65, 65);"><strong>{{ $totals['totalAbsentStatus'] }}</strong></td>
                       <td style="font-weight: 400;color:rgb(150, 65, 65);"><strong>{{ $totals['totalEscaped'] }}</strong></td>

                       <td style="font-weight: 400;color:rgb(150, 65, 65);"><strong>{{ $totals['totalIllnessVacation'] }}</strong></td>
                       <td style="font-weight: 400;color:rgb(150, 65, 65);"><strong>{{ $totals['totalInJail'] }}</strong></td>
                       <td style="font-weight: 400;color:rgb(150, 65, 65);"><strong>{{ $totals['totalInCentralJail'] }}</strong></td>
                       <td style="font-weight: 400;color:rgb(150, 65, 65);"><strong>{{ $totals['totalInHospital'] }}</strong></td>
                   </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          </div>
        </div>
    </div>



    @endsection


@section('js')

        <script>

            function printTable() {
             window.print();
            }


        </script>


@endsection
