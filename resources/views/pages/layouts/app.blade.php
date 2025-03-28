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
   <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-38VLHLMTR8"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-38VLHLMTR8');
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
       <div class="bg-light py-1 text-end px-3 px-md-3 px-lg-5">
    <div class="d-flex align-items-center justify-content-end gap-3 py-2">

        <div class="language">
            <a onclick="showLanguages()" class="lang-drpdwn-btn">
                <img id="selectedFlagLang" style="width: 30px;height: 30px" class="pe-2" src="https://websiteprojecttest.com/flags/trky.svg" alt="">
                <span id="selectedLang">Lang</span>
            </a>
            <div class="dropdown-language" onclick="event.stopPropagation();">
                @foreach($language_global as $language)
                <a href="#" class="d-flex align-items-center"  onclick="changeLanguage(`{{$language->short_name}}`, `{{url($language->flags)}}`, `{{$language->short_name}}`)">
                    <img class="pe-2" style="width: 30px;height: 30px" src="{{url($language->flags)}}" alt="">{{$language->name}}
                </a>
                @endforeach

            </div>
        </div>

        <div class="currency">
            <a onclick="showCurrencies()" class="currency-drpdwn-btn">
                <img id="selectedFlagCurrency" style="width: 30px;height: 30px" class="pe-2" src="https://websiteprojecttest.com/flags/trky.svg" alt="">
                <span id="selectedCurrency">Currency</span>
            </a>
            <div class="dropdown-currency" onclick="event.stopPropagation();">
                @foreach($currency_global as $currency)
                <a href="#" class="d-flex align-items-center" onclick="changeCurrency(`{{$currency->code}}`, `{{asset($currency->flags)}}`, `{{$currency->code}}`)">
                    <img class="pe-2" style="width: 30px;height: 30px" src="{{ asset($currency->flags) }}" alt="">{{$currency->code}}
                </a>
                @endforeach
                <!-- Add more currency options as needed -->
            </div>
        </div>


    </div>
</div>
<header class="header-nav nav-innerpage-style bdrb1 style2 main-menu py-0">
    <!-- Ace Responsive Menu -->
    <nav class="posr">
        <div class="container posr menu_bdrt1">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <a class="header-logo" href="/"><img src="{{asset('agent/images/header-logo2.svg')}}"
                                                         alt="Header Logo"></a>
                </div>
                <div class="col-auto">
                    <!-- Responsive Menu Structure-->
                    <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                        <li class="visible_list"><a class="list-item" href="{{route('/')}}"><span
                                    class="title">{{__('user.home')}}</span></a></li>
                        <li class="visible_list"><a class="list-item" href="{{route('properties')}}"><span
                                    class="title">{{__('user.properties')}}</span></a></li>
                        <li class="visible_list"><a class="list-item" href="{{route('about')}}"><span
                                    class="title">{{__('user.about')}}</span></a></li>
{{--                        <li class="visible_list"><a class="list-item" href="{{route('contact')}}">--}}
{{--                                <span class="title">{{__('user.contact')}}</span></a></li>--}}
                        <li class="visible_list"><a class="list-item" href="{{route('favorite')}}">
                                <span class="title">{{__('user.Favourites')}}</span></a></li>

