@extends('pages.layouts.master')
@section('pageTitle',__('user.properties'))
@section('content')

<!-- Filter Content In Hiddn SideBar -->
<style type="text/css">
    .fixed-title {
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limits text to exactly 2 lines */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        height: 48px; /* Adjust based on your font-size */
        line-height: 24px; /* Ensures two full lines */
        white-space: normal;
    }
    .listIconsStyle img,
    .list-meta img {
        width: 24px;  /* Adjust based on your design */
        height: 24px; /* Adjust based on your design */
        object-fit: contain; /* Ensures the image is not stretched */
        max-width: 100%;
        max-height: 100%;
    }
</style>
<section class="breadcumb-section bgc-f7 py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcumb-style1">
                    {{--                        <h2 class="title">New York Homes for Sale</h2>--}}
                    <div class="breadcumb-list">
                        <a href="{{route('/')}}">{{__('user.home')}}</a>
                        <a href="#">{{__('user.properties')}}</a>
                    </div>
                    <a href="#" class=" mobile-filter-btn mobile-filter-btn-new d-block d-lg-none"><span
                        class="flaticon-settings"></span> Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Property Lists -->
    <section class="pt0 pb90 bgc-f7">
        <div class="container">
            <div class="row gx-xl-5">
                <div class="col-lg-4" id="desktop_filter">
                    <div class="position-relative">
                        <div class="positioninMobile">
                            <form action="{{route('properties')}}" id="search_form" method="POST">
                                <input type="hidden" name="sort_by" id="set_sort_by">
                                <input type="hidden" name="type_id_index" value="{{ $type_id_index ?? '' }}">
                                @csrf
                                
                                <div class="list-sidebar-style1">
                                    <div class="min-height-mobile">
                                        <div class="widget-wrapper advance-feature-modal mb-3">
                                            <h6 class="list-title">{{__('user.Property Types')}}</h6>
                                            <div class="form-style2 input-group">
                                                <!-- Property Type Select -->
                                                <select class="selectpicker" title="{{ __('user.Please Select') }}" id="property_type_listing" name="type_id" data-width="100%">
                                                    <option value="">{{ __('user.All Property-Types') }}</option>
                                                    @foreach ($propertyType_global as $types)
                                                    <option value="{{ $types->id }}" {{ isset($type_id_index) && $type_id_index == $types->id ? 'selected' : '' }}>
                                                        {{ $types->property_type_details[0]->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="widget-wrapper advance-feature-modal mb-3">
                                            
                                            <h6 class="list-title">{{__('user.Cities')}}</h6>
                                            <div class="form-style2 input-group">
                                                <!-- City Select -->
                                                <select class="selectpicker" title="{{ __('user.Please Select') }}" name="city_id" id="property_city_multiple" data-width="100%">
                                                    <option value="">{{ __('user.All Cities') }}</option>
                                                    @foreach ($cities_global as $city)
                                                    <option value="{{ $city->id }}" {{ isset($city_id) && $city_id == $city->id ? 'selected' : '' }}>
                                                        {{ $city->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="widget-wrapper advance-feature-modal mb-3">
                                            <h6 class="list-title">{{__('user.Town')}}</h6>
                                            <div class="form-style2 input-group">
                                                <select class="selectpicker" title="{{__('user.Please Select')}}" name="town_id" id="property_town_multiple"
                                                data-width="100%">
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('user.Districts')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="district_id"
                                            id="property_district_multiple" data-width="100%">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="widget-wrapper advance-feature-modal mb-3">
                                    <h6 class="list-title">{{ __('user.Price Range') }}</h6>
                                    <div class="range-slider-style2">
                                        <div class="range-wrapper">
                                            <!-- <div id="price-slider"></div> -->
                                            <input type="hidden" name="currency_symbol" id="currency_symbol" value="{{ getCurrencySymbol() }}">
                                            <div class="price-range-inputs d-flex align-items-center justify-content-between gap-3 mt-3">
                                                <!-- Price Range Inputs -->
                                                 <span class="currency-symbol me-2"></span>
                                                <input type="text" id="min_price" name="min_price" placeholder="Min Price" value="{{ @$min_price  }}" class="amount p-2 form-control border w-100">
                                                <span>-</span>
                                                 <span class="currency-symbol me-2"></span>
                                                <input type="text" id="max_price" name="max_price" placeholder="Max Price" value="{{ @$max_price }}" class="amount p-2 form-control border w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                {{--Type Apartment--}}
                                <div class="d-none" id="type_apartment">
                                    
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Type of apartment')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="apartment_type[]" multiple id="apartment_type">
                                                <option value="Studio">{{__('agent.Studio')}}</option>
                                                <option value="Apartment">{{__('agent.Flat')}}</option>
                                                <option value="Duplex">{{__('agent.Duplex')}}</option>
                                                <option value="Triplex">{{__('agent.Triplex')}}</option>
                                                <option value="Fourplex">{{__('agent.Fourplex')}}</option>
                                                <option value="Penthouse">{{__('agent.Penthouse')}}</option>
                                                <option value="Garden Duplex">{{__('agent.Garden Duplex')}}</option>
                                                <option value="Roof  Duplex">{{__('agent.Roof  Duplex')}}</option>
                                                <option value="Reverse Duplex">{{__('agent.Reverse Duplex')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Condition')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="apartment_conditionp[]" multiple id="apartment_conditionp">
                                                <option value="new">{{__('agent.new')}}</option>
                                                <option value="under construction">{{__('agent.under construction')}}</option>
                                                <option value="in planning">{{__('agent.in planning')}}</option>
                                                <option value="very good">{{__('agent.very good')}}</option>
                                                <option value="good">{{__('agent.good')}}</option>
                                                <option value="need of renovation">{{__('agent.need of renovation')}}</option>
                                                <option value="uninhabitable">{{__('agent.uninhabitable')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Apartment m²')}} <span class="text-muted small">({{__('agent.gross')}})</span></h6>
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div id="range_apartment_grossm2"></div>
                                                
                                                <div class="price-range-inputs d-flex align-items-center justify-content-between gap-3 mt-3">
                                                    <input type="text" min="0" id="min_apartment_grossm2" value="1"  name="min_apartment_grossm2" class="p-2 rangeWidth" >
                                                    <span>-</span>
                                                    <input type="text" id="max_apartment_grossm2" value="1.000" name="max_apartment_grossm2"  class="p-2 rangeWidth" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Bedrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-apartment_bed mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_apartment_bed p-2 rangeWidth" value="0" name="min_apartment_bed"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_apartment_bed p-2 rangeWidth" value="15" name="max_apartment_bed"
                                                    placeholder="15">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Bathrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-apartment_bath mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_apartment_bath p-2 rangeWidth" value="1" name="min_apartment_bath"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_apartment_bath p-2 rangeWidth" value="5" name="max_apartment_bath"
                                                    placeholder="5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Livingrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-apartment_living mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_apartment_living p-2 rangeWidth" value="1" name="min_apartment_living"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_apartment_living p-2 rangeWidth" value="5" name="max_apartment_living"
                                                    placeholder="5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Apartment Floor')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-apartment_floors mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_apartment_floors p-2 rangeWidth" value="" name="min_apartment_floors"
                                                    placeholder="{{__('user.Basement')}}">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number" class="max_apartment_floors p-2 rangeWidth" value="70" name="max_apartment_floors"
                                                    placeholder="70. {{__('user.floor')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Building Floors')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-apartment_building_floors mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_apartment_building_floors p-2 rangeWidth" value="1" name="min_apartment_building_floors"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_apartment_building_floors p-2 rangeWidth" value="70" name="max_apartment_building_floors"
                                                    placeholder="70">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Age')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="apartment_age[]" multiple id="apartment_age">
                                                <option value="new">{{__('agent.new')}}</option>
                                                <option value="under construction">{{__('agent.under construction')}}</option>
                                                <option value="in planning">{{__('agent.in planning')}}</option>
                                                <option value="1 year old">{{__('agent.1 year old')}}</option>
                                                <option value="2 years old">{{__('agent.2 years old')}}</option>
                                                <option value="3 - 5 years old">{{__('agent.3 - 5 years old')}}</option>
                                                <option value="6 - 10 years old">{{__('agent.6 - 10 years old')}}</option>
                                                <option value="11 - 20 years old">{{__('agent.11 - 20 years old')}}</option>
                                                <option value="21 - 30 years old">{{__('agent.21 - 30 years old')}}</option>
                                                <option value="more than 31 years old">{{__('agent.more than 31 years old')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Heating')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="apartment_heating[]" multiple id="apartment_heating">
                                                
                                                <option value="None">{{__('agent.None')}}</option>
                                                <option value="Air Conditioner">{{__('agent.Air Conditioner')}}</option>
                                                <option value="Natural Gas">{{__('agent.Natural Gas')}}</option>
                                                <option value="Electric">{{__('agent.Electric')}}</option>
                                                <option value="Coal">{{__('agent.Coal')}}</option>
                                                <option value="Oil">{{__('agent.Oil')}}</option>
                                                <option value="Solar Power">{{__('agent.Solar Power')}}</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Elevator')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="apartment_elevator" id="apartment_elevator">
                                                <option value="">{{__('user.Please Select')}}</option>
                                                <option value="No">{{__('agent.No')}}</option>
                                                <option value="yes">{{__('agent.yes')}}</option>)}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                {{--Type Villa--}}
                                <div class="d-none" id="type_villa" >
                                    
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Condition')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="villa_conditionp[]" multiple id="villa_conditionp">
                                                
                                                <option value="new">{{__('agent.new')}}</option>
                                                <option value="under construction">{{__('agent.under construction')}}</option>
                                                <option value="in planning">{{__('agent.in planning')}}</option>
                                                <option value="very good">{{__('agent.very good')}}</option>
                                                <option value="good">{{__('agent.good')}}</option>
                                                <option value="need of renovation">{{__('agent.need of renovation')}}</option>
                                                <option value="uninhabitable">{{__('agent.uninhabitable')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Villa m²')}} <span class="text-muted small">({{__('agent.gross')}})</span></h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-villa_grossm2 mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="text" class="min_villa_grossm2 p-2 rangeWidth" value="1" name="min_villa_grossm2"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="text"  class="max_villa_grossm2 p-2 rangeWidth" value="2.500" name="max_villa_grossm2"
                                                    placeholder="2500">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Land m²')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-villa_landm2 mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="text" min="0" class="min_villa_landm2 p-2 rangeWidth" value="1" name="min_villa_landm2"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="text"  class="max_villa_landm2 p-2 rangeWidth" value="25.000" name="max_villa_landm2"
                                                    placeholder="25000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Bedrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-villa_bed mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_villa_bed p-2 rangeWidth" value="1" name="min_villa_bed"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_villa_bed p-2 rangeWidth" value="20" name="max_villa_bed"
                                                    placeholder="20">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Bathrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-villa_bath mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_villa_bath p-2 rangeWidth" value="1" name="min_villa_bath"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_villa_bath p-2 rangeWidth" value="10" name="max_villa_bath"
                                                    placeholder="10">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Livingrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-villa_living mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_villa_living p-2 rangeWidth" value="1" name="min_villa_living"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_villa_living p-2 rangeWidth" value="10" name="max_villa_living"
                                                    placeholder="10">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Floor')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-villa_floors mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_villa_floors p-2 rangeWidth" value="1" name="min_villa_floors"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_villa_floors p-2 rangeWidth" value="10" name="max_villa_floors"
                                                    placeholder="10">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Age')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="villa_age[]" multiple id="villa_age">
                                                <option value="new">{{__('agent.new')}}</option>
                                                <option value="under construction">{{__('agent.under construction')}}</option>
                                                <option value="in planning">{{__('agent.in planning')}}</option>
                                                <option value="1 year old">{{__('agent.1 year old')}}</option>
                                                <option value="2 years old">{{__('agent.2 years old')}}</option>
                                                <option value="3 - 5 years old">{{__('agent.3 - 5 years old')}}</option>
                                                <option value="6 - 10 years old">{{__('agent.6 - 10 years old')}}</option>
                                                <option value="11 - 20 years old">{{__('agent.11 - 20 years old')}}</option>
                                                <option value="21 - 30 years old">{{__('agent.21 - 30 years old')}}</option>
                                                <option value="more than 31 years old">{{__('agent.more than 31 years old')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Garden')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="villa_garden" id="villa_garden">
                                                <option value="">{{__('user.Please Select')}}</option>
                                                <option value="No">{{__('agent.No')}}</option>
                                                <option value="yes">{{__('agent.yes')}}</option>)}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Elevator')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="villa_elevator" id="villa_elevator">
                                                
                                                <option value="No">{{__('agent.No')}}</option>
                                                <option value="yes">{{__('agent.yes')}}</option>)}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                {{--Type House--}}
                                <div class="d-none" id="type_house">
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Condition')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="house_conditionp[]" multiple id="house_conditionp">
                                                
                                                <option value="new">{{__('agent.new')}}</option>
                                                <option value="under construction">{{__('agent.under construction')}}</option>
                                                <option value="in planning">{{__('agent.in planning')}}</option>
                                                <option value="very good">{{__('agent.very good')}}</option>
                                                <option value="good">{{__('agent.good')}}</option>
                                                <option value="need of renovation">{{__('agent.need of renovation')}}</option>
                                                <option value="uninhabitable">{{__('agent.uninhabitable')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.House m²')}} <span class="text-muted small">({{__('agent.gross')}})</span></h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-house_grossm2 mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="text" min="0" class="min_house_grossm2 p-2 rangeWidth" value="1" name="min_house_grossm2"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="text"  class="max_house_grossm2 p-2 rangeWidth" value="2.500" name="max_house_grossm2"
                                                    placeholder="2.500">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Land m²')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-house_landm2 mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="text" min="0" class="min_house_landm2 p-2 rangeWidth" value="1" name="min_house_landm2"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="text"  class="max_house_landm2 p-2 rangeWidth" value="25.000" name="max_house_landm2"
                                                    placeholder="25.000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Bedrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-house_bed mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_house_bed p-2 rangeWidth" value="1" name="min_house_bed"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_house_bed p-2 rangeWidth" value="15" name="max_house_bed"
                                                    placeholder="15">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Bathrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-house_bath mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_house_bath p-2 rangeWidth" value="1" name="min_house_bath"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_house_bath p-2 rangeWidth" value="5" name="max_house_bath"
                                                    placeholder="5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Livingrooms')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-house_living mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_house_living p-2 rangeWidth" value="1" name="min_house_living"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_house_living p-2 rangeWidth" value="5" name="max_house_living"
                                                    placeholder="5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Floor')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-house_floors mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_house_floors p-2 rangeWidth" value="1" name="min_house_floors"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_house_floors p-2 rangeWidth" value="10" name="max_house_floors"
                                                    placeholder="10">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Age')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="house_age[]" multiple id="house_age">
                                                <option value="new">{{__('agent.new')}}</option>
                                                <option value="under construction">{{__('agent.under construction')}}</option>
                                                <option value="in planning">{{__('agent.in planning')}}</option>
                                                <option value="1 year old">{{__('agent.1 year old')}}</option>
                                                <option value="2 years old">{{__('agent.2 years old')}}</option>
                                                <option value="3 - 5 years old">{{__('agent.3 - 5 years old')}}</option>
                                                <option value="6 - 10 years old">{{__('agent.6 - 10 years old')}}</option>
                                                <option value="11 - 20 years old">{{__('agent.11 - 20 years old')}}</option>
                                                <option value="21 - 30 years old">{{__('agent.21 - 30 years old')}}</option>
                                                <option value="more than 31 years old">{{__('agent.more than 31 years old')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Garden')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="house_garden" id="house_garden">
                                                <option value="">{{__('user.Please Select')}}</option>
                                                <option value="No">{{__('agent.No')}}</option>
                                                <option value="yes">{{__('agent.yes')}}</option>)}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{--Building--}}
                                <div class="d-none" id="type_building">
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Condition')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="building_conditionp[]" multiple id="building_conditionp">
                                                
                                                <option value="new">{{__('agent.new')}}</option>
                                                <option value="under construction">{{__('agent.under construction')}}</option>
                                                <option value="in planning">{{__('agent.in planning')}}</option>
                                                <option value="very good">{{__('agent.very good')}}</option>
                                                <option value="good">{{__('agent.good')}}</option>
                                                <option value="need of renovation">{{__('agent.need of renovation')}}</option>
                                                <option value="uninhabitable">{{__('agent.uninhabitable')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Building m²')}} <span class="text-muted small">({{__('agent.gross')}})</span></h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-building_grossm2 mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="text" min="0" class="min_building_grossm2 p-2 rangeWidth" value="1" name="min_building_grossm2"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="text"  class="max_building_grossm2 p-2 rangeWidth" value="10000" name="max_building_grossm2"
                                                    placeholder="10000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Building Floors')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-building_floors mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_building_floors p-2 rangeWidth" value="1" name="min_building_floors"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_building_floors p-2 rangeWidth" value="70" name="max_building_floors"
                                                    placeholder="70">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Flats in Building')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-building_flats mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_building_flats p-2 rangeWidth" value="1" name="min_building_flats"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_building_flats p-2 rangeWidth" value="250" name="max_building_flats"
                                                    placeholder="250">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Shops in Building')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-building_shops mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="number" min="0" class="min_building_shops p-2 rangeWidth" value="1" name="min_building_shops"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="number"  class="max_building_shops p-2 rangeWidth" value="30" name="max_building_shops"
                                                    placeholder="30">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Age')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="building_age[]" multiple id="building_age">
                                                
                                                <option value="new">{{__('agent.new')}}</option>
                                                <option value="under construction">{{__('agent.under construction')}}</option>
                                                <option value="in planning">{{__('agent.in planning')}}</option>
                                                <option value="1 year old">{{__('agent.1 year old')}}</option>
                                                <option value="2 years old">{{__('agent.2 years old')}}</option>
                                                <option value="3 - 5 years old">{{__('agent.3 - 5 years old')}}</option>
                                                <option value="6 - 10 years old">{{__('agent.6 - 10 years old')}}</option>
                                                <option value="11 - 20 years old">{{__('agent.11 - 20 years old')}}</option>
                                                <option value="21 - 30 years old">{{__('agent.21 - 30 years old')}}</option>
                                                <option value="more than 31 years old">{{__('agent.more than 31 years old')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Elevator')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="building_elevator" id="building_elevator">
                                                <option value="">{{__('user.Please Select')}}</option>
                                                <option value="No">{{__('agent.No')}}</option>
                                                <option value="yes">{{__('agent.yes')}}</option>)}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{--Land--}}
                                <div class="d-none" id="type_land">
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Type of land')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="land_type[]" multiple id="land_type">
                                                
                                                <option value="Building land – Building">{{__('agent.Building land – Building')}}</option>
                                                <option value="Building land – Villa">{{__('agent.Building land – Villa')}}</option>
                                                <option value="Building land – Commercial">{{__('agent.Building land – Commercial')}}</option>
                                                <option value="Building land – Tourism">{{__('agent.Building land – Tourism')}}</option>
                                                <option value="Field">{{__('agent.Field')}}</option>
                                                <option value="Garden">{{__('agent.Garden')}}</option>
                                                <option value="Olive tree field">{{__('agent.Olive tree field')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Land m²')}} </h6>
                                        <!-- Range Slider Desktop Version -->
                                        <div class="range-slider-style1">
                                            <div class="range-wrapper">
                                                <div class="slider-range slider-range-land_grossm2 mt30 mb20"></div>
                                                <div class="d-flex align-items-center gap-3 justify-content-between">
                                                    <input type="text" min="0" class="min_land_grossm2 p-2 rangeWidth" value="1" name="min_land_grossm2"
                                                    placeholder="1">
                                                    <span class="fa-sharp fa-solid fa-minus dark-color"></span>
                                                    <input type="text" class="max_land_grossm2 p-2 rangeWidth" value="100.000.000" name="max_land_grossm2"
                                                    placeholder="100.000.000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('agent.Status')}}</h6>
                                        <div class="form-style2 input-group">
                                            <select class="selectpicker" title="{{__('user.Please Select')}}" name="land_status[]" multiple id="land_status">
                                                
                                                <option value="partly rented">{{__('agent.partly rented')}}</option>
                                                <option value="full rented">{{__('agent.full rented')}}</option>
                                                <option value="used by owner">{{__('agent.used by owner')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="append_features" class="d-none">
                                    <h6 class="list-title mb-3">{{__('user.Features')}}</h6>
                                    <div id="append_features_listing">
                                        
                                    </div>
                                </div>
                                
                                <div>
                                    <h6 class="list-title mb-3">{{__('user.Whats Nearby?')}}</h6>
                                    @foreach ($locations as $location)
                                    <?php
                                    if($location->show_in_filters != 'true'){
                                        continue;
                                    }
                                    ?>
                                    <div class="widget-wrapper advance-feature-modal mb-3">
                                        <h6 class="list-title">{{__('user.Distance to the')}} {{$location->location_details[0]->title ?? ''}}</h6>
                                        <?php
                                        $options=explode('-',$location->location_details[0]->answer ?? '');
                                        $options_values=explode('-',$location->location_details_en[0]->answer ?? '');
                                        ?>
                                        <div class="form-style2 input-group">
                                            <select  class="selectpicker" multiple title="{{__('user.Please Select')}}" id="location_ids_with_values" name="location_ids_with_values[]" data-width="100%">
                                                @foreach($options as $key=>$feature)
                                                <option value="{{ $location->id .'-'. $options_values[$key] }}">{{ $feature }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            
                            <div class="widget-wrapper">
                                <div class="btn-area d-grid align-items-center">
                                    <button type="submit" class="ud-btn btn-thm"><span
                                        class="flaticon-search align-text-top pr10"></span>{{__('user.Search')}}
                                    </button>
                                </div>
                            </div>
                            <div class="reset-area d-flex align-items-center justify-content-between">
                                <a class="reset-button" href="{{route('properties')}}"><span
                                    class="flaticon-turn-back"></span>
                                    <u>{{__('user.Reset all filters')}}</u>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        <div class="col-lg-8">
            <div class="row align-items-center mb20">
                <div class="col-sm-6">
                    <div class="text-center text-sm-start">
                        <p class="pagination_page_count mb-0">{{__('user.Showing')}} {{ $properties->firstItem() }}
                            – {{ $properties->lastItem() }} of {{ $properties->total() }}
                            {{__('user.results')}}</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="page_control_shorting d-flex align-items-center justify-content-center justify-content-sm-end">
                            <div class="pcs_dropdown pr10"><span>{{__('user.Sort by')}}</span>
                                
                                <!-- Sort By Select -->
                                <select class="selectpicker show-tick" id="sort_by">
                                    <option {{$sort_by_search == 0 ? "selected" : ""}} value="0">{{__('user.Newest')}}</option>
                                    <option {{$sort_by_search == 1 ? "selected" : ""}} value="1">{{__('user.Oldest')}}</option>
                                    <option {{$sort_by_search == 2 ? "selected" : ""}} value="2">{{__('user.Price(Low)')}}</option>
                                    <option {{$sort_by_search == 3 ? "selected" : ""}} value="3">{{__('user.Price(High)')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt15">
                    @if($agent)
                    <h4 class="mb-4">{{__('user.All properties of')}} {{$agent->fname}} {{$agent->lname}}</h4>
                    @endif
                    @foreach($properties as $property)
                    <div class="col-lg-12">
                        <div class="listing-style1 listing-type" data-property-id="{{ $property->id }}">
                            <div class="list-thumb flex-shrink-0">
                                <a class="text-center" href="{{route('property_details',['slug' => $property->slug])}}">
                                    <img style="min-height: 220px"
                                    src="{{$property->preview_image !='' ? asset($property->preview_image) :asset('agent/images/placeholder.png') }}"
                                    alt="">
                                    @if($property->highlight == 'true')
                                    <div class="list-tag fz12"><span
                                        class="flaticon-electricity me-2"></span>FEATURED
                                    </div>
                                    @endif
                                </a>
                                
                            </div>
                            <div class="list-content flex-grow-2 d-flex flex-column justify-content-between py-3">
                                <div>
                                    <div class="d-flex align-items-start justify-content-between flex-row gap-2 ">
                                        <a href="{{route('property_details',['slug' => $property->slug])}}">
                                            <div>
                                                <div class="h5 mb-1">{{getCurrency($property->price_in_usd,$property->currency_id,$property->price)}}</div>
                                                <h6 class="list-title fixed-title"> {{compiledText('title',$property->property_type_id,$property->id)}} </h6>
                                                <p class="list-text">{{$property->property_city->title}}
                                                    / {{$property->property_town->title}}
                                                    / {{$property->property_district->title}}
                                                </p>
                                            </div>
                                        </a>
                                        
                                    </div>
                                    
                                    
                                    @if($property->property_type_id == 1)
                                    <div class=" d-flex align-items-center justify-content-start gap-3 listIconsStyle">
                                        <a class="d-flex gap-2 align-items-center  m-0"><img
                                            src="{{asset('agent/images/icon/bed.svg')}}"> {{$property->apartment_attribute->bed_rooms ?? ''}}
                                        </a>
                                        <a class="d-flex gap-2 align-items-center  m-0"><img
                                            src="{{asset('agent/images/icon/couch.svg')}}"> {{$property->apartment_attribute->living_rooms ?? ''}}
                                        </a>
                                        <a class="d-flex gap-2 align-items-center  m-0"><img
                                            src="{{asset('agent/images/icon/bathroom.svg')}}"> {{$property->apartment_attribute->bath_rooms ?? ''}}
                                        </a>
                                        <a class="d-flex gap-2 align-items-center  m-0"><img
                                            src="{{asset('agent/images/icon/floor.svg')}}"> {{ getFloorLabel($property->apartment_attribute->floors ?? '') . ($property->apartment_attribute->floors ? ' Floor' : '') }}
                                            
                                        </a>
                                        
                                    </div>
                                    @elseif($property->property_type_id == 2)
                                    <div class="list-meta d-flex align-items-center justify-content-start gap-3">
                                        <a class="d-flex gap-2 align-items-center m-0" ><img
                                            src="{{asset('agent/images/icon/bed.svg')}}"> {{$property->villa_attribute->bed_rooms ?? ''}}
                                        </a>
                                        <a class="d-flex gap-2 align-items-center m-0" ><img
                                            src="{{asset('agent/images/icon/couch.svg')}}"> {{$property->villa_attribute->living_rooms ?? ''}}
                                        </a>
                                        
                                        <a class="d-flex gap-2 align-items-center m-0" ><img
                                            src="{{asset('agent/images/icon/bathroom.svg')}}"> {{$property->villa_attribute->bath_rooms ?? ''}}
                                        </a>
                                        <a class="d-flex gap-2 align-items-center m-0" ><img
                                            src="{{asset('agent/images/icon/floor.svg')}}"> {{$property->villa_attribute->floors ?? ''}}
                                        </a>
                                    </div>
                                    @elseif($property->property_type_id == 3)
                                    <div class="list-meta d-flex align-items-center justify-content-start gap-3">
                                        <a class="d-flex gap-2 align-items-center m-0" ><img
                                            src="{{asset('agent/images/icon/bed.svg')}}"> {{$property->house_attribute->bed_rooms ?? ''}}
                                        </a>
                                        <a class="d-flex gap-2 align-items-center m-0" ><img
                                            src="{{asset('agent/images/icon/couch.svg')}}"> {{$property->house_attribute->living_rooms ?? ''}}
                                        </a>
                                        
                                        <a class="d-flex gap-2 align-items-center m-0" ><img
                                            src="{{asset('agent/images/icon/bathroom.svg')}}"> {{$property->house_attribute->bath_rooms ?? ''}}
                                        </a>
                                        <a class="d-flex gap-2 align-items-center m-0" ><img
                                            src="{{asset('agent/images/icon/floor.svg')}}"> {{$property->house_attribute->floors ?? ''}}
                                        </a>
                                    </div>
                                    @elseif($property->property_type_id == 4)
                                    <div class="list-meta d-flex align-items-center justify-content-start gap-3">
                                        {{--                                                    <a class="d-flex gap-2 align-items-center m-0" href="#"><img--}}
                                            {{--                                                            src="{{asset('agent/images/icon/length.svg')}}"> {{$property->building_attribute->grossm2 ?? ''}}--}}
                                            {{--                                                    </a>--}}
                                            <a class="d-flex gap-2 align-items-center m-0" ><img
                                                src="{{asset('agent/images/icon/floor.svg')}}"> {{$property->building_attribute->floors ?? ''}}
                                            </a>
                                            <a class="d-flex gap-2 align-items-center m-0" ><img
                                                src="{{asset('agent/images/icon/age.svg')}}"> {{$property->building_attribute->age ?? ''}}
                                            </a>
                                        </div>
                                        @elseif($property->property_type_id == 5)
                                        <div class="list-meta d-flex align-items-center justify-content-start gap-3 d-none">
                                            <a class="d-flex gap-2 align-items-center m-0" ><img
                                                src="{{asset('agent/images/icon/length.svg')}}"> {{$property->land_attribute->landm2 ?? ''}}
                                            </a>
                                            {{--                                                    <a class="d-flex gap-2 align-items-center m-0" href="#"><img--}}
                                                {{--                                                            src="{{asset('agent/images/icon/price.svg')}}"> {{$property->land_attribute->pricem2 ?? ''}}--}}
                                                {{--                                                    </a>--}}
                                            </div>
                                            @endif
                                            
                                        </div>
                                        <div>
                                            <hr class="mt-2 mb-2 w-100 ">
                                            <div class="list-text2 d-flex align-items-end gap-2 justify-content-between">
                                                <div class="d-flex align-items-end gap-2 d-none">
                                                    <span class="flaticon-user"></span>
                                                    <span>{{$property->property_agent->fname }} {{$property->property_agent->lname }}</span>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between text-end gap-2 w-100">
                                                    <a onclick="toggleFavorite(`{{$property->id}}`)"  id="favoriteIcon{{$property->id}}">
                                                        <span id="heartIcon{{$property->id}}" class="fa-light fs-6 fa-heart"></span>
                                                    </a>
                                                    <a>
                                                        <i class="far  fs-6 fa-calendar"></i>
                                                        <span>{{date('d-m-Y',strtotime($property->create_date))}}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        <div class="row">
                            <div class="mbp_pagination text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection
        @section('script')
        <script>
            // Basic form submission handler
            $('#search_form').on('submit', function(e) {
                e.preventDefault();
                
                // Clean price values
                let minPrice = cleanNumber($('#min_price').val());
                let maxPrice = cleanNumber($('#max_price').val());
                
                $('#min_price').val(minPrice);
                $('#max_price').val(maxPrice);
                
                // Set type_id_index from property type select
                let selectedType = $("#property_type_listing").val();
                $("input[name='type_id_index']").val(selectedType);
                
                this.submit();
            });

            function cleanNumber(value) {
                return value.replace(/[.,]/g, '');
            }

            // Handle sort changes
            $("#sort_by").change(function (e) {
                let sort_by = $("#sort_by option:selected").val();
                $("#set_sort_by").val(sort_by);
                $("#search_form").submit();
            });

            // CSRF setup for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Mobile filter button handler
            $(".mobile-filter-btn-new").click(function(){
                $(".positioninMobile").toggleClass("positioninMobileShow");
            });
        </script>
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
        @endsection
