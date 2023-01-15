<!DOCTYPE html>

<html class="loading" lang="en">

<head>

    {{ view('layout.head-ltr') }}
    <style>
        .table-hover tbody tr {
            cursor: default !important;
        }

        /*
        .vertical-layout.vertical-menu-modern.menu-expanded .main-menu,
        .vertical-layout.vertical-menu-modern.menu-collapsed .main-menu.expanded,
        .vertical-overlay-menu .main-menu,
        .vertical-overlay-menu.menu-hide .main-menu,
        .main-menu .navbar-header {
            width: 360px;
        }

        @media (min-width:1198px) {

            .header-navbar.fixed-top,
            .header-navbar.floating-nav {
                left: 360px;
            }

            .header-navbar.floating-nav {
                width: calc(100vw - (100vw - 100%) - calc(2rem * 2) - 360px);
            }

        }

        html .content {
            margin-left: 360px;
        }

        .main-menu.menu-native-scroll .main-menu-content {
            overflow-y: auto !important;
        } */

        .modal .modal-header .btn-close:hover,
        .modal .modal-header .btn-close:focus,
        .modal .modal-header .btn-close:active {
            transform: translate(8px, -5px);
        }

    </style>
    @yield('PageCSS')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    {{ view('layout.header') }}

    {{ view('layout.leftsidebar') }}

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">


            @yield('content-header')

            {{ view('layout.alerts') }}
            {{-- <p>{{ LaravelLocalization::getCurrentLocaleDirection()  }}</p> --}}

            @yield('content')
        </div>
    </div>
    <!-- END: Content-->

    {{-- {{ view('layout.customizer') }} --}}

    {{ view('layout.footer') }}

    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

    {{ view('layout.scripts') }}

    @yield('PageJS')
</body>

</html>
