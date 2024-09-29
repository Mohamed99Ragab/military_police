@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | الافراد @endsection

@section('css')
    <style>
        th {
            white-space: nowrap;
        }

        .buttons-print {
            display: none;
        }

        .dataTables_paginate .pagination{
            display:none;
        }
    </style>
@endsection

@section('content')

    @php
        use Carbon\Carbon;



        $counter = ($soliders->currentPage() - 1) * $soliders->perPage();

    @endphp

    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <p class="m-0 text-dark f-z-50">الافراد</p>
                    </div><!-- /.col -->
                    <div class="col-sm-12">
                        <ol class="breadcrumb font-z-25">
                            <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
                            <li class="breadcrumb-item active"> /  الافراد</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

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

                            <div class="row justify-content-end">
                                <div class="col-md-2">
                                    @can('create-solider')
                                        <div class="btn-btn-add">
                                            <a href="{{ route('admin.soliders.create') }}" class="btn btn-outline-primary">
                                                إضافة فرد جديد <i class="fas fa-user-plus mr-2"></i>
                                            </a>
                                        </div>
                                    @endcan
                                </div>

                                <div class="col-md-2">
                                    <div>
                                        <a data-toggle="modal" data-target="#import-soliders" class="btn btn-outline-success">
                                            استيراد الجنود <i class="fas fa-file-import mr-2"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div>
                                        <a href="{{ route('admin.soliders.export') }}" class="btn btn-outline-warning">
                                            تصدير الجنود <i class="fas fa-file-export mr-2"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        <form id="delete-form" method="POST" action="{{ route('admin.soliders.bulk-delete') }}">
                            @csrf
                            @method('DELETE')
                            <div class="mb-3">
                                <button type="button" onclick="printTable()" class="btn btn-success active">
                                    <i class="fas fa-print"></i> طباعة
                                </button>

                                <button type="submit" class="btn btn-danger active">
                                    <i class="fas fa-trash-alt"></i> حذف المحدد
                                </button>


                            </div>

                            <table id="example" class="table table-striped table-bordered table-responsive">
                                <thead class="table-dark">
                                <tr>
                                    <th class="no-print"><input type="checkbox" id="select-all"></th>
                                    <th>#</th>
                                    <th>الاســــم</th>
                                    <th>الرقم العسكرى</th>
                                    <th>رقم التليفون</th>
                                    <th>الدرجـــة</th>
                                    <th>العنـــوان</th>
                                    <th>الحالة</th>
                                    <th class="no-print">الاضافة بواسطة</th>
                                    <th class="no-print">التعديل بواسطة</th>
                                    <th class="no-print">اجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($soliders as $solider)
                                    @php
                                        $today = Carbon::today();
                                        $drop_date = Carbon::parse($solider->soliderStatus?->go_date);
                                        $return_date = Carbon::parse($solider->soliderStatus?->return_date);
                                    $counter++
                                    @endphp
                                    <tr>
                                        <td class="no-print"><input class="form-check" type="checkbox" name="soliders[]" value="{{ $solider->id }}"></td>
                                        <td> {{ $counter }}</td>
                                        <td> {{ $solider->full_name }}</td>
                                        <td>{{ $solider->military_number }}</td>
                                        <td>{{ $solider->phone_number }}</td>
                                        <td>{{ $solider->degree?->name }}</td>
                                        <td>{{ $solider->address }}</td>
                                        <td>
                                            @if($today->eq($return_date))
                                                موجود <span class="typle-active"></span>
                                            @elseif($today->between($drop_date, $return_date) || $today->eq($drop_date))
                                                غير موجود <span class="typle-active-no"></span>
                                            @else
                                                موجود <span class="typle-active"></span>
                                            @endif
                                        </td>
                                        <td class="no-print">{{ $solider->createdBy?->full_name }} : <span class="text-success text-bold">{{ $solider->createdBy?->role }}</span></td>
                                        <td class="no-print">{{ $solider->updatedBy?->full_name }} : <span class="text-info text-bold">{{ $solider->updatedBy?->role }}</span></td>
                                        <td class="d-flex justify-content-between no-print">
                                            @can('delete-solider')
                                                <a data-toggle="modal" data-target="#delete-solider{{$solider->id}}" class="envelope-table"> <i class="fas fa-trash text-danger"></i></a>
                                            @endcan

                                            @can('edit-solider')
                                                <a href="{{ route('admin.soliders.edit', $solider->id) }}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>
                                            @endCan
                                        </td>
                                    </tr>

                                    @include('admin.soliders.delete-solider', ['solider' => $solider])

                                @endforeach
                                </tbody>
                            </table>
                            {!! $soliders->links() !!}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.soliders.import-soliders')



        @endsection

@section('js')
            <script>
                document.getElementById('select-all').addEventListener('click', function() {
                    const checkboxes = document.querySelectorAll('input[name="soliders[]"]');
                    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                });
            </script>


            <script>
                function printTable() {
                    // الحصول على الجدول
                    var table = $('#example').DataTable();

                    // استخراج البيانات من جميع الصفوف
                    var tableData = '<table id="printableTable" class="table table-striped table-bordered table-responsive">';

                    // إضافة رؤوس الأعمدة مع تجاهل الأعمدة "Checkbox" و"الاجراءات" و"الاضافة بواسطة" و"التعديل بواسطة"
                    tableData += '<thead><tr>';
                    $('#example thead th').each(function(index) {
                        // تجاهل الأعمدة بناءً على الفهرس
                        if (index !== 0 && index !== 10 && index !== 8 && index !== 9) {
                            tableData += '<th>' + $(this).html() + '</th>';
                        }
                    });
                    tableData += '</tr></thead>';

                    // إضافة البيانات من جميع الصفوف مع تجاهل الأعمدة "Checkbox" و"الاجراءات" و"الاضافة بواسطة" و"التعديل بواسطة"
                    tableData += '<tbody>';
                    table.rows().every(function() {
                        var row = this.node();
                        tableData += '<tr>';
                        $(row).find('td').each(function(index) {
                            // تجاهل الأعمدة بناءً على الفهرس
                            if (index !== 0 && index !== 10 && index !== 8 && index !== 9) {
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
