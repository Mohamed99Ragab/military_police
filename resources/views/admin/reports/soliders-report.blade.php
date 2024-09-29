@extends('layouts.master')

@section('title') التقارير @endsection

@section('css')
    <style>
       .buttons-print ,.buttons-pdf {
           display: none;
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
            <p class="m-0 text-dark f-z-50">الرئـيســـــية</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  التقارير</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container-fluid mt-5 shadow  typle ">
  <h2 style="font-size: 50px; font-weight:700">تقارير الجنود</h2>

  <form action="{{ route('admin.reports.solider')}}" method="GET">
    @csrf

    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="">الاسم</label>
          <input type="text" value="{{ $requestData->name?? '' }}"  class="form-control" name="name">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="">الرقم العسكري</label>
          <input type="text"  value="{{ $requestData->military_number?? '' }}" class="form-control" name="military_number">
        </div>
      </div>


      <div class="col-md-4">
        <div class="form-group">
          <label for="">الدرجـــة</label>
          <select class="form-control select2" name="degree_id" id="degree">
            <option value="" selected>اختر الدرجة</option>
            @foreach($degrees as $degree)
            <option {{ isset($requestData->degree_id) ? $requestData->degree_id == $degree->id ? 'selected' :'' :'' }} value="{{ $degree->id }}"> {{ $degree->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label for=""> رقم الهاتف</label>
            <input type="text"  value="{{ $requestData->phone_number?? '' }}" class="form-control" name="phone_number">
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label for=""> العنوان</label>
            <input type="text"  value="{{ $requestData->address?? '' }}" class="form-control" name="address">
          </div>
        </div>


        <div class="col-md-3">
          <div class="form-group">
            <label for="">الخدمة</label>
            <select class="form-control select2" name="service_id" id="service">
              <option value="" selected>اختر الخدمة</option>
              @foreach($services as $service)
              <option {{ isset($requestData->service_id) ? $requestData->service_id == $service->id ? 'selected' :'' :'' }} value="{{ $service->id }}"> {{ $service->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label for="">حالة الفرد</label>
            <select class="form-control select2" name="status" >
              <option value="" selected>اختر الحالة</option>
              <option value="موجود">موجود</option>
              <option value="خارج">خارج</option>
              @foreach(SoliderStatusEnum::statues() as $status)
              <option {{ isset($requestData->status) ? $requestData->status == $status ? 'selected' :'' :'' }} value="{{ $status }}"> {{ $status }}</option>
              @endforeach

            </select>
          </div>
        </div>


    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for=""> معاد النزول</label>
         <input type="date"  value="{{ $requestData->go_date?? '' }}" name="go_date"  class="form-control">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="service-select"> معاد العودة</label>
         <input type="date" value="{{ $requestData->return_date?? '' }}" name="return_date" class="form-control">
        </div>
      </div>


    </div>

    <button type="submit" class="btn btn-primary active w-100 my-4">بحث</button>

  </form>



  <div class="row">

      <div class="col-12">
        <div class="data_table">

            <div class="row justify-content-start">
                <div class="col-md-2">

                        <a class="btn btn-success my-2 active" onclick="printTable()">طباعة التقرير</a>

                </div>

{{--                <div class="col-md-2">--}}
{{--                    <div>--}}
{{--                        <a href="{{ route('admin.soliders.export') }}" class="btn btn-outline-warning">--}}
{{--                            تصدير الجنود <i class="fas fa-file-export mr-2"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}

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

                    @isset($soliders)
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
                    @endisset

                 </tbody>
             </table>
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
