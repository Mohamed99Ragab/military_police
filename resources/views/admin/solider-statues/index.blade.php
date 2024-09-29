@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | حالات الجنود@endsection

@section('css')

<style>
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
            <p class="m-0 text-dark f-z-50">حالات الجنود</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /  حالات الجنود</li>
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

          @can('create-vacation')
              <div class="btn-btn-add">
                  <a  data-toggle="modal" data-target="#create-vacation"   class="btn btn-info btn-add active"> إضافة حالة جديدة</a>
              </div>
          @endcan
               <table id="example" class="table table-striped active table-bordered ">
                   <thead class="table-dark">
                       <tr>
                           <th>#</th>
                           <th>الاســــم</th>
                           <th> معاد الذهاب</th>
                           <th>معاد العوده</th>
                           <th> حالة الجندي</th>
                           <th> الرتبة </th>
                           <th>حالة التواجد</th>
                           <th>ملاحظة</th>
                           <th> الاضافة بواسطة</th>
                           <th> التعديل بواسطة</th>
                           <th>سجل الحالات</th>
                           <th class="d-print-none">اجراءات</th>
                       </tr>
                   </thead>
                   <tbody>
                        @foreach($SoliderStatues as $SoliderStatus)




                        @php
                            $today = Carbon::today();
                            $drop_date = Carbon::parse($SoliderStatus->go_date);
                            $return_date = Carbon::parse($SoliderStatus?->return_date);

                        @endphp

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $SoliderStatus->solider?->full_name }}</td>
                            <td>{{ $SoliderStatus->go_date->format('d/m/Y') }}</td>
                            <td>{{ $SoliderStatus->return_date?->format('d/m/Y') }}</td>
                            <td>{{ $SoliderStatus->status }}</td>
                            <td>{{ $SoliderStatus->solider?->degree?->name }}</td>
                            <td>
                              @if($today->eq($return_date))
                              موجود
                                <span class="typle-active"></span>
                              @elseif($today->between($drop_date,$return_date))
                              غير موجود
                              <span class="typle-active-no"></span>
                                @else
                                 موجود
                                <span class="typle-active"></span>

                              @endif

                            </td>

                            <td>{{ $SoliderStatus->note}}</td>

                            <td>{{ $SoliderStatus->createdBy?->full_name }} : <span class="text-success text-bold">{{ $SoliderStatus->createdBy?->role }}</span></td>
                            <td>{{ $SoliderStatus->updatedBy?->full_name }} : <span class="text-info text-bold">{{ $SoliderStatus->updatedBy?->role }}</span></td>
                            <td>
                               <a href="{{ route('admin.soliderStatues.history',$SoliderStatus->solider->id) }}" class="btn btn-secondary"> عرض</a>
                            </td>
                            <td class="d-flex justify-content-center ">

                                <a data-toggle="modal" data-target="#delete-status{{$SoliderStatus->id}}" class="envelope-table ml-2"> <i class="fas fa-trash text-danger"></i></a>

                              <a data-toggle="modal" data-target="#edit-status{{$SoliderStatus->id}}" class="envelope-table"> <i class="far fa-edit text-primary"></i></a>

                            </td>


                        </tr>
                        @include('admin.solider-statues.edit',['SoliderStatus'=>$SoliderStatus])

                        @include('admin.solider-statues.delete',['SoliderStatus'=>$SoliderStatus])
                        @endforeach

                   </tbody>
               </table>

               {!! $SoliderStatues->links() !!}
           </div>
       </div>
  </div>
</div>


  @include('admin.solider-statues.create')
@endsection


@section('js')





@endsection