{{--                        <li class="visible_list"><a class="list-item" href="{{route('view_agents')}}"><span--}}
{{--                                    class="title">{{__('user.agents')}}</span></a></li>--}}
                        @if(Auth::user())
                            <li class="visible_list"><a class="list-item" href="#"><span
                                        class="title">{{__('user.dashboard')}}</span></a>
                                <ul class="sub-menu">
                                    @if(Auth::user()->user_type == 1)
                                        <li><a href="{{route('dashboard')}}">{{__('user.admin dashboard')}}</a></li>
                                    @endif
                                    <li><a href="{{route('agent_dashboard')}}">{{__('user.dashboard')}}</a></li>
                                    <li><a href="{{route('add_property')}}">{{__('user.add new property')}}</a></li>
{{--                                    <li><a href="{{route('messages')}}">{{__('user.messages')}}</a></li>--}}
                                    <li><a href="{{route('notifications')}}">{{__('user.notifications')}}</a></li>
                                    <li><a href="{{route('my_properties')}}">{{__('user.my properties')}}</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-4">
                        @if(Auth::user())
                            <ul class="mb0 d-flex justify-content-center justify-content-sm-end p-0">
                                <li class=" user_setting">
                                    <div class="dropdown">
                                        <a class="btn mt-2" href="#" data-bs-toggle="dropdown">
                                            <img class=""
     style="width: 70px; height: 50px; object-fit: cover; border-radius: 10px; background: #e0e0e0;"
     src="{{ Auth::user()->image_path !='' ? asset(Auth::user()->image_path) : asset('agent/images/placeholder.png') }}"
     alt="">


                                        </a>
                                        <div class="dropdown-menu mobile_dropdown p-2">
                                            <div class="user_setting_content">
                                                <a class="dropdown-item mb-1"
                                                   href="{{url('profile')}}">{{__('user.My Profile')}}</a>
                                                <a class="dropdown-item" href="{{route('logout')}}"
                                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('user.Logout')}}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <div class="d-flex align-items-center gap-3">
                                <a class="login-info d-flex align-items-center ud-btn btn-thm py-2" href="{{route('login')}}"
                                   role="button"><span class="d-none d-xl-block">{{__('user.Login')}}</span></a>

                                <a class="login-info d-flex align-items-center py-2 ud-btn btn-transparent" href="{{route('register')}}"
                                   role="button"><span class="d-none d-xl-block">{{__('user.Register')}}</span></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>


        <div class="hiddenbar-body-ovelay"></div>
        <!-- Mobile Nav  -->
        <div id="page" class="mobilie_header_nav stylehome1">
    <div class="mobile-menu">
        <div class="header innerpage-style">
            <div class="menu_and_widgets">
                <div class="mobile_menu_bar d-flex justify-content-between align-items-center">
                    <a class="menubar" href="#menu"><img src="{{asset('agent/images/mobile-dark-nav-icon.svg')}}" alt=""></a>
                    <a class="mobile_logo" href="#"><img src="{{asset('agent/images/header-logo2.svg')}}" alt=""></a>
                    <!--                    <a href="login"><span class="icon fz18 far fa-user-circle"></span></a>-->
                    @if(Auth::user())
                        <ul class="mb0 d-flex justify-content-center justify-content-sm-end p-0">
                            <li class=" user_setting">
                                <div class="dropdown">
                                    <a class="btn p-0 pt-0 h-unset" href="#" data-bs-toggle="dropdown">
                                        <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover" src="{{ Auth::user()->image_path !='' ? asset(Auth::user()->image_path) : asset('agent/images/placeholder.png')  }}" alt="">
                                    </a>
                                    <div class="dropdown-menu mobile_dropdown">
                                        <div class="user_setting_content">
                                            <a class="dropdown-item mb-2" href="{{url('profile')}}">{{__('user.My Profile')}}</a>
                                            <a class="dropdown-item" href="{{url('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('user.Logout')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @else
                        <div class="d-flex align-items-center">
                            <a class="login-info d-flex align-items-center " href="{{route('login')}}"
                               role="button"><span class=" d-xl-block">{{__('user.Login')}}</span></a>
                            <span class="login-info ">/</span>
                            <a class="login-info d-flex align-items-center" href="{{route('register')}}"
                               role="button"><span class="d-xl-block">{{__('user.Register')}}</span></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.mobile-menu -->
    <nav id="menu" class="">
        <ul>
            <li> <a href="{{route('/')}}"><span>{{__('user.home')}}</span></a></li>
            <li> <a href="{{route('properties')}}"><span>{{__('user.properties')}}</span></a></li>
            <li> <a href="{{route('about')}}"><span>{{__('user.about')}}</span></a></li>
            <li><a  href="{{route('favorite')}}"><span>{{__('user.Favourites')}}</span></a></li>
{{--            <li> <a href="{{route('contact')}}"><span>{{__('user.contact')}}</span></a></li>--}}
{{--            <li> <a href="{{route('view_agents')}}"><span>{{__('user.agents')}}</span></a></li>--}}
            @if(Auth::user())
                <li><span class="title">{{__('user.dashboard')}}</span>
                    <ul>
                        @if(Auth::user()->user_type == 1)
                            <li><a href="{{route('dashboard')}}">{{__('user.admin dashboard')}}</a></li>
                        @endif
                        <li><a href="{{route('dashboard')}}">{{__('user.dashboard')}}</a></li>
                        <li><a href="{{route('add_property')}}">{{__('user.add new property')}}</a></li>
{{--                        <li><a href="{{route('messages')}}">{{__('user.messages')}}</a></li>--}}
                        <li><a href="{{route('notifications')}}">{{__('user.notifications')}}</a></li>
                        <li><a href="{{route('my_properties')}}">{{__('user.my properties')}}</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
</div>

        <div class="body_content">

            @yield('content')

            <script>
    var lang = {
        "Property link is copied you can share it.": "{{ __('user.Property link is copied you can share it.') }}",
        "Property saved in your favourite list successfully.": "{{ __('user.Property saved in your favourite list successfully.') }}",
        "Property already saved in your favourite list.": "{{ __('user.Property already saved in your favourite list.') }}",
    };
