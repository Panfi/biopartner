<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{!! url('/dashboard') !!}">
            <img src="{!! asset('vendor/biopartnering/img/logo.png') !!}" alt="BioPartnering"/>
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active">
                    <a href="{!! url('/') !!}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li>
                    <a href="{!! url('user/meetings') !!}">
                        <i class="fas fa-user"></i>Manage Meetings
                    </a>
                </li>
                <li>
                    <a href="{!! url('user/calender') !!}">
                        <i class="fas fa-calendar-alt"></i>Calendar
                    </a>
                </li>
                <li>
                    <a href="{!! url('user/messages') !!}">
                        <i class="zmdi zmdi-email"></i>Messages
                    </a>
                </li>
                {{-- <li>
                    <a href="#">
                        <i class="fas fa-bars"></i>My Notes
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="#">
                        <i class="fas fa-user"></i>Groups
                    </a>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->