<div class="row">
    <!-- Left Sidebar start-->
    <div class="side-menu-fixed">
        <div class="scrollbar side-menu-bg">
            <ul class="nav navbar-nav side-menu" id="sidebarnav">
                <!-- menu item Dashboard-->
                <li>
                    <a href="{{ route('agent.dashboard') }}">Agent Managment</a>
                </li>
                <!-- Start Admin Managment Menu-->
                <li class="pl-4 mt-10 mb-10 font-medium text-muted menu-title">Agent Managment</li>
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#agents_managment">
                        <div class="pull-left">
                            <i class="ti-palette"></i>
                            <span class="right-nav-text">Agent</span></div>
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="agents_managment" class="collapse" data-parent="#sidebarnav">
                        <li><a href="{{route('agentCompanies.index')}}">Company</a></li>
                        <li><a href="{{route('agentEmployees.index')}}">Employee</a></li>
                        <li><a href="{{route('agentCaptains.index')}}">Captain</a></li>
                    </ul>
                </li>
                <!-- End Admin Managment Menu-->
            </ul>
        </div>
    </div>

    <!-- Left Sidebar End-->
</div>