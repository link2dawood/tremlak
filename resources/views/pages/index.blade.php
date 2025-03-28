@extends('pages.layouts.master')
@section('pageTitle','TRemlak360.com')
@section('content')

<!-- Home Banner Style V1 -->
<section class="home-banner-style4 p0 bgc-white">
    <div class="home-style4  position-relative mx-auto mx20-lg">
        <div class="container">
            <div class="row">
                <div class="col-xl-11 mx-auto">
                    <div class="inner-banner-style1 text-center position-relative z-index9">
                        <h6 class="hero-sub-title animate-up-1 position-relative">{{__('user.THE BEST WAY TO')}}</h6>
                        <h2 class="hero-title animate-up-2 position-relative">{{__('user.Find Your Dream Home')}}</h2>
                        <p class="hero-text fz15 animate-up-3 position-relative">{{__('user.We’ve more than')}} {{number_format($properties->count())}}
                            @foreach($propertyType_global as $key => $types)
                            <span>{{ $types->property_type_details[0]->title }}</span>
                            @if(!$loop->last)
                            @if($loop->remaining == 1)
                            &
                            @else
                            ,
                            @endif
                            @endif
                            @endforeach
                        </p>
                        <div class="advance-search-tab mt70 mt30-md mx-auto animate-up-3">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="advance-content-style1">
                                    <form action="{{route('properties')}}" id="search_form" method="GET">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-lg-10">
                                                <div class="advance-content-style1 at-home8">
                                                    <div class="row">
                                                        <style>
                                                            .bootselect-multiselect {
                                                                margin-top: 4px !important;
                                                                margin-bottom: 4px !important;
                                                            }
                                                        </style>
                                                        <div class="col-lg-4">
                                                            <div class="bootselect-multiselect my-1">
                                                                <select class="selectpicker" title="{{__('user.Property Types')}}" name="type_id_index" data-width="100%">
                                                                    <option value=""></option>
                                                                    @foreach($propertyType_global as $types)
                                                                    <option
                                                                    value="{{$types->id}}">{{$types->property_type_details[0]->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="bootselect-multiselect my-1">
                                                                <select class="selectpicker" title="{{__('user.City')}}" name="city_id" data-width="100%">
                                                                    <option value=""></option>
                                                                    @foreach($cities_global as $city)
                                                                    <option value="{{$city->id}}">{{$city->title}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @php
                                                            // Fetch the selected currency symbol from the database or set default to ₺
                                                            $currencySymbol = getCurrencySymbol() ?? '₺';
                                                        @endphp
                                                        
                                                        <div class="col-lg-4">
                                                            <div class="dropdown-lists at-home8 my-1">
                                                                <div class="btn open-btn drop_btn3 text-start dropdown-toggle" data-bs-toggle="dropdown">
                                                                    <span style="color: #999">{{ __('user.Price') }}</span>
                                                                    <i style="color: #999" class="fas fa-caret-down float-end fz11"></i>
                                                                </div>
                                                                <div class="dropdown-menu" style="width: 350px; padding: 15px;"> <!-- Increased width of dropdown -->
                                                                    <div class="widget-wrapper pb20 mb0">
                                                                        <div class="price-range-inputs d-flex justify-content-between"> <!-- Added justify-content-between -->
                                                                            <input type="hidden" name="currency_symbol" id="currency_symbol" value="{{ $currencySymbol }}">
                                                                            <!-- Min Price Input - Wider -->
                                                                            <div class="d-flex align-items-center" style="width: 45%;"> <!-- Set to percentage width -->
                                                                                <span class="currency-symbol me-2">{{ $currencySymbol }}</span>
                                                                                <input type="text" id="min_price" name="min_price" class="form-control border w-100 price-input" placeholder="Min Price">
                                                                            </div>
                                                                            <!-- Max Price Input - Wider -->
                                                                            <div class="d-flex align-items-center" style="width: 45%;"> <!-- Set to percentage width -->
                                                                                <span class="currency-symbol me-2">{{ $currencySymbol }}</span>
                                                                                <input type="text" id="max_price" name="max_price" class="form-control border w-100 price-input" placeholder="Max Price">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-2">
                                                <div class="d-flex align-items-center justify-content-start justify-content-md-center my-1">
                                                    <button class="advance-search-icon ud-btn btn-thm mv-992" type="submit"><span class="d-flex align-items-center gap-2 justify-content-center"><span class="flaticon-search"></span><span>{{__('user.Search')}}</span></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#explore-property">
        <div class="mouse_scroll animate-up-4">
            <img src="{{asset('agent/images/about/home-scroll.png')}}" alt="">
        </div>
    </a>
</div>
</section>



{{-- Properties by Types--}}
<section class="pt-5 pb-4 bgc-f7">
    <div class="container">
        <div class="row align-items-center wow fadeInUp" data-wow-delay="300ms">
            <div class="col-lg-9">
                <div class="main-title2 mb-3">
                    <h2 class="title">{{__('user.Properties by Cities')}}</h2>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="text-start text-lg-end mb-3">
                    <a class="ud-btn2" href="{{route('properties')}}">{{__('user.See All Properties')}}<i
                        class="fal fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                    <div
                    class="property-city-slider dots_none slider-dib-sm slider-4-grid2 vam_nav_style owl-theme owl-carousel">

                    @foreach($cities as $city)
                    <div class="item">
                        <div class="feature-style1 mb30">
                            <div class="feature-img"><img class="w-100"
                                src="{{ $city->image_path !='' ? asset($city->image_path) : asset('agent/images/placeholder.png') }}"
                                alt=""></div>
                                <div class="feature-content">
                                    <div class="top-area">
                                        <h6 class="title mb-1">{{ str_pad($city->number, 2, '0', STR_PAD_LEFT) }}. {{$city->title}}</h6>
                                        <p class="text">{{countBycity($city->id)}} {{__('user.properties')}}</p>
                                    </div>
                                    <form class="" action="{{route('properties')}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$settings->min_price}}" name="min_price">
                                        <input type="hidden" value="{{$settings->max_price}}" name="max_price">
                                        <input type="hidden" value="{{$city->id}}" name="city_id">
                                        <div class="bottom-area">
                                            <button class=" btn btn-link ud-btn2"
                                            type="submit">{{__('user.See All Properties')}}<i
                                            class="fal fa-arrow-right-long"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Properties by Types--}}
    <section class="pb-0 pt-4 ">
        <div class="container">
            <div class="row align-items-center wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-9">
                    <div class="main-title2 mb-3">
                        <h2 class="title">{{__('user.Properties by Types')}}</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="text-start text-lg-end mb-3">
                        <a class="ud-btn2" href="{{route('properties')}}">{{__('user.See All Properties')}}<i
                            class="fal fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                        <div
                        class="property-city-slider dots_none slider-dib-sm slider-4-grid2 vam_nav_style owl-theme owl-carousel">
                        @foreach($propertyType_global as $type)
                        <div class="item">
                            <div class="feature-style1 mb30">
                                <div class="feature-img"><img class="w-100"
                                    src="{{ $type->image_path !='' ? asset($type->image_path) : asset('agent/images/placeholder.png') }}"
                                    alt=""></div>
                                    <div class="feature-content">
                                        <div class="top-area">
                                            <h6 class="title mb-1">{{$type->property_type_details[0]->title}}</h6>
                                            <p class="text">{{countBytype($type->id)}} {{__('user.properties')}}</p>
                                        </div>
                                        <form class="" action="{{route('properties')}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$settings->min_price}}" name="min_price">
                                            <input type="hidden" value="{{$settings->max_price}}" name="max_price">
                                            <input type="hidden" value="{{$type->id}}" name="type_id_index">
                                            <div class="bottom-area">
                                                <button class=" btn btn-link ud-btn2"
                                                type="submit">{{__('user.See All Properties')}}<i
                                                class="fal fa-arrow-right-long"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us -->
        <section class="pt0 pb40-md d-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xl-4">
                        <div class="about-box-1 pe-4 mt100 mt0-lg mb30-lg wow fadeInRight" data-wow-delay="300ms">
                            <h2 class="title mb30">Let’s find the right selling option for you</h2>
                            <p class="text mb25 fz15">As the complexity of buildings to increase, the field of
                            architecture</p>
                            <div class="list-style1 mb50">
                                <ul>
                                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Find excellent deals</li>
                                    <li><i class="far fa-check text-white bgc-dark fz15"></i>Friendly host & Fast support
                                    </li>
                                    <li><i class="far fa-check text-white bgc-dark fz15"></i>List your own property</li>
                                </ul>
                            </div>
                            <a href="listing" class="ud-btn btn-white2">Learn More<i
                                class="fal fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-xl-8 col-xxl-7 offset-xxl-1">
                            <div class="position-relative mb35 mb0-sm wow fadeInLeft" data-wow-delay="300ms">
                                <div class="img-box-1 list-inline-item me-0">
                                    <img class="img-1" src="images/about/about-1.jpg" alt="">
                                </div>
                                <div class="img-box-2 list-inline-item me-0">
                                    <img class="img-1" src="images/about/about-2.jpg" alt="">
                                </div>
                                <div class="img-box-3">
                                    <img class="img-1 bounce-y" src="images/about/about-1.png" alt="">
                                </div>
                                <div class="img-box-4">
                                    <img class="img-1 spin-right" src="images/about/element-1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Our Testimonials -->
            <section class="pb100 pb50-md bgc-thm-light d-none">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="00ms">
                            <div class="main-title">
                                <h2 class="title">People Love Living with TREMLAK360</h2>
                                <p class="paragraph">Aliquam lacinia diam quis lacus euismod</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div
                            class="testimonial-slider navi_pagi_top_right slider-3-grid owl-carousel owl-theme wow fadeInUp"
                            data-wow-delay="300ms">
                            <div class="item">
                                <div class="testimonial-style1 position-relative">
                                    <div class="testimonial-content">
                                        <h5 class="title">Great Work</h5>
                                        <span class="icon fas fa-quote-left"></span>
                                        <p class="text">“Amazing design, easy to customize and a design quality superlative
                                            account on its cloud platform for the optimized performance. And we didn’t on
                                        our original designs.”</p>
                                        <div class="testimonial-review">
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                        </div>
                                    </div>
                                    <div class="thumb d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img class="wa" src="images/testimonials/testimonial-1.png" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Leslie Alexander</h6>
                                            <p class="mb-0">Nintendo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-style1 position-relative">
                                    <div class="testimonial-content">
                                        <h5 class="title">Great Work</h5>
                                        <span class="icon fas fa-quote-left"></span>
                                        <p class="text">“Amazing design, easy to customize and a design quality superlative
                                            account on its cloud platform for the optimized performance. And we didn’t on
                                        our original designs.”</p>
                                        <div class="testimonial-review">
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                        </div>
                                    </div>
                                    <div class="thumb d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img class="wa" src="images/testimonials/testimonial-1.png" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Floyd Miles</h6>
                                            <p class="mb-0">Bank of America</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-style1 position-relative">
                                    <div class="testimonial-content">
                                        <h5 class="title">Great Work</h5>
                                        <span class="icon fas fa-quote-left"></span>
                                        <p class="text">“Amazing design, easy to customize and a design quality superlative
                                            account on its cloud platform for the optimized performance. And we didn’t on
                                        our original designs.”</p>
                                        <div class="testimonial-review">
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                        </div>
                                    </div>
                                    <div class="thumb d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img class="wa" src="images/testimonials/testimonial-1.png" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Dianne Russell</h6>
                                            <p class="mb-0">Facebook</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-style1 position-relative">
                                    <div class="testimonial-content">
                                        <h5 class="title">Great Work</h5>
                                        <span class="icon fas fa-quote-left"></span>
                                        <p class="text">“Amazing design, easy to customize and a design quality superlative
                                            account on its cloud platform for the optimized performance. And we didn’t on
                                        our original designs.”</p>
                                        <div class="testimonial-review">
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                        </div>
                                    </div>
                                    <div class="thumb d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img class="wa" src="images/testimonials/testimonial-1.png" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Dianne Russell</h6>
                                            <p class="mb-0">Facebook</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-style1 position-relative">
                                    <div class="testimonial-content">
                                        <h5 class="title">Great Work</h5>
                                        <span class="icon fas fa-quote-left"></span>
                                        <p class="text">“Amazing design, easy to customize and a design quality superlative
                                            account on its cloud platform for the optimized performance. And we didn’t on
                                        our original designs.”</p>
                                        <div class="testimonial-review">
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a class="me-1" href="#"><i class="fas fa-star"></i></a>
                                            <a href="#"><i class="fas fa-star"></i></a>
                                        </div>
                                    </div>
                                    <div class="thumb d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img class="wa" src="images/testimonials/testimonial-1.png" alt="">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Dianne Russell</h6>
                                            <p class="mb-0">Facebook</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Our CTA -->
        @include('pages.includes.need_help')
       <!--  <script>
           document.addEventListener("DOMContentLoaded", function () {
            function formatNumberInput(input) {
                input.addEventListener("input", function (event) {
            let value = event.target.value.replace(/\./g, ""); // Remove existing dots
            if (value) {
                event.target.value = new Intl.NumberFormat("de-DE").format(value); // Format with dots
            }
        });
            }

            let numberInputs = document.querySelectorAll("input[type='number']");
            numberInputs.forEach(input => formatNumberInput(input));
        });
    </script> -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Display currency symbol
            const currencySymbol = document.getElementById('currency_symbol').value;
            const currencyElements = document.querySelectorAll('.currency-symbol');
            
            currencyElements.forEach(element => {
                element.textContent = currencySymbol;
            });
            
    // Handle price inputs with German number formatting
            const priceInputs = document.querySelectorAll('.price-input');
            
            priceInputs.forEach(input => {
        // Track the raw value (without formatting)
                let rawValue = '';
                
                input.addEventListener('focus', function() {
            // Store current position
                    const position = this.selectionStart;
                    
            // On focus, set to raw value for editing
                    const currentValue = this.value.replace(/\./g, '');
                    if (currentValue) {
                        rawValue = currentValue;
                // Don't format when focused to make editing easier
                    }
                    
            // Restore cursor position
                    setTimeout(() => {
                        this.selectionStart = this.selectionEnd = position;
                    }, 1);
                });
                
                input.addEventListener('input', function(event) {
            // Remove any non-numeric characters
                    rawValue = this.value.replace(/[^\d]/g, '');
                    
            // Enforce maximum value of 1 quadrillion (15 zeros)
                    if (rawValue.length > 15) {
                        rawValue = rawValue.slice(0, 15);
                    }
                    
            // Format with dots for display
                    if (rawValue) {
                        this.value = new Intl.NumberFormat('de-DE').format(rawValue);
                    } else {
                        this.value = '';
                    }
                    
            // Store raw value as data attribute for form submission
                    this.dataset.rawValue = rawValue;
                });
                
        // Update hidden field with raw value on form submission
                input.closest('form')?.addEventListener('submit', function() {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = input.name + '_raw';
                    hiddenInput.value = input.dataset.rawValue || '';
                    this.appendChild(hiddenInput);
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
        let minPrice = 0; // Default minimum price
        let maxPrice = 10000; // Default maximum price

        $("#price-slider").slider({
            range: true,
            min: 0,
            max: 10000,
            values: [minPrice, maxPrice],
            slide: function(event, ui) {
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
            }
        });

        // Set initial values
        $("#min_price").val($("#price-slider").slider("values", 0));
        $("#max_price").val($("#price-slider").slider("values", 1));
    });
</script>

@endsection