@extends('layouts.master')

@section('title') فرع الشرطة العسكرية | حالات الجنود@endsection

@section('css')

<style>

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
            <p class="m-0 text-dark f-z-50">سجل حالات الفرد</p>
          </div><!-- /.col -->
          <div class="col-sm-12">
             <ol class="breadcrumb font-z-25">
              <li class="breadcrumb-item"><a href="#">لوحة التحكم  <a></li>
              <li class="breadcrumb-item active"> /   سجل حالات الفرد </li>
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


               <table id="example" class="table table-striped active table-bordered">
                   <thead class="table-dark">
                       <tr>
                           <th>#</th>
                           <th>الاســــم</th>
                           <th> معاد الذهاب</th>
                           <th>معاد العوده</th>
                           <th> حالة الجندي</th>
                           <th> الرتبة </th>
                           <th>ملاحظة</th>

                       </tr>
                   </thead>
                   <tbody>
                        @foreach($SoliderStatues as $SoliderStatus)






                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $SoliderStatus->solider?->full_name }}</td>
                            <td>{{ $SoliderStatus->go_date->format('d/m/Y') }}</td>
                            <td>{{ $SoliderStatus->return_date->format('d/m/Y') }}</td>
                            <td>{{ $SoliderStatus->status }}</td>
                            <td>{{ $SoliderStatus->solider->degree->name }}</td>

                            <td>{{ $SoliderStatus->note}}</td>

                        </tr>

                        @endforeach

                   </tbody>
               </table>
           </div>
       </div>
  </div>
</div>


@endsection


@section('js') @endsection
