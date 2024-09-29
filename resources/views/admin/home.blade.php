@extends('layouts.master')

@section('title') فرع الشرطة العسكرية @endsection

@section('css')

    <style>
        th {
            white-space: nowrap;
        }

        .buttons-print{
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
            <p class="m-0 text-dark f-z-50">الرئـيســـــية</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
            <!-- <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  الرئـيسـية</li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-primary">
              <a href="{{ route('admin.reports.soliders.status','total') }}"  style="text-decoration:none">
              <div class="inner py-2">
                <h3>{{ $totalSoliders}}</h3>

                <p class="box-des">القــوة </p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-success">
            <a href="{{ route('admin.reports.soliders.status','found') }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $solidersIsFound}}<sup style="font-size: 20px"></sup></h3>

                <p class="box-des">متواجد</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
           </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-danger">
            <a href="{{ route('admin.reports.soliders.status','notfound') }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $solidersIsNotFound }}</h3>

                <p class="box-des">خوارج</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
           </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-white">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::Hospital) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $solidersIsHospital }}</h3>

                <p class="box-des"> مستشفى</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row">
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-danger">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::Prison) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $Prison}}</h3>

                <p class="box-des">سجن </p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-dark">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::CentralPrison) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $CentralPrison}}<sup style="font-size: 20px"></sup></h3>

                <p class="box-des">سجن مركزي</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-indigo">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::Absence) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $Absence }}</h3>

                <p class="box-des">غياب</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
             </a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-maroon">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::Fleeing) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $Fleeing }}</h3>

                <p class="box-des"> هروب</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
             </a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="row">
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-olive">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::IllnessVacation) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $IllnessVacation}}</h3>

                <p class="box-des">اجازة مرضية </p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
          </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-olive">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::OriginalVacation) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $OriginalVacation}}<sup style="font-size: 20px"></sup></h3>

                <p class="box-des"> اجازة اسبوعية</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
             </a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-olive">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::ExceptionVacation) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $ExceptionVacation }}</h3>

                <p class="box-des">اجازة استثنائية</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
             </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-olive">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::IndividualVacation) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $IndividualVacation }}</h3>

                <p class="box-des"> اجازة فردية</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
               </a>
              </div>
          </div>
          <!-- ./col -->
        </div>


        <div class="row">
          <div class="col-md-4 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-info">
            <a href="{{ route('admin.reports.soliders.status',SoliderStatusEnum::Mission) }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $Mission }}</h3>

                <p class="box-des">مامؤرية</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
              </a>
            </div>
          </div>


          <div class="col-md-4 text-center">
            <!-- small box -->
            <div class="small-box bg-gradient-pink">
            <a href="{{ route('admin.reports.soliders.status','noservices') }}"  style="text-decoration:none">

              <div class="inner py-2">
                <h3>{{ $solidersDosntHaveService }}</h3>

                <p class="box-des">الجنود ليس لديهم خدمات</p>
              </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
              </a>
            </div>
          </div>
        </div>


        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<!-- *************************  data tame ***************************** -->
<div class="container-fluid mt-5 shadow  typle ">
  @if ($errors->any())
  <div class="alert alert-danger w-75 mx-auto text-center">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
<div class="row">
<div class="col-12">
<div class="data_table">
    <div class=" btn-group">
        <button class="btn btn-success" onclick="printTable()">طباعة </button>
    </div>
  @can('create-solider')
   <div class="btn-btn-add">
    <div class="btn btn-info btn-add active"  data-toggle="modal" data-target="#create-solider" >  إضافة فرد جديد  <i class="ion-person-add mr-2"></i> </div>
  </div>
  @endcan
      <table id="example" class="table table-striped table-bordered">
          <thead class="table-dark">
              <tr>
                  <th>#</th>
                  <th>الاســــم</th>
                  <th>الرقم العسكرى</th>
                  <th>رقم التليفون</th>
                  <th>الدرجـــة</th>
                  <th>العنـــوان</th>
                  <th>الحالة</th>
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
              <td>{{ $solider->military_number }}</td>
              <td>{{ $solider->phone_number }}</td>
              <td>{{ $solider->degree->name }}</td>
              <td>{{ $solider->address }}</td>
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
              <td class="d-flex justify-content-between ">
                @can('delete-solider')
                <a data-toggle="modal" data-target="#delete-solider{{$solider->id}}" class="envelope-table"> <i class="fas fa-trash text-danger"></i></a>
               @endcan
               @can('edit-solider')
                <a href="{{ route('admin.soliders.edit',$solider->id) }}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>
              @endcan
              </td>
          </tr>





          {{-- modal delete --}}
          <div class="modal fade" id="delete-solider{{$solider->id}}">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">حذف فرد</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>هل انت متاكد من عملية الحذف</p>
                  <form action="{{ route('admin.soliders.destroy',$solider->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default active" data-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-danger active">حذف </button>
                          </div>
                  </form>
                </div>

              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


            @endforeach


          </tbody>
      </table>

      {!! $soliders->links() !!}
  </div>
</div>
</div>
</div>


<div class="modal fade" id="create-solider">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">تسجيل فرد جديد</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="{{ route('admin.soliders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

          <div class="card-body">
            <div class="form-group">
              <label for="name">الاسم رباعى</label>
              <input type="text" name="full_name" value="{{ old('full_name')}}" class="form-control" id="name" >
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address">العنـــوان</label>
                  <input type="text" name="address"  value="{{ old('address')}}" class="form-control" id="address">
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label for="degree"> الدرجة</label>
                <select class="form-control select2" name="degree_id" id="degree">
                  <option value="" selected>اختر الدرجة</option>
                  @foreach($degrees as $degree)
                  <option value="{{ $degree->id }}"> {{ $degree->name }}</option>
                  @endforeach
                </select>
                </div>
              </div>
            </div>

            <div class="row justify-content-between">
              <div class="com-6">
                <div class="form-group">
                <label for="number">الرقم العسكرى</label>
                <input type="text" name="military_number" value="{{ old('military_number')}}" class="form-control" id="number">
              </div>
              </div>
              <div class="com-6">
                <div class="form-group">
                  <label for="phone">رقم التليفون </label>
                  <input type="text" name="phone_number" value="{{ old('phone_number')}}"  class="form-control" id="phone">
                </div>
              </div>
            </div>




                <div class="row justify-content-between">

                    <!-- /.form-group -->
                  </div>
                 <div class="col-12">
                  <div class="form-group">
                    <label for="exampleInputFile">إضافة صورة</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>

                </div>
                 </div>

              </div>
            </div>

          </div>
          <!-- /.card-body -->

          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default active" data-dismiss="modal">الغاء</button>
            <button type="submit" class="btn btn-primary active">حفظ </button>
          </div>
        </div>
        </form>
      </div>

    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



@endsection


@section('js')

    <script>
        function printTable() {
            // الحصول على الجدول
            var table = $('#example').DataTable();

            // استخراج البيانات من جميع الصفوف
            var tableData = '<table id="printableTable" class="table table-striped table-bordered table-responsive">';

            // إضافة رؤوس الأعمدة مع تجاهل عمود "الإجراءات"
            tableData += '<thead><tr>';
            $('#example thead th').each(function(index) {
                if ($(this).text().trim() !== 'اجراءات') {
                    tableData += '<th>' + $(this).html() + '</th>';
                }
            });
            tableData += '</tr></thead>';

            // إضافة البيانات من جميع الصفوف مع تجاهل عمود "الإجراءات"
            tableData += '<tbody>';
            table.rows().every(function() {
                var row = this.node();
                tableData += '<tr>';
                $(row).find('td').each(function(index) {
                    // تجاهل العمود الذي يحتوي على النص "اجراءات"
                    if ($(row).find('th').eq(index).text().trim() !== 'اجراءات') {
                        tableData += '<td>' + $(this).html() + '</td>';
                    }
                });
                tableData += '</tr>';
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
