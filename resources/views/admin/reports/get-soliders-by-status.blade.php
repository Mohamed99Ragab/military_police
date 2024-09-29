@extends('layouts.master')

@section('title') التقارير @endsection

@section('css')
    <style>
       .buttons-print ,.buttons-pdf{
           display: none;
       }


       .dataTables_paginate .pagination{
            display:none;
        }


    </style>

@endsection
@php
     use Carbon\Carbon;
     use App\Enums\SoliderStatusEnum;


@endphp
@section('content')
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            @if($status == 'total')
            <p class="m-0 text-dark f-z-50">  اجمالي الافراد</p>

            @elseif($status == 'found')
            <p class="m-0 text-dark f-z-50">اجمالي الافراد الموجودين</p>

            @elseif($status == 'notfound')
            <p class="m-0 text-dark f-z-50"> اجمالي الافراد الغير موجودين</p>

            @else
            <p class="m-0 text-dark f-z-50">حالة الافراد {{ $status  }}</p>

            @endif
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> / التقارير عن حالة الافراد</li>
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

            <div class=" btn-group">
                <button class="btn btn-success my-2" onclick="printTable()">طباعة التقرير</button>
            </div>

            <table id="example" class="table table-striped table-bordered table-responsive">
                 <thead class="table-dark">
                     <tr>
                         <th style="width: 2% !important;">#</th>
                         <th style="width: 10% !important;">الاســــم</th>
                         <th >العنـــوان</th>
                         <th >الرقم العسكرى</th>
                         <th >رقم التليفون</th>
                         <th >الدرجـــة</th>
                         <th>نوع الخدمة</th>
                         <th >مكان الخدمة</th>
                         <th > الشيفت </th>
                         <th >الحالة</th>
                         <th >معاد الذهاب</th>
                         <th >معاد العودة</th>
                         <th>حالة التواجد</th>
                         <th class="d-print-none">اجراءات</th>
                     </tr>
                 </thead>
                 <tbody>

                    
                   @foreach($soliders as $solider)

                        @php
                        $today = Carbon::today();
                        $drop_date = Carbon::parse($solider->soliderStatus?->go_date);
                        $return_date = Carbon::parse($solider->soliderStatus?->return_date);

                        @endphp


                        <tr>
                          <td> {{ $loop->iteration }}</td>
                          <td> {{ $solider->full_name }}</td>
                            <td>{{ $solider->address }}</td>
                            <td>{{ $solider->military_number }}</td>
                            <td>{{ $solider->phone_number }}</td>
                            <td>{{ $solider->degree?->name }}</td>
                            <td>{{ $solider->soliderService?->service?->name }}</td>
                          <td>{{ $solider->soliderService?->servicePlace?->name }}</td>
                          <td>{{ $solider->soliderService?->shift?->name }}</td>
                          <td> {{ $solider->soliderStatus?->status }} </td>
                          <td> {{ $solider->soliderStatus?->go_date?->format('d/m/Y') }} </td>
                         <td> {{ $solider->soliderStatus?->return_date?->format('d/m/Y') }} </td>

                          <td>
                                  @if($today->eq($return_date))
                                  موجود
                                    <span class="typle-active"></span>
                                  @elseif($today->between($drop_date,$return_date) || $today->eq($drop_date))
                                  غير موجود
                                  <span class="typle-active-no"></span>
                                    @else
                                    موجود
                                    <span class="typle-active"></span>

                                  @endif

                                </td>
                          <td class="d-flex justify-content-between d-print-none">
                            <a data-toggle="modal" data-target="#delete-solider{{$solider->id}}"  class="envelope-table"> <i class="fas fa-trash text-danger"></i></a>
                            <a href="{{ route('admin.soliders.edit',$solider->id) }}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>
                          </td>
                      </tr>


                             @include('admin.soliders.delete-solider',['solider'=>$solider])

                    @endforeach
                   

                 </tbody>
             </table>
             {!! $soliders->links() !!}

         </div>
     </div>
  </div>
</div>




@endsection


@section('js')

        <script>
            function printTable() {
                // الحصول على الجدول
                var table = $('#example').DataTable();

                // استخراج البيانات من جميع الصفوف
                var tableData = '<table id="printableTable" class="table table-striped table-bordered table-responsive">';

                // إضافة رؤوس الأعمدة
                tableData += '<thead>' + $('#example thead').html() + '</thead>';

                // إضافة البيانات من جميع الصفوف
                tableData += '<tbody>';
                table.rows().every(function() {
                    var row = this.node();
                    tableData += '<tr>' + $(row).find('td').map(function() {
                        return '<td>' + $(this).html() + '</td>';
                    }).get().join('') + '</tr>';
                });
                tableData += '</tbody></table>';

                // إنشاء نافذة جديدة للطباعة
                var printWindow = window.open('', '', 'height=1200,width=2000');

                // كتابة HTML للنافذة الجديدة
                printWindow.document.write('<html dir="rtl"><head><title>طباعة التقرير</title>');
                printWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #000; padding: 8px; text-align: left; }</style>');
                printWindow.document.write('</head><body >');

                // نسخ محتوى الجدول إلى النافذة الجديدة
                printWindow.document.write(tableData);

                printWindow.document.write('</body></html>');



                // إغلاق النافذة الجديدة وإطلاق عملية الطباعة
                printWindow.document.close();
                printWindow.focus();

                // التحقق مما إذا تم إلغاء الطباعة، وإغلاق النافذة في حالة إلغاء الطباعة
                printWindow.onafterprint = function () {
                    printWindow.close();
                };

                printWindow.print();
            }
        </script>




@endsection