</script>


            <!-- Our Footer -->
           <section class="footer-style1 pt60 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="footer-widget mb-4 mb-lg-5">
                    <a class="footer-logo" href="{{route('/')}}"><img class="mb-3" src="{{asset('agent/images/header-logo.svg')}}" alt=""></a>
                    <div class="row mb-4 mb-lg-5">
{{--                        <div class="col-auto">--}}
{{--                            <div class="contact-info">--}}
{{--                                <p class="info-title">{{__('user.Total Free Customer Care')}}</p>--}}
{{--                                <h6 class="info-phone"><a href="tel:{{$settings->phone_number}}">{{$settings->phone_number}}</a></h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-auto">
                            <div class="contact-info">
                                <p class="info-title">{{__('user.Need Live Support?')}}</p>
                                <h6 class="info-mail"><a href="mailto:{{$settings->email}}">{{$settings->email}}</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="social-widget">
                        <h6 class="text-white mb20">{{__('user.Follow us on social media')}}</h6>
                        <div class="social-style1">
                            <a target="_blank" href="{{$social_links->youtube ?? ''}}"><i class="fab fa-youtube list-inline-item"></i></a>
                            <a target="_blank" href="{{$social_links->instagram ?? ''}}"><i class="fab fa-instagram list-inline-item"></i></a>
                            <a target="_blank" href="{{$social_links->tiktok ?? ''}}"><i class="fab fa-tiktok list-inline-item"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="footer-widget mb-4 mb-lg-5">
{{--                    <div class="mailchimp-widget mb-4 mb-lg-5">--}}
{{--                        <h6 class="title text-white mb20">{{__('user.Keep Yourself Up to Date')}}</h6>--}}
{{--                        <div class="mailchimp-style1">--}}
{{--                            <form id="news_letter">--}}
{{--                                <input type="email" id="news_email" class="form-control" required placeholder="{{__('user.Your Email')}}">--}}
{{--                                <button id="news_letter_btn" type="submit">{{__('user.Subscribe')}}</button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row justify-content-between">

                        <div class="col-auto">
                            <div class="link-style1 mb-3">
                                <h6 class="text-white mb25">{{__('user.Quick Links')}}</h6>
                                <ul class="ps-0">
                                    <li><a href="{{route('blogs')}}">{{__('user.Blogs')}}</a></li>
                                    <li><a href="{{route('terms')}}">{{__('user.Terms Of Use')}}</a></li>
                                    <li><a href="{{route('privacy')}}">{{__('user.Privacy Policy')}}</a></li>
                                    <li><a href="{{route('contact')}}">{{__('user.contact')}}</a></li>
                                    <li><a href="{{route('favorite')}}">{{__('user.favorite')}}</a></li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container white-bdrt1 py-4">
        <div class="row">
            <div class="col-sm-6">
                <div class="text-center text-lg-start">
                    <p class="copyright-text text-gray ff-heading">© {{$settings->site_name}} - {{__('user.All Rights Reserved')}}</p>
                </div>
            </div>
            <div class="col-sm-6 d-none">
                <div class="text-center text-lg-end">
                    <p class="footer-menu ff-heading text-gray">
                        <a class="text-gray" href="{{route('privacy')}}">{{__('Privacy')}}</a>· <a class="text-gray" href="{{route('terms')}}">{{__('Terms')}}</a> ·
{{--                        <a class="text-gray" href="#">{{__('Sitemap')}}</a>--}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>

        </div>
    </div>
    <!-- Wrapper End -->
    <!-- Content from the first file -->

<script src="{{asset('agent/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{asset('agent/js/jquery-migrate-3.0.0.min.js')}}"></script>
<script src="{{asset('agent/js/popper.min.js')}}"></script>
<script src="{{asset('agent/js/bootstrap.min.js')}}"></script>
<script src="{{asset('agent/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('agent/js/jquery.mmenu.all.js')}}"></script>
<script src="{{asset('agent/js/ace-responsive-menu.js')}}"></script>
<script src="{{asset('agent/js/jquery-scrolltofixed-min.js')}}"></script>
<script src="{{asset('agent/js/wow.min.js')}}"></script>
<script src="{{asset('agent/js/isotop.js')}}"></script>
<script src="{{asset('agent/js/owl.js')}}"></script>
<script src="{{asset('agent/js/parallax.js')}}"></script>
<script src="{{asset('agent/js/script.js')}}"></script>
<script src="{{asset('agent/js/pricing-slider.js')}}"></script>
<script src="{{asset('agent/js/ajaxCall.js')}}?v=1.324"></script>
<script src="{{asset('agent/js/localization.js')}}"></script>
<script type="text/javascript"  src="{{asset('admin/assets/js/sweetAlert2.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css">

<!-- Content from the second file -->

<script src="{{asset('agent/js/custom_map.js')}}"></script>
<script src="{{asset('agent/js/scrollbalance.js')}}"></script>
<script>
    // Fixed sidebar Custom Script For That
    $(function () {
        var cols = $('.wrap .column');
        var enabled = true;
        var scrollbalance = new ScrollBalance(cols, {
            minwidth: 0
        });
        // bind to scroll and resize events
        scrollbalance.bind();
    });
</script>

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
</body>
</html>

