<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    {{--    @yield('blog-mata')--}}
    <title>@yield('pageTitle')</title>
    <meta name="description" content="{{$settings->seo_description}}">
    <meta name="keywords" content="{{$settings->seo_keywords}}">
    <meta name="author" content="{{$settings->seo_author}}">
    <link rel="canonical" href="{{$settings->seo_canonical}}">
    <meta name="google-site-verification" content="JZ6Du9Iyp92nGv9dfw5A4UR61pKc11Z3b1ebHWldafs" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PGRXZN7HMY"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-PGRXZN7HMY');
  </script>
  <!-- css file -->
  <link rel="stylesheet" href="{{asset('agent/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/ace-responsive-menu.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/menu.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/fontawesome.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/flaticon.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/bootstrap-select.min.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/ud-custom-spacing.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/style.css')}}?v=1.432">
  <link rel="stylesheet" href="{{asset('agent/css/animate.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/jquery-ui.min.css')}}">
  <!-- Additional stylesheets from the second file -->
  <link rel="stylesheet" href="{{asset('agent/css/slider.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/magnific-popup.css')}}">
  <!-- Responsive stylesheet -->
  <link rel="stylesheet" href="{{asset('agent/css/responsive.css')}}">
  <link rel="stylesheet" href="{{asset('agent/css/rtlcss.css')}}">

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
  <!-- Google Map API -->
  <script src="https://maps.googleapis.com/maps/api/js?key={{env('MAP_API')}}&callback=initMap&libraries=places" defer></script>
  @yield('blog-style')
</head>
<style type="text/css">
    .text-danger {
        color: red !important;
    }
</style>
<body>
    <div class="wrapper ovh">
        {{--    <div class="preloader"></div>--}}

        <!-- Main Header Nav -->
        @include('pages.includes.header')

        <div class="hiddenbar-body-ovelay"></div>
        <!-- Mobile Nav  -->
        @include('pages.includes.mobileNavigation')
        <div class="body_content">

            @yield('content')

            @include('pages.includes.lang')
            <!-- Our Footer -->
            @include('pages.includes.footer')
        </div>
    </div>
    <!-- Wrapper End -->
    @include('pages.includes.footerLinks')
    @yield("script")

    @if(session('status'))
    <script>
        Swal.fire("Status","{{session('status')}}","info").then((res)=>{

        });
    </script>
    @endif

    <script>
            // function toggleFavorite(propertyId) {
            //     var favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            //     var index = favorites.indexOf(propertyId);

            //     if (index === -1) {
            //         favorites.push(propertyId);
            //         Swal.fire(lang["Success"],lang["Property saved in your favourite list successfully."],"success");
            //     // Add text-danger class to the heart icon
            //         $("#favoriteIcon" + propertyId + " span.fa-heart").addClass('fa-solid text-danger');

            //     } else {
            //     // Remove the text-danger class from the heart icon
            //     // $("#favoriteIcon" + propertyId + " span.fa-heart").removeClass('text-danger');
            //         Swal.fire(lang["Alert"],lang["Property already saved in your favourite list."],"info");
            //     }

            //     localStorage.setItem('favorites', JSON.stringify(favorites));
            // }
        // Function to toggle favorite status
        function toggleFavorite(propertyId) {
            var favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            var index = favorites.indexOf(propertyId);

            if (index === -1) {
        // Add to favorites
                favorites.push(propertyId);
                Swal.fire(lang["Success"], lang["Property saved in your favourite list successfully."], "success");
        // Add text-danger class to the heart icon
                $("#heartIcon" + propertyId).addClass('fa-solid text-danger');
            } else {
        // Remove from favorites
                favorites.splice(index, 1);
                Swal.fire(lang["Alert"], lang["Property removed from your favourite list."], "info");
        // Remove text-danger class from the heart icon
                $("#heartIcon" + propertyId).removeClass('fa-solid text-danger');
            }

    // Update localStorage
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }

// Function to check favorite status on page load
        function checkFavoritesOnLoad() {
            var favorites = JSON.parse(localStorage.getItem('favorites')) || [];

            favorites.forEach(function (propertyId) {
        // Add text-danger class to the heart icon if the property is favorited
                $("#heartIcon" + propertyId).addClass('fa-solid text-danger');
            });
        }

// Call the function to check favorites when the page loads
        $(document).ready(function () {
            checkFavoritesOnLoad();
        });
        function removeFavorite(propertyId) {
            var favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            var index = favorites.indexOf(propertyId);

            if (index === -1) {

            // Swal.fire(lang["Success"],lang["Property saved in your favourite list successfully."],"success");
            } else {
                favorites.splice(index, 1);
                $("#card_div"+propertyId).hide();
            // Swal.fire(lang["Alert"],lang["Property already saved in your favourite list."],"info");
            }

            localStorage.setItem('favorites', JSON.stringify(favorites));
        }
    </script>

