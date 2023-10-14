<div class="row">
    <!-- Left Sidebar start-->
    <div class="side-menu-fixed">
        <div class="scrollbar side-menu-bg">
            <ul class="nav navbar-nav side-menu" id="sidebarnav">
                <!-- Start Dashboard-->

                <li><a href="{{ route('admin.dashboard') }}">{{ trans('dashboard.dashboard') }}</a></li>
                <!-- End Dashboard-->

                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">Settings Management</li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#setting_managment">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">Settings Management</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="setting_managment" class="collapse" data-parent="#sidebarnav">
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#car_managment">
                            <div class="pull-left">
                                <i class="ti-car"></i>
                                <span class="right-nav-text">Car Management</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="car_managment" class="collapse" data-parent="#sidebarnavcar">
                            <li><a href="{{route('carMake.index')}}">Car-Make</a></li>
                            <li><a href="{{ route('carModel.index') }}">Car-Model</a></li>
                            <li><a href="{{route('carType.index')}}">Car-Type</a></li>
                            <li><a href="{{route('tripType.index')}}">Trip-Type</a></li>
                            <li><a href="{{route('carCategories.index')}}">Car-Categories</a></li>
                        </ul>
                        <li><a href="{{route('mainSettings.index')}}">Main Settings</a></li>
                        <li><a href="{{route('sos.index')}}">Sos</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->



                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">{{ trans('admins.admin_managment') }}</li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#admins_managment">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">{{ trans('admins.admin_managment') }}</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="admins_managment" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('admins.index')}}">{{ trans('admins.admins') }}</a></li>

                        <li><a href="{{route('agents.index')}}">{{ trans('agents.agents') }}</a></li>
                        <li><a href="{{route('companies.index')}}">Company</a></li>
                        <li><a href="{{route('employees.index')}}">Employee</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->

                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">Captains</li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#caption">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">Captains</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="caption" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('captains.index')}}">Captain</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->

                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">users</li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#users">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">users</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="users" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('users.index')}}">{{ trans('users') }}</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->


                <!-- End Admin Managment Menu-->

                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">Reposts</li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Reposts">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">Reposts</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Reposts" class="collapse" data-parent="#sidebarnav">
                        <li><a href="">Reposts orders</a></li>
                        <li><a href="">Reposts users</a></li>
                        <li><a href="">Reposts Caption</a></li>
                        <li><a href="">Reposts agents</a></li>
                        <li><a href="">Reposts companies</a></li>
                        <li><a href="">Reposts employees</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->


                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">orders</li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#orders">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">orders</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="orders" class="collapse" data-parent="#sidebarnav">
                        <li><a href="">All orders</a></li>
                        <li><a href="">list orders</a></li>
                        <li><a href="">orders waiting</a></li>
                        <li><a href="">orders pending</a></li>
                        <li><a href="">orders cancel</a></li>
                        <li><a href="">orders accepted</a></li>
                        <li><a href="">orders done</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->

                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">Accounts</li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#accounts">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">Accounts</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="accounts" class="collapse" data-parent="#sidebarnav">
                        <li><a href="">accounts</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->

                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">integrations</li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#integrations">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">Integrations</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="integrations" class="collapse" data-parent="#sidebarnav">
                        <li><a href="">my fatoorah</a></li>
                        <li><a href="">paypal</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->

            </ul>
        </div>
    </div>

    <!-- Left Sidebar End-->
</div>
