@extends('layouts.master')
@section('css')
@section('title')
{{$data['user']->name . ' ' .$data['title']}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{$data['user']->name . ' ' .$data['title']}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="float-left pt-0 pr-0 breadcrumb float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Dasboard</a></li>
                <li class="breadcrumb-item active">{{$data['user']->name . ' ' .$data['title']}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('layouts.common.partials.messages')
<!-- start profile content -->
<div class="profile-page">
    <!-- start profile-page-container -->
    <!-- Start User Info -->
    <div class="row">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="user-bg" style="background: url({{asset('assets/images/user-bg.jpg') }});">
                        <div class="user-info">
                            <div class="row">
                                {{$data['user']->name . ' ' .$data['title']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End User Info -->

    <!-- Start Content and Tabs -->
    <div class="row">
        <!-- Start Tabs -->
        <div class="col-xl-12 col-lg-12 mb-30">
            <div class="card mb-30">
                <div class="card-body">
                    {{$data['user']->name . ' ' .$data['title']}}
                </div>
            </div>
        </div>
        <!-- End Tabs -->
    </div>
    <!-- End Content and Tabs -->
    <!-- End profile-page-container -->
</div>
<!-- end profile content -->
@endsection
@section('js')

@endsection