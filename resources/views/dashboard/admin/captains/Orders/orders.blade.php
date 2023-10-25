@extends('layouts.master')
@section('css')
    @section('title')
       Orders
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Orders</h4>
            </div>
            <div class="col-sm-6">
                <ol class="float-left pt-0 pr-0 breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Dasboard</a></li>
                    <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('layouts.common.partials.messages')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 col-lg-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <br><br>
                    <!--begin::Table-->
                    {!! $dataTable->table([
                    'class' => 'dataTable table table-row-dashed table-striped table-hover table-borderd table-row-gray-300
                    align-middle gs-0 table-row-bordered gy-5',
                    'style' => 'border-collapse: collapse; border-spacing: 0; width: 100%;'
                    ]) !!}
                    <!--end::Table-->
                </div>

            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! $dataTable->scripts() !!}
@endsection