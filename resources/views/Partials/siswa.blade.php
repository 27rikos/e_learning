<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords"
        content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
    {{-- data table CDN --}}
    <script src="https://kit.fontawesome.com/fb034efa9e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.0/js/responsive.bootstrap4.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.bootstrap4.css">
</head>

<body>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="index.html">
                            <img class="img-fluid" src="{{ asset('assets/images/logo.png') }}" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <a href="#!">
                                    <img src="{{ asset('assets/images/avatar-4.jpg') }}" class="img-radius"
                                        alt="User-Profile-Image">
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li>
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                        <form hidden id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-40 img-radius" src="{{ asset('assets/images/avatar-4.jpg') }}"
                                        alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span>{{ Auth::user()->name }}</span>
                                        <span id="more-details">{{ Auth::user()->role }}<i
                                                class="ti-angle-down"></i></span>
                                    </div>
                                </div>

                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                                    class="ti-layout-sidebar-left"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                                <form hidden id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation">Main</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="{{ route('home') }}">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigatio-lavel" data-i18n="nav.category.forms">Menu
                            </div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li>
                                    <a href="form-elements-component.html">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Diskusi</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="bs-basic-table.html">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Materi</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="bs-basic-table.html">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Tugas</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="bs-basic-table.html">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Quiz</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="bs-basic-table.html">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                        <span class="pcoded-mtext"
                                            data-i18n="nav.form-components.main">Pengembang</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="bs-basic-table.html">
                                        <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.form-components.main">Bantuan</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{ asset('assets/js/modernizr/modernizr.js') }}"></script>
    <!-- am chart -->
    <script src="{{ asset('assets/pages/widget/amchart/amcharts.min.js') }}"></script>
    <script src="{{ asset('assets/pages/widget/amchart/serial.min.js') }}"></script>
    <!-- Todo js -->
    <script type="text/javascript " src="{{ asset('assets/pages/todo/todo.js') }} "></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('assets/pages/dashboard/custom-dashboard.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
    <script type="text/javascript " src="{{ asset('assets/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo-12.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script>
        var $window = $(window);
        var nav = $('.fixed-button');
        $window.scroll(function() {
            if ($window.scrollTop() >= 200) {
                nav.addClass('active');
            } else {
                nav.removeClass('active');
            }
        });
    </script>
</body>

</html>
