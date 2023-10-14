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
                                <div class="col-lg-4 align-self-center">
                                    <div class="user-dp"><img
                                            src="{{ $data['captain']->profile?->avatar ? asset('dashboard/images/driver_document/' . $data['captain']->email . $data['captain']->phone . '_' . $data['captain']->profile->uuid  . '/' . $data['captain']->profile->avatar) : asset('dashboard/default/default_admin.jpg') }}"
                                            alt="{{$data['captain']?->name}}"></div>
                                    <div class="user-detail">
                                        <h4 class="nametext-light">
                                            <p class="mb-0">
                                                <span style="font-size: 12px;" class="fa fa-circle text-{{ $data['captain']?->status == 'active' ? 'success' : 'danger' }}"></span>
                                                <i class="fa {{ $data['captain']?->gender == 'male' ? 'fa-male text-primary' : 'fa-female text-purple' }}"></i>
                                                {{$data['captain']?->name}}
                                            </p> 
                                            <p class="mb-0">{{$data['captain']?->email}}</p>
                                            <p class="mb-0">{{'Phone' . $data['captain']?->phone}}</p>                                           
                                        </h4>
                                    </div>
                                </div>

                                <div class="col-lg-4 text-left align-self-center">
                                    <form id="toggleForm{{ $data['captain']->id }}" method="POST" action="{{ route('captain.updateActivityStatus',$data['captain']?->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <label>Captain Work Status</label>
                                        <select class="form-control p-2" name="status_captain_work" style="outline-style:none;" onchange="this.form.submit();">
                                            <option selected>Choose Captain Work Status</option>
                                            <option value="active" {{$data['captain']?->captainActivity?->status_captain_work == 'active' ? 'selected' : ''}}>Active</option>
                                            <option value="block" {{$data['captain']?->captainActivity?->status_captain_work == 'block' ? 'selected' : ''}}>Block</option>
                                            <option value="waiting" {{$data['captain']?->captainActivity?->status_captain_work == 'waiting' ? 'selected' : ''}}>Waiting</option>
                                        </select>
                                    </form>
                                </div>
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
                    <div class="comment-block">
                        <div class="mb-0 form-group">
                            <div class="tab nav-bt">
                                <!-- Start Nav Tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="profile-03-tab" data-toggle="tab" href="#profile-03" role="tab" aria-controls="profile-03" aria-selected="true">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="cars-04-tab" data-toggle="tab" href="#cars-04" role="tab" aria-controls="cars-04" aria-selected="false">My Cars</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="trips-03-tab" data-toggle="tab" href="#trips-03" role="tab" aria-controls="trips-03" aria-selected="false">My Trip</a>
                                    </li>
                                </ul>
                                <!-- End Nav Tabs -->

                                <!-- Start Tab Content -->
                                <div class="tab-content">
                                    @include('dashboard.admin.captains.tabs.profile.profile_content_tab')
                                    @include('dashboard.admin.captains.tabs.myTrip_content_tab')
                                    @include('dashboard.admin.captains.tabs.cars.myCar_content_tab')
                                </div>
                                <!-- End Tab Content -->
                            </div>
                        </div>
                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    /*$(document).ready(function() {
        $('.table').on('change', '#statusSelect', function() {
            const selectedValue = $(this).val();
            const statusId = $(this).data('status-id');
            const form = $('#updateStatusForm[data-id="' + statusId + '"]');
            if (selectedValue === 'reject') {
                $('#rejectModal').modal('show');
                $('#submitRejectReason').data('form-id', form.attr('id'));
            } else if (selectedValue === 'accept' || selectedValue === 'not_active') {
                form.submit();
            }
        });
        $('#submitRejectReason').click(function() {
            const rejectReason = $('#rejectReason').val();
            const formId = $(this).data('form-id');
            const form = $('#' + formId);

            if (rejectReason.trim() === '') {
                alert('Please enter a reason for rejection.');
            } else {
                form.find('#statusSelect').val('reject');
                form.find('input[name="reject_message"]').remove();
                form.append('<input type="hidden" name="reject_message" value="' + rejectReason + '">');
                form.submit();
                $('#rejectModal').modal('hide');
            }
        });
    });*/

    /*$(document).ready(function() {
        $('.table').on('change', '#statusSelect', function() {
            const selectedValue = $(this).val();
            const statusId = $(this).data('status-id');
            const form = $('#updateStatusForm[data-id="' + statusId + '"]');
            
            // قم بتخزين الـ statusId في زر "Submit" بالـ modal
            $('#submitRejectReason').data('status-id', statusId);

            if (selectedValue === 'reject') {
                $('#rejectModal').modal('show');
                $('#submitRejectReason').data('form-id', form.attr('id'));
            } else if (selectedValue === 'accept' || selectedValue === 'not_active') {
                form.submit();
            }
        });

        $('#submitRejectReason').click(function() {
            const rejectReason = $('#rejectReason').val();
            const formId = $(this).data('form-id');
            const form = $('#' + formId);
            const statusId = $(this).data('status-id');

            if (rejectReason.trim() === '') {
                alert('Please enter a reason for rejection.');
            } else {
                form.find('select.statusSelect').val('reject');
                form.find('input[name="reject_message"]').remove();
                form.append('<input type="hidden" name="reject_message" value="' + rejectReason + '">');
                form.submit();
                $('#rejectModal').modal('hide');
            }
        });
    });*/

    $(document).ready(function() {
        $('.table').on('change', '#statusSelect', function() {
            const selectedValue = $(this).val();
            const statusId = $(this).data('status-id');
            const form = $('#updateStatusForm[data-id="' + statusId + '"]');
            form.submit();
        });
    });



</script>
@endsection