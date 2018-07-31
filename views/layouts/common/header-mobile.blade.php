<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="{!! url('/dashboard') !!}">
                    <img src="{!! asset('vendor/biopartnering/img/logo.png') !!}" alt="BioPartnering"/>
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
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
                    <a href="#">
                        <i class="zmdi zmdi-email"></i>Messages
                    </a>
                </li>
                <!--<li>
                    <a href="#">
                        <i class="fas fa-bars"></i>My Notes
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-user"></i>Groups
                    </a>
                </li>-->
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->