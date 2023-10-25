@extends('layouts.master')
@section('css')
    @section('title')
        {{$title}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{$title}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Dasboard</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
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
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a data-target="#create{{$title}}" data-toggle="modal"  data-effect="effect-scale" class="btn btn-success btn-sm" role="button">
                        <i class="fa fa-plus"></i>
                        Add New {{$title}}
                    </a>
                    <br><br>
                    <!--begin::Table-->
                    {!! $dataTable->table([
                        'class' => 'dataTable table table-row-dashed table-striped table-hover table-borderd table-row-gray-300 align-middle gs-0 table-row-bordered gy-5',
                        'style' => 'border-collapse: collapse; border-spacing: 0; width: 100%;'
                    ], true) !!}
                    <!--end::Table-->
                </div>
                @include('dashboard.general.discount.btn.modals.create')
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    {!! $dataTable->scripts() !!}
@endsection