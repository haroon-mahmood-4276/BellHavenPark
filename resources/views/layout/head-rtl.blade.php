<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">

{{-- <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app"> --}}

<meta name="author" content="{{ getSettings('site_name') }}">

<title>@yield('title') | {{ getSettings('site_name') }}</title>

<link rel="shortcut icon" type="image/x-icon"
    href="{{ asset('public_assets/public_assets/admin') }}/images/ico/favicon.ico">

{{-- Google Font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin/rtl') }}/vendors/css/vendors-rtl.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/vendors/css/charts/apexcharts.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/vendors/css/extensions/toastr.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/vendors/css/pickers/flatpickr/flatpickr.min.css">
<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin/rtl') }}/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin/rtl') }}/css/bootstrap-extended.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin/rtl') }}/css/colors.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin/rtl') }}/css/components.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin/rtl') }}/css/themes/dark-layout.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/css/themes/bordered-layout.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/css/themes/semi-dark-layout.min.css">
<!-- END: Theme CSS-->

<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/css/core/menu/menu-types/vertical-menu.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/css/pages/dashboard-ecommerce.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/css/plugins/charts/chart-apex.min.css">
<link rel="stylesheet" type="text/css"
    href="{{ asset('public_assets/admin/rtl') }}/css/plugins/extensions/ext-component-toastr.min.css">
<!-- END: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/vendors/css/forms/select/select2.min.css">
<script src="{{ asset('public_assets/admin') }}/vendors/js/vendors.js"></script>
<!-- BEGIN: Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin/rtl') }}/css/app.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin/rtl') }}/css/custom-rtl.min.css">

{{--<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/vendors/filepond/filepond.min.css">--}}
{{--<link rel="stylesheet" type="text/css" href="{{ asset('public_assets/admin') }}/vendors/filepond/plugins/filepond.preview.min.css">--}}
{{--<!-- END: Custom CSS-->--}}
