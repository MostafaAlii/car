@extends('layouts.master')
@section('css')
@section('title')
{{$data['captain']->name . ' ' .$data['title']}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{$data['captain']->name . ' ' .$data['title']}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="float-left pt-0 pr-0 breadcrumb float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">Dasboard</a></li>
                <li class="breadcrumb-item active">{{$data['captain']->name . ' ' .$data['title']}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('layouts.common.partials.messages')
<!-- row -->
{{--<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            {{--<div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{ $data['captain']->name }} Information</h2>
                        <p>Name: {{ $data['captain']->name }}</p>
                        <p>Email: {{ $data['captain']->email }}</p>
                        <p>Phone: {{ $data['captain']->phone }}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <h2>Profile Information</h2>
                        <p>Address: {{ $data['captain']->profile->address }}</p>
                        <p>Bio: {{ $data['captain']->profile->bio }}</p>
                        <p>Rate: {{ $data['captain']->profile->rate }}</p>
                        <p>Number of Trips: {{ $data['captain']->profile->number_trips }}</p>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>
</div>--}}
<!-- row closed -->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection