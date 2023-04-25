<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    {{-- <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT"> --}}
    <title>Login | {{ getSettings('site_name') }} Admin</title>

    <link rel="apple-touch-icon" href="{{ asset('public_assets/admin') }}/images/ico/apple-icon-120.html">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public_assets/admin') }}/images/ico/favicon.ico">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/vendors/css/vendors.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/themes/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/themes/semi-dark-layout.min.css">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('public_assets/admin') }}/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/pages/authentication.css">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/css/style.css"> --}}

</head>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">

    @yield('content')

    <script src="{{ asset('public_assets/admin') }}/vendors/js/vendors.min.js"></script>
    <script src="{{ asset('public_assets/admin') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="{{ asset('public_assets/admin') }}/js/core/app-menu.min.js"></script>
    <script src="{{ asset('public_assets/admin') }}/js/core/app.min.js"></script>
    <script src="{{ asset('public_assets/admin') }}/js/scripts/pages/auth-login.js"></script>

</body>

</html>
