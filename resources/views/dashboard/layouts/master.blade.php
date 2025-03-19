<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="advanced search, agency, agent, classified, directory, house, listing, property, real estate, real estate agency, real estate agent, realestate, rental">
    <meta name="description" content="">
    <meta name="CreativeLayers" content="">
    <!-- css file -->
    <link rel="stylesheet" href="{{asset('agent/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/ace-responsive-menu.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/ud-custom-spacing.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/slider.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('agent/css/style.css')}}?v=1.234">

    <link rel="stylesheet" href="{{asset('agent/css/rtlcss.css')}}">
    <!-- Responsive stylesheet -->
    <link rel="stylesheet" href="{{asset('agent/css/responsive.css')}}">
    <!-- Title -->
    <title>@yield('pageTitle')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('agent/images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('agent/images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('agent/images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('agent/images/favicon/site.webmanifest')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

{{--    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>--}}
{{--    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    <link rel="stylesheet" href="{{asset('admin/assets/css/sweetAlert2.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/css/image-upload.css')}}">

    {{--    dataTables CSS--}}
    <link href="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/datatables/responsive.bootstrap5.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/datatables/buttons.dataTables.min.css')}}" rel="stylesheet">

    <!-- Google Map API -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API')}}&callback=initMap&libraries=places" defer></script>
</head>
<body>
<div class="wrapper">
    <div class="preloader"></div>
@include('dashboard.includes.header')
@include('dashboard.includes.mobileNavigation')
    <div class="dashboard_content_wrapper">
        <div class="dashboard dashboard_wrapper pr30 pr0-xl">
            @include('dashboard.includes.sidebar')
            <div class="dashboard__main pl0-md mt-0">
                @yield('content')

                @include('dashboard.includes.lang')
               @include('dashboard.includes.footer')
            </div>
        </div>
    </div>
    <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
</div>

@include('dashboard.includes.footerLinks')
@yield("script")

@if(session('status'))
    <script>
        Swal.fire("Status","{{session('status')}}","info").then((res)=>{

        });
    </script>
@endif
