@extends('layouts.master')
@section('css')
<link href="{{ URL::asset('assets/css/plugins/toastr.css') }}" rel="stylesheet">
@section('title')
{{get_user_data()->name . ' ' . $title }}    
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
          <h4 class="mb-0">
              {{ get_user_data()->name . ' ' . $title }}
          </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                @section('breadcrumb')
                @show
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
                <!-- Start First Row -->
                <div class="row">
                    <!-- Start Admins Row -->
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                      <div class="card card-statistics h-100">
                        <div class="card-body">
                          <div class="clearfix">
                            <div class="float-left">
                              <span class="text-danger">
                                <i class="fa fa-user-circle highlight-icon" aria-hidden="true"></i>
                              </span>
                            </div>
                            <div class="float-right text-right">
                              <p class="card-text text-dark">Admins</p>
                              <h4>
                                {{--@if(get_user_data()->type == 'general')
                                    {{Admin::count()}}
                                @else
                                    {{Admin::whereCountryId(get_user_data()->country_id)->count()}}
                                @endif--}}
                              </h4>
                            </div>
                          </div>
                          <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            {{--  @if(get_user_data()->type == 'general')
                                {{Admin::whereStatus('active')->count()}} Active
                                <p>
                                    @if(Admin::whereType('supervisor')->count() > 0)
                                        {{Admin::whereType('supervisor')->count()}} Supervisor
                                    @else
                                        <span class="text-danger">
                                            No Supervisor Found
                                        </span>
                                    @endif
                                </p>
                            @else
                                {{Admin::whereCountryId(get_user_data()->country_id)->whereStatus('active')->count()}} Active
                                <p>
                                    @if(Admin::whereCountryId(get_user_data()->country_id)->whereType('supervisor')->count() > 0)
                                        {{Admin::whereCountryId(get_user_data()->country_id)->whereType('supervisor')->count()}} Supervisor
                                    @else
                                        <span class="text-danger">
                                            No Supervisor in {{ get_user_data()->country->name }}
                                        </span>
                                    @endif
                                </p>
                            @endif--}}
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- End Admins Row -->
                    <!-- Start Drivers Row -->
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                      <div class="card card-statistics h-100">
                        <div class="card-body">
                          <div class="clearfix">
                            <div class="float-left">
                              <span class="text-warning">
                                <i class="fa fa-user-circle highlight-icon" aria-hidden="true"></i>
                              </span>
                            </div>
                            <div class="float-right text-right">
                              <p class="card-text text-dark">Captain</p>
                              <h4>
                                {{--@if(get_user_data()->type == 'general')
                                    {{Driver::count()}}
                                @else
                                    {{Driver::whereCountryId(get_user_data()->country_id)->count()}}
                                @endif--}}
                              </h4>
                            </div>
                          </div>
                          <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            {{--@if(get_user_data()->type == 'general')
                                <span class="badge badge-success">{{Driver::whereStatus('active')->count()}}</span> Active
                                <p>
                                    @if(Driver::whereGender('male')->count() > 0)
                                        <span class="badge badge-success">{{Driver::whereGender('male')->count()}}</span> Male Captain -
                                        <span class="badge badge-primary">{{Driver::whereGender('female')->count()}}</span> Female Captain
                                    @else
                                        No Captain Found
                                    @endif
                                </p>
                            @else
                                <p>
                                    @if(Driver::whereCountryId(get_user_data()->country_id)->whereGender('male')->count() > 0)
                                        <span class="badge badge-success">{{Driver::whereCountryId(get_user_data()->country_id)->whereGender('male')->count()}}</span> Male Captain -
                                        <span class="badge badge-primary">{{Driver::whereCountryId(get_user_data()->country_id)->whereGender('female')->count()}}</span> Female Captain
                                    @else
                                        <span class="text-danger">
                                            No Captain  in {{ get_user_data()->country->name }}
                                        </span>
                                    @endif
                                </p>
                            @endif--}}
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- End Drivers Row -->
                    <!-- Start Clients Row -->
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                      <div class="card card-statistics h-100">
                        <div class="card-body">
                          <div class="clearfix">
                            <div class="float-left">
                              <span class="text-success">
                                <i class="fa fa-user-circle highlight-icon" aria-hidden="true"></i>
                              </span>
                            </div>
                            <div class="float-right text-right">
                              <p class="card-text text-dark">Clients</p>
                              <h4>
                                {{--@if(get_user_data()->type == 'general')
                                    {{User::count()}}
                                @else
                                    {{User::whereCountryId(get_user_data()->country_id)->count()}}
                                @endif--}}
                              </h4>
                            </div>
                          </div>
                          <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            {{--@if(get_user_data()->type == 'general')
                                <span class="badge badge-success">{{User::whereStatus('active')->count()}}</span> Active
                            @else
                                @if(User::whereCountryId(get_user_data()->country_id)->count() > 0 )
                                    <span class="badge badge-success">{{User::whereCountryId(get_user_data()->country_id)->whereStatus('active')->count()}}</span> Active
                                @else
                                    <span class="text-danger">
                                        No Client  in {{ get_user_data()->country->name }}
                                    </span>
                                @endif
                            @endif--}}
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- End Clients Row -->
                    <!-- Start Companies Row -->
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                      <div class="card card-statistics h-100">
                        <div class="card-body">
                          <div class="clearfix">
                            <div class="float-left">
                              <span class="text-primary">
                                <i class="fa fa-th-list highlight-icon" aria-hidden="true"></i>
                              </span>
                            </div>
                            <div class="float-right text-right">
                              <p class="card-text text-dark">Agents</p>
                              <h4>
                                {{--@if(get_user_data()->type == 'general')
                                    {{Company::count()}}
                                @else
                                    {{Company::whereCountryId(get_user_data()->country_id)->count()}}
                                @endif--}}
                              </h4>
                            </div>
                          </div>
                          <p class="text-muted pt-3 mb-0 mt-2 border-top">
                            {{--@if(get_user_data()->type == 'general')
                                <span class="badge badge-success">{{Company::whereStatus(true)->count()}}</span> Active
                            @else
                                @if(Company::whereCountryId(get_user_data()->country_id)->count() > 0 )
                                    <span class="badge badge-success">{{Company::whereCountryId(get_user_data()->country_id)->whereStatus(true)->count()}}</span> Active
                                @else
                                    <span class="text-danger">
                                        No Agent  in {{ get_user_data()->country->name }}
                                    </span>
                                @endif
                            @endif--}}
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- End Companies Row -->
                </div>
                <!-- End First Row -->
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
@endsection