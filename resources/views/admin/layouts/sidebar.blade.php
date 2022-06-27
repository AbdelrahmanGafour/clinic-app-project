<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="{{ url('/dashboard') }}">
                <div class="logo-img">

                </div>
                <span class="text">Clinic</span>
            </a>

        </div>

        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">

                    <div class="nav-item active">
                        <a href="{{route('home')}}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>


                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-heart"></i><span>Reports</span> <span
                                class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            @if(Auth::user()->role->role_name == 'admin')
                            <a href="{{route('admin.patients.report')}}" class="menu-item">Patients Reports</a>
                            @endif
                        </div>
                    </div>

                    @if(Auth::user()->role->role_name == 'admin')
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-heart"></i><span>Doctor</span> <span
                                class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{route('admin.add.doctor')}}" class="menu-item">Add New Doctor</a>
                            <a href="{{--route('appointment.index')--}}" class="menu-item">View Doctors List</a>

                        </div>
                    </div>
                    @endif

                    @if(Auth::user()->role->role_name == 'doctor')
                    <div class="nav-item active">
                        <a href="{{route('appointment.add')}}"><i class="ik ik-bar-chart-2"></i><span>Add Visits Time</span></a>
                    </div>

                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-heart"></i><span>My Upcoming Visits</span> <span
                                class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{route('doctor.view.myUpcomingReservedVisits')}}" class="menu-item">My Upcoming Reserved Visits</a>
                            <a href="{{route('doctor.view.myUpcomingVisits')}}" class="menu-item">All My Upcoming Visits</a>

                        </div>
                    </div>

                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-heart"></i><span>My Previous Visits</span> <span
                                class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{route('doctor.view.myPreviousReservedVisits')}}" class="menu-item">My Previous Reserved Visits</a>
                            <a href="{{route('doctor.view.myPreviousVisits')}}" class="menu-item">All My Previous Visits</a>

                        </div>
                    </div>

                    @endif

                    <div class="nav-item active">
                        <a onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"
                            href="{{ route('logout') }}"><i
                                class="ik ik-power dropdown-icon"></i><span>Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>

