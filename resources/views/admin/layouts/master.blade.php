
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    {{--    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('admin/assets/favicon/apple-touch-icon.png')}}">--}}
    {{--    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('admin/assets/favicon/favicon-32x32.png')}}">--}}
    {{--    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/assets/favicon/favicon-16x16.png')}}">--}}
    {{--    <link rel="manifest" href="{{asset('admin/assets/favicon/site.webmanifest')}}">--}}
    {{--    <link rel="mask-icon" href="{{asset('admin/assets/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">--}}
    {{--    <meta name="msapplication-TileColor" content="#da532c">--}}
    {{--    <meta name="theme-color" content="#ffffff">--}}
    @if($settings->logo !="")
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset($settings->logo)}}">
    @else
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/assets/img/logo.png')}}">
    @endif

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/select/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/bootstrap/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Template Main CSS File -->
    <link href="{{asset('admin/assets/css/style.css')}}?v=1.2" rel="stylesheet">
    <link href="{{asset('admin/assets/css/custom-styles.css')}}?v=1.23" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/assets/css/sweetAlert2.css')}}">
    {{--    dataTables CSS--}}
    <link href="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap5.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/datatables/responsive.bootstrap5.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/datatables/buttons.dataTables.min.css')}}" rel="stylesheet">
    <style>
        @yield("css")
    </style>
</head>
<body>
<div class="wrapper">
    <!-- End preloader -->
    @include('admin.layouts.header')
    @include('admin.includes.sidebar')
    <div class="content">
        @yield("content")
    </div>
    @include('dashboard.includes.lang')
    @include('admin.includes.lang')
    @include('admin.layouts.footer')
</div>

<script>
    $('.selectpicker').selectpicker();
</script>
@yield("script")

@if(session()->has('icon') && session()->has('title') && session()->has('text'))
    <script>
        Swal.fire({
            icon: '{{session('icon')}}',
            title: '{{session('title')}}',
            text: '{{session('text')}}',
        }).then(() => {
            {{--window.location.href='{{session('location')}}';--}}
        });
    </script>
@endif
</body>
</html>
