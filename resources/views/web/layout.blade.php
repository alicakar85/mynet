<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Kullanıcı Paneli - @yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/web/images/favicon.png') }}">

    <link href="{{ asset('assets/web/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="{{ asset('assets/web/css/style.css') }}" rel="stylesheet">

    <!-- Date picker plugins css -->
    <link href="{{ asset('assets/web/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('head')
</head>

<body data-theme-version="dark">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">
        <div class="nav-header">
            <div class="brand-logo pt-3">
                <a href="{{ route('home.home.index') }}">
                   <span class="brand-title">
                       MYNET PROJECT
                    </span>
                </a>
            </div>
        </div>

        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{ asset('assets/web/images/user/form-user.jpg') }}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="{{ route('web.member.logout') }}"><i class="icon-key"></i> <span>Çıkış</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label color-white"><span class="color-white">Menü</span></li>

                    <li>
                        <a href="{{ route('web.member.index') }}" aria-expanded="false">
                            <i class="icon-home menu-icon"></i> <span class="nav-text">Anasayfa</span>
                        </a>
                    </li>

                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-user menu-icon"></i> <span class="nav-text">Kullanıcı İşlemleri</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('web.person.create') }}">Yeni Üye Ekle</a></li>
                            <li><a href="{{ route('web.person.index') }}">Listele</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        @yield('content')


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('assets/web/plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('assets/web/plugins/sweetalert/js/sweetalert.min.js') }}"></script>

    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('assets/web/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('assets/web/js/custom.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
