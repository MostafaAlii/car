<div class="row">
    <!-- Left Sidebar start-->
    <div class="side-menu-fixed">
        <div class="scrollbar side-menu-bg">
            <ul class="nav navbar-nav side-menu" id="sidebarnav">
                <!-- menu item Dashboard-->
                <li>
                    <a href="{{ route('employee.dashboard') }}">Employee Dashboard</a>
                </li>
                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">Employee Managment</li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#employee_managment">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">Employee Managment</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="employee_managment" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('employeeCaptains.index')}}">Captain</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->
            </ul>
        </div>
    </div>

    <!-- Left Sidebar End-->
</div>