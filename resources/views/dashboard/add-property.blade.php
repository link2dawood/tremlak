@extends('dashboard.layouts.master')
@section('pageTitle',__('user.add new property'))
@section('content')
<style>
    .editor-container {
        position: relative;
        min-height: 400px;
    }
    
    .editor-content {
        height: 400px !important;
        padding: 10px;
        overflow-y: auto;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    
    .editor-toolbar {
        padding: 5px;
        background: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        margin-bottom: 10px;
    }
    
    .editor-toolbar button {
        margin: 0 2px;
    }
    .editor-toolbar select {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.25rem 0.5rem;
        margin: 0 2px;
        font-size: 0.875rem;
    }
    
    .editor-toolbar select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    
    .editor-toolbar select option {
        padding: 4px 8px;
    }
    .thumbnail-options img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 4px;
    }
    
    .thumbnail-options img.selected {
        border-color: #007bff;
    }
    
    .img-container {
        max-height: 500px;
        overflow: hidden;
    }
    
    .img-container img {
        max-width: 100%;
        height: auto;
    }
    
    .cropper-container {
        max-height: 500px !important;
    }
</style>
<div class="dashboard__content property-page bgc-f7">
    <div class="row align-items-center pb40">
        <div class="col-lg-12">
            <div class=" d-flex justify-content-between dashboard_title_area">
                <div class="col-lg-4">
                    <h2>{{__('user.add new property')}}</h2>
                    <p class="text">{{__('agent.We are glad to see you again!')}}</p>
                </div>
                
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between statistics_funfact py-3">
                        <div class="details">
                            <div class="text fz25">{{__('agent.Available Credits')}}</div>
                            <div class="title">{{number_format(Auth::user()->balance)}}</div>
                        </div>
                        <div class="icon text-center"><i class="fa fa-money-check"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div style="min-height: 500px" class="ps-widget bgc-white bdrs12 default-box-shadow2 pt30 mb30 overflow-hidden position-relative">
                <div class="navtab-style1">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">1. {{__('agent.Type')}}</button>
                            <button class="nav-link" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">2. {{__('Description')}}</button>
                            <button class="nav-link" id="nav-item3-tab" data-bs-toggle="tab" data-bs-target="#nav-item3" type="button" role="tab" aria-controls="nav-item3" aria-selected="false">3. {{__('agent.Media')}}</button>
                            <button class="nav-link fw600" id="nav-item4-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-item4" type="button" role="tab" aria-controls="nav-item4"
                            aria-selected="false">4. {{__('agent.Location')}}</button>
                            <button class="nav-link fw600" id="nav-item5-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-item5" type="button" role="tab" aria-controls="nav-item5"
                            aria-selected="false">5. {{__('user.Price')}}</button>
                            <button class="nav-link fw600" id="nav-item6-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-item6" type="button" role="tab" aria-controls="nav-item6"
                            aria-selected="false">6. {{__('agent.Features')}}</button>
                            <button class="nav-link fw600" id="nav-item7-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-item7" type="button" role="tab" aria-controls="nav-item7"
                            aria-selected="false">7. {{__('agent.Payment')}}</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <input type="hidden" value="" id="property_id">
                        <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                            <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                                <h4 class="title fz17 mb30">{{__('agent.Property Type')}}</h4>
                                <div class="row">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="mb10">
                                                <label class="heading-color ff-heading fw600 mb10">{{__('agent.Select Type')}}</label>
                                                <i class="fw-bold fa fa-asterisk text-danger"></i>
                                                <div class="location-area min-height-tab-two">
                                                    <select class="form-select form-control-lg" id="property_type">
                                                        <option value="">---{{__('agent.Please Select')}}---</option>
                                                        @foreach($propertyType_global as $type)
                                                        <option
                                                        value="{{$type->id}}">{{$type->property_type_details[0]->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb10 d-none" id="description_text">
                                                <div class="location-area min-height-tab-two rounded p-3 fw-semibold bg_new_color">
                                                    <h5>{{__('user.description_text')}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Type Apartment--}}
                                    <div class="d-none" id="type_apartment">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Type of apartment')}}
                                                        <i class="fw-bold fa fa-asterisk text-danger"></i>
                                                    </label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_type">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="Studio">{{__('agent.Studio')}}</option>
                                                            <option value="Flat">{{__('agent.Flat')}}</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Condition')}}
                                                        <i class="fw-bold fa fa-asterisk text-danger"></i>
                                                    </label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_conditionp">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">
                                                        {{__('agent.Gross m²')}} <i class="fw-bold fa fa-asterisk text-danger"></i>
                                                    </label>
                                                    <input type="number" id="apartment_grossm2" class="form-control py-3" placeholder="Enter the gross amount">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">
                                                        {{__('agent.Net m²')}} <i class="fw-bold fa fa-asterisk text-danger"></i>
                                                    </label>
                                                    <input type="number" id="apartment_netm2" class="form-control" placeholder="Enter the net amount">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Bedrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_bed_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                            <option value="11">{{__('agent.11')}}</option>
                                                            <option value="12">{{__('agent.12')}}</option>
                                                            <option value="13">{{__('agent.13')}}</option>
                                                            <option value="14">{{__('agent.14')}}</option>
                                                            <option value="15">{{__('agent.15')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Livingrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_living_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Bathrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_bath_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Age')}}
                                                        <i class="fw-bold fa fa-asterisk text-danger"></i>
                                                    </label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_age">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Status')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_status">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="empty">{{__('agent.empty')}}</option>
                                                            <option value="rented">{{__('agent.rented')}}</option>
                                                            <option value="occupied by owner">{{__('agent.occupied by owner')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Floor')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_floors">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="-1">{{__('agent.Basement')}}</option>
                                                            <option value="0">{{__('agent.Ground')}}</option>
                                                            <option value="1">{{__('1st Floor')}}</option>
                                                            <option value="2">{{__('agent.2nd Floor')}}</option>
                                                            <option value="3">{{__('agent.3rd Floor')}}</option>
                                                            <option value="4">{{__('agent.4th Floor')}}</option>
                                                            <option value="5">{{__('agent.5th Floor')}}</option>
                                                            <option value="6">{{__('agent.6th Floor')}}</option>
                                                            <option value="7">{{__('agent.7th Floor')}}</option>
                                                            <option value="8">{{__('agent.8th Floor')}}</option>
                                                            <option value="9">{{__('agent.9th Floor')}}</option>
                                                            <option value="10">{{__('agent.10th Floor')}}</option>
                                                            <option value="11">{{__('agent.11th Floor')}}</option>
                                                            <option value="12">{{__('agent.12th Floor')}}</option>
                                                            <option value="13">{{__('agent.13th Floor')}}</option>
                                                            <option value="14">{{__('agent.14th Floor')}}</option>
                                                            <option value="15">{{__('agent.15th Floor')}}</option>
                                                            <option value="16">{{__('agent.16th Floor')}}</option>
                                                            <option value="17">{{__('agent.17th Floor')}}</option>
                                                            <option value="18">{{__('agent.18th Floor')}}</option>
                                                            <option value="19">{{__('agent.19th Floor')}}</option>
                                                            <option value="20">{{__('agent.20th Floor')}}</option>
                                                            <option value="21">{{__('agent.21th Floor')}}</option>
                                                            <option value="22">{{__('agent.22th Floor')}}</option>
                                                            <option value="23">{{__('agent.23th Floor')}}</option>
                                                            <option value="24">{{__('agent.24th Floor')}}</option>
                                                            <option value="25">{{__('agent.25th Floor')}}</option>
                                                            <option value="26">{{__('agent.26th Floor')}}</option>
                                                            <option value="27">{{__('agent.27th Floor')}}</option>
                                                            <option value="28">{{__('agent.28th Floor')}}</option>
                                                            <option value="29">{{__('agent.29th Floor')}}</option>
                                                            <option value="30">{{__('agent.30th Floor')}}</option>
                                                            <option value="31">{{__('agent.31th Floor')}}</option>
                                                            <option value="32">{{__('agent.32th Floor')}}</option>
                                                            <option value="33">{{__('agent.33th Floor')}}</option>
                                                            <option value="34">{{__('agent.34th Floor')}}</option>
                                                            <option value="35">{{__('agent.35th Floor')}}</option>
                                                            <option value="36">{{__('agent.36th Floor')}}</option>
                                                            <option value="37">{{__('agent.37th Floor')}}</option>
                                                            <option value="38">{{__('agent.38th Floor')}}</option>
                                                            <option value="39">{{__('agent.39th Floor')}}</option>
                                                            <option value="40">{{__('agent.40th Floor')}}</option>
                                                            <option value="41">{{__('agent.41th Floor')}}</option>
                                                            <option value="42">{{__('agent.42th Floor')}}</option>
                                                            <option value="43">{{__('agent.43th Floor')}}</option>
                                                            <option value="44">{{__('agent.44th Floor')}}</option>
                                                            <option value="45">{{__('agent.45th Floor')}}</option>
                                                            <option value="46">{{__('agent.46th Floor')}}</option>
                                                            <option value="47">{{__('agent.47th Floor')}}</option>
                                                            <option value="48">{{__('agent.48th Floor')}}</option>
                                                            <option value="49">{{__('agent.49th Floor')}}</option>
                                                            <option value="50">{{__('agent.50th Floor')}}</option>
                                                            <option value="51">{{__('agent.51th Floor')}}</option>
                                                            <option value="52">{{__('agent.52th Floor')}}</option>
                                                            <option value="53">{{__('agent.53th Floor')}}</option>
                                                            <option value="54">{{__('agent.54th Floor')}}</option>
                                                            <option value="55">{{__('agent.55th Floor')}}</option>
                                                            <option value="56">{{__('agent.56th Floor')}}</option>
                                                            <option value="57">{{__('agent.57th Floor')}}</option>
                                                            <option value="58">{{__('agent.58th Floor')}}</option>
                                                            <option value="59">{{__('agent.59th Floor')}}</option>
                                                            <option value="60">{{__('agent.60th Floor')}}</option>
                                                            <option value="61">{{__('agent.61th Floor')}}</option>
                                                            <option value="62">{{__('agent.62th Floor')}}</option>
                                                            <option value="63">{{__('agent.63th Floor')}}</option>
                                                            <option value="64">{{__('agent.64th Floor')}}</option>
                                                            <option value="65">{{__('agent.65th Floor')}}</option>
                                                            <option value="66">{{__('agent.66th Floor')}}</option>
                                                            <option value="67">{{__('agent.67th Floor')}}</option>
                                                            <option value="68">{{__('agent.68th Floor')}}</option>
                                                            <option value="69">{{__('agent.69th Floor')}}</option>
                                                            <option value="70">{{__('agent.70th Floor')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Building-Floors')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_building_floors">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="1">{{__('agent.1 Floor')}}</option>
                                                            <option value="2">{{__('agent.2 Floors')}}</option>
                                                            <option value="3">{{__('agent.3 Floors')}}</option>
                                                            <option value="4">{{__('agent.4 Floors')}}</option>
                                                            <option value="5">{{__('agent.5 Floors')}}</option>
                                                            <option value="6">{{__('agent.6 Floors')}}</option>
                                                            <option value="7">{{__('agent.7 Floors')}}</option>
                                                            <option value="8">{{__('agent.8 Floors')}}</option>
                                                            <option value="9">{{__('agent.9 Floors')}}</option>
                                                            <option value="10">{{__('agent.10 Floors')}}</option>
                                                            <option value="11">{{__('agent.11 Floors')}}</option>
                                                            <option value="12">{{__('agent.12 Floors')}}</option>
                                                            <option value="13">{{__('agent.13 Floors')}}</option>
                                                            <option value="14">{{__('agent.14 Floors')}}</option>
                                                            <option value="15">{{__('agent.15 Floors')}}</option>
                                                            <option value="16">{{__('agent.16 Floors')}}</option>
                                                            <option value="17">{{__('agent.17 Floors')}}</option>
                                                            <option value="18">{{__('agent.18 Floors')}}</option>
                                                            <option value="19">{{__('agent.19 Floors')}}</option>
                                                            <option value="20">{{__('agent.20 Floors')}}</option>
                                                            <option value="21">{{__('agent.21 Floors')}}</option>
                                                            <option value="22">{{__('agent.22 Floors')}}</option>
                                                            <option value="23">{{__('agent.23 Floors')}}</option>
                                                            <option value="24">{{__('agent.24 Floors')}}</option>
                                                            <option value="25">{{__('agent.25 Floors')}}</option>
                                                            <option value="26">{{__('agent.26 Floors')}}</option>
                                                            <option value="27">{{__('agent.27 Floors')}}</option>
                                                            <option value="28">{{__('agent.28 Floors')}}</option>
                                                            <option value="29">{{__('agent.29 Floors')}}</option>
                                                            <option value="30">{{__('agent.30 Floors')}}</option>
                                                            <option value="31">{{__('agent.31 Floors')}}</option>
                                                            <option value="32">{{__('agent.32 Floors')}}</option>
                                                            <option value="33">{{__('agent.33 Floors')}}</option>
                                                            <option value="34">{{__('agent.34 Floors')}}</option>
                                                            <option value="35">{{__('agent.35 Floors')}}</option>
                                                            <option value="36">{{__('agent.36 Floors')}}</option>
                                                            <option value="37">{{__('agent.37 Floors')}}</option>
                                                            <option value="38">{{__('agent.38 Floors')}}</option>
                                                            <option value="39">{{__('agent.39 Floors')}}</option>
                                                            <option value="40">{{__('agent.40 Floors')}}</option>
                                                            <option value="41">{{__('agent.41 Floors')}}</option>
                                                            <option value="42">{{__('agent.42 Floors')}}</option>
                                                            <option value="43">{{__('agent.43 Floors')}}</option>
                                                            <option value="44">{{__('agent.44 Floors')}}</option>
                                                            <option value="45">{{__('agent.45 Floors')}}</option>
                                                            <option value="46">{{__('agent.46 Floors')}}</option>
                                                            <option value="47">{{__('agent.47 Floors')}}</option>
                                                            <option value="48">{{__('agent.48 Floors')}}</option>
                                                            <option value="49">{{__('agent.49 Floors')}}</option>
                                                            <option value="50">{{__('agent.50 Floors')}}</option>
                                                            <option value="51">{{__('agent.51 Floors')}}</option>
                                                            <option value="52">{{__('agent.52 Floors')}}</option>
                                                            <option value="53">{{__('agent.53 Floors')}}</option>
                                                            <option value="54">{{__('agent.54 Floors')}}</option>
                                                            <option value="55">{{__('agent.55 Floors')}}</option>
                                                            <option value="56">{{__('agent.56 Floors')}}</option>
                                                            <option value="57">{{__('agent.57 Floors')}}</option>
                                                            <option value="58">{{__('agent.58 Floors')}}</option>
                                                            <option value="59">{{__('agent.59 Floors')}}</option>
                                                            <option value="60">{{__('agent.60 Floors')}}</option>
                                                            <option value="61">{{__('agent.61 Floors')}}</option>
                                                            <option value="62">{{__('agent.62 Floors')}}</option>
                                                            <option value="63">{{__('agent.63 Floors')}}</option>
                                                            <option value="64">{{__('agent.64 Floors')}}</option>
                                                            <option value="65">{{__('agent.65 Floors')}}</option>
                                                            <option value="66">{{__('agent.66 Floors')}}</option>
                                                            <option value="67">{{__('agent.67 Floors')}}</option>
                                                            <option value="68">{{__('agent.68 Floors')}}</option>
                                                            <option value="69">{{__('agent.69 Floors')}}</option>
                                                            <option value="70">{{__('agent.70 Floors')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Heating')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_heating">
                                                            <option selected>---Please Select---</option>
                                                            <option value="None">{{__('agent.None')}}</option>
                                                            <option
                                                            value="Air Conditioner">{{__('agent.Air Conditioner')}}</option>
                                                            <option
                                                            value="Natural Gas">{{__('agent.Natural Gas')}}</option>
                                                            <option
                                                            value="Electric">{{__('agent.Electric')}}</option>
                                                            <option value="Coal">{{__('agent.Coal')}}</option>
                                                            <option value="Oil">{{__('agent.Oil')}}</option>
                                                            <option
                                                            value="Solar Power">{{__('agent.Solar Power')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Elevator')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="apartment_elevator">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="No">{{__('agent.No')}}</option>
                                                            <option value="yes">{{__('agent.yes')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Type Villa--}}
                                    <div class="d-none" id="type_villa">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Condition')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="villa_conditionp">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Villa m² gross')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <input type="number" id="villa_grossm2"class="form-control py-3" placeholder="Enter the villa gross amount">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label
                                                    class="heading-color ff-heading fw600 mb10">{{__('agent.Villa m² net')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <input type="number" id="villa_netm2" class="form-control"
                                                    placeholder="Enter the villa net amount">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Land m²')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <input type="number" id="villa_landm2" class="form-control" placeholder="Enter the Land amount">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Bedrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="villa_bed_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                            <option value="11">{{__('agent.11')}}</option>
                                                            <option value="12">{{__('agent.12')}}</option>
                                                            <option value="13">{{__('agent.13')}}</option>
                                                            <option value="14">{{__('agent.14')}}</option>
                                                            <option value="15">{{__('agent.15')}}</option>
                                                            <option value="16">{{__('agent.16')}}</option>
                                                            <option value="17">{{__('agent.17')}}</option>
                                                            <option value="18">{{__('agent.18')}}</option>
                                                            <option value="19">{{__('agent.19')}}</option>
                                                            <option value="20">{{__('agent.20')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{('agent.Livingrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="villa_living_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Bathrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="villa_bath_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Floor')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="villa_floors">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Age')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="villa_age">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Garden')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="villa_garden">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="No">{{__('agent.No')}}</option>
                                                            <option value="yes">{{__('agent.yes')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Elevator')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="villa_elevator">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="No">{{__('agent.No')}}</option>
                                                            <option value="yes">{{__('agent.yes')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Type House--}}
                                    <div class="d-none" id="type_house">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Condition')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="house_conditionp">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.House m² gross')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <input type="number" id="house_grossm2" class="form-control py-3" placeholder="Enter the house gross amount">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.House m² net')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <input type="number" id="house_netm2" class="form-control" placeholder="Enter the house net amount">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Land m²')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <input type="number" id="house_landm2" class="form-control"
                                                    placeholder="Enter the Land amount">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Bedrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="house_bed_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                            <option value="11">{{__('agent.11')}}</option>
                                                            <option value="12">{{__('agent.12')}}</option>
                                                            <option value="13">{{__('agent.13')}}</option>
                                                            <option value="14">{{__('agent.14')}}</option>
                                                            <option value="15">{{__('agent.15')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Livingrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="house_living_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Bathrooms')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="house_bath_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Floor')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="house_floors">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Age')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="house_age">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Garden')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="house_garden">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="No">{{__('agent.No')}}</option>
                                                            <option value="yes">{{__('agent.yes')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Building--}}
                                    <div class="d-none" id="type_building">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Condition')}} <i class="fw-bold fa fa-asterisk text-danger"></i> </label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="building_conditionp">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Building m² gross')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <input type="number" id="building_grossm2" class="form-control py-3" placeholder="Please enter the amount">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Floor')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="building_floors">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                            <option value="11">{{__('agent.11')}}</option>
                                                            <option value="12">{{__('agent.12')}}</option>
                                                            <option value="13">{{__('agent.13')}}</option>
                                                            <option value="14">{{__('agent.14')}}</option>
                                                            <option value="15">{{__('agent.15')}}</option>
                                                            <option value="16">{{__('agent.16')}}</option>
                                                            <option value="17">{{__('agent.17')}}</option>
                                                            <option value="18">{{__('agent.18')}}</option>
                                                            <option value="19">{{__('agent.19')}}</option>
                                                            <option value="20">{{__('agent.20')}}</option>
                                                            <option value="21">{{__('agent.21')}}</option>
                                                            <option value="22">{{__('agent.22')}}</option>
                                                            <option value="23">{{__('agent.23')}}</option>
                                                            <option value="24">{{__('agent.24')}}</option>
                                                            <option value="25">{{__('agent.25')}}</option>
                                                            <option value="26">{{__('agent.26')}}</option>
                                                            <option value="27">{{__('agent.27')}}</option>
                                                            <option value="28">{{__('agent.28')}}</option>
                                                            <option value="29">{{__('agent.29')}}</option>
                                                            <option value="30">{{__('agent.30')}}</option>
                                                            <option value="31">{{__('agent.31')}}</option>
                                                            <option value="32">{{__('agent.32')}}</option>
                                                            <option value="33">{{__('agent.33')}}</option>
                                                            <option value="34">{{__('agent.34')}}</option>
                                                            <option value="35">{{__('agent.35')}}</option>
                                                            <option value="36">{{__('agent.36')}}</option>
                                                            <option value="37">{{__('agent.37')}}</option>
                                                            <option value="38">{{__('agent.38')}}</option>
                                                            <option value="39">{{__('agent.39')}}</option>
                                                            <option value="40">{{__('agent.40')}}</option>
                                                            <option value="41">{{__('agent.41')}}</option>
                                                            <option value="42">{{__('agent.42')}}</option>
                                                            <option value="43">{{__('agent.43')}}</option>
                                                            <option value="44">{{__('agent.44')}}</option>
                                                            <option value="45">{{__('agent.45')}}</option>
                                                            <option value="46">{{__('agent.46')}}</option>
                                                            <option value="47">{{__('agent.47')}}</option>
                                                            <option value="48">{{__('agent.48')}}</option>
                                                            <option value="49">{{__('agent.49')}}</option>
                                                            <option value="50">{{__('agent.50')}}</option>
                                                            <option value="51">{{__('agent.51')}}</option>
                                                            <option value="52">{{__('agent.52')}}</option>
                                                            <option value="53">{{__('agent.53')}}</option>
                                                            <option value="54">{{__('agent.54')}}</option>
                                                            <option value="55">{{__('agent.55')}}</option>
                                                            <option value="56">{{__('agent.56')}}</option>
                                                            <option value="57">{{__('agent.57')}}</option>
                                                            <option value="58">{{__('agent.58')}}</option>
                                                            <option value="59">{{__('agent.59')}}</option>
                                                            <option value="60">{{__('agent.60')}}</option>
                                                            <option value="61">{{__('agent.61')}}</option>
                                                            <option value="62">{{__('agent.62')}}</option>
                                                            <option value="63">{{__('agent.63')}}</option>
                                                            <option value="64">{{__('agent.64')}}</option>
                                                            <option value="65">{{__('agent.65')}}</option>
                                                            <option value="66">{{__('agent.66')}}</option>
                                                            <option value="67">{{__('agent.67')}}</option>
                                                            <option value="68">{{__('agent.68')}}</option>
                                                            <option value="69">{{__('agent.69')}}</option>
                                                            <option value="70">{{__('agent.70')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Shops in Building')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="building_shops">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                            <option value="11">{{__('agent.11')}}</option>
                                                            <option value="12">{{__('agent.12')}}</option>
                                                            <option value="13">{{__('agent.13')}}</option>
                                                            <option value="14">{{__('agent.14')}}</option>
                                                            <option value="15">{{__('agent.15')}}</option>
                                                            <option value="16">{{__('agent.16')}}</option>
                                                            <option value="17">{{__('agent.17')}}</option>
                                                            <option value="18">{{__('agent.18')}}</option>
                                                            <option value="19">{{__('agent.19')}}</option>
                                                            <option value="20">{{__('agent.20')}}</option>
                                                            <option value="21">{{__('agent.21')}}</option>
                                                            <option value="22">{{__('agent.22')}}</option>
                                                            <option value="23">{{__('agent.23')}}</option>
                                                            <option value="24">{{__('agent.24')}}</option>
                                                            <option value="25">{{__('agent.25')}}</option>
                                                            <option value="26">{{__('agent.26')}}</option>
                                                            <option value="27">{{__('agent.27')}}</option>
                                                            <option value="28">{{__('agent.28')}}</option>
                                                            <option value="29">{{__('agent.29')}}</option>
                                                            <option value="30">{{__('agent.30')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Storage Rooms in Building')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="building_storage_rooms">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                            <option value="11">{{__('agent.11')}}</option>
                                                            <option value="12">{{__('agent.12')}}</option>
                                                            <option value="13">{{__('agent.13')}}</option>
                                                            <option value="14">{{__('agent.14')}}</option>
                                                            <option value="15">{{__('agent.15')}}</option>
                                                            <option value="16">{{__('agent.16')}}</option>
                                                            <option value="17">{{__('agent.17')}}</option>
                                                            <option value="18">{{__('agent.18')}}</option>
                                                            <option value="19">{{__('agent.19')}}</option>
                                                            <option value="20">{{__('agent.20')}}</option>
                                                            <option value="21">{{__('agent.21')}}</option>
                                                            <option value="22">{{__('agent.22')}}</option>
                                                            <option value="23">{{__('agent.23')}}</option>
                                                            <option value="24">{{__('agent.24')}}</option>
                                                            <option value="25">{{__('agent.25')}}</option>
                                                            <option value="26">{{__('agent.26')}}</option>
                                                            <option value="27">{{__('agent.27')}}</option>
                                                            <option value="28">{{__('agent.28')}}</option>
                                                            <option value="29">{{__('agent.29')}}</option>
                                                            <option value="30">{{__('agent.30')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Flats in Building')}}<i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="building_flats">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="0">{{__('agent.0')}}</option>
                                                            <option value="1">{{__('agent.1')}}</option>
                                                            <option value="2">{{__('agent.2')}}</option>
                                                            <option value="3">{{__('agent.3')}}</option>
                                                            <option value="4">{{__('agent.4')}}</option>
                                                            <option value="5">{{__('agent.5')}}</option>
                                                            <option value="6">{{__('agent.6')}}</option>
                                                            <option value="7">{{__('agent.7')}}</option>
                                                            <option value="8">{{__('agent.8')}}</option>
                                                            <option value="9">{{__('agent.9')}}</option>
                                                            <option value="10">{{__('agent.10')}}</option>
                                                            <option value="11">{{__('agent.11')}}</option>
                                                            <option value="12">{{__('agent.12')}}</option>
                                                            <option value="13">{{__('agent.13')}}</option>
                                                            <option value="14">{{__('agent.14')}}</option>
                                                            <option value="15">{{__('agent.15')}}</option>
                                                            <option value="16">{{__('agent.16')}}</option>
                                                            <option value="17">{{__('agent.17')}}</option>
                                                            <option value="18">{{__('agent.18')}}</option>
                                                            <option value="19">{{__('agent.19')}}</option>
                                                            <option value="20">{{__('agent.20')}}</option>
                                                            <option value="21">{{__('agent.21')}}</option>
                                                            <option value="22">{{__('agent.22')}}</option>
                                                            <option value="23">{{__('agent.23')}}</option>
                                                            <option value="24">{{__('agent.24')}}</option>
                                                            <option value="25">{{__('agent.25')}}</option>
                                                            <option value="26">{{__('agent.26')}}</option>
                                                            <option value="27">{{__('agent.27')}}</option>
                                                            <option value="28">{{__('agent.28')}}</option>
                                                            <option value="29">{{__('agent.29')}}</option>
                                                            <option value="30">{{__('agent.30')}}</option>
                                                            <option value="31">{{__('agent.31')}}</option>
                                                            <option value="32">{{__('agent.32')}}</option>
                                                            <option value="33">{{__('agent.33')}}</option>
                                                            <option value="34">{{__('agent.34')}}</option>
                                                            <option value="35">{{__('agent.35')}}</option>
                                                            <option value="36">{{__('agent.36')}}</option>
                                                            <option value="37">{{__('agent.37')}}</option>
                                                            <option value="38">{{__('agent.38')}}</option>
                                                            <option value="39">{{__('agent.39')}}</option>
                                                            <option value="40">{{__('agent.40')}}</option>
                                                            <option value="41">{{__('agent.41')}}</option>
                                                            <option value="42">{{__('agent.42')}}</option>
                                                            <option value="43">{{__('agent.43')}}</option>
                                                            <option value="44">{{__('agent.44')}}</option>
                                                            <option value="45">{{__('agent.45')}}</option>
                                                            <option value="46">{{__('agent.46')}}</option>
                                                            <option value="47">{{__('agent.47')}}</option>
                                                            <option value="48">{{__('agent.48')}}</option>
                                                            <option value="49">{{__('agent.49')}}</option>
                                                            <option value="50">{{__('agent.50')}}</option>
                                                            <option value="51">{{__('agent.51')}}</option>
                                                            <option value="52">{{__('agent.52')}}</option>
                                                            <option value="53">{{__('agent.53')}}</option>
                                                            <option value="54">{{__('agent.54')}}</option>
                                                            <option value="55">{{__('agent.55')}}</option>
                                                            <option value="56">{{__('agent.56')}}</option>
                                                            <option value="57">{{__('agent.57')}}</option>
                                                            <option value="58">{{__('agent.58')}}</option>
                                                            <option value="59">{{__('agent.59')}}</option>
                                                            <option value="60">{{__('agent.60')}}</option>
                                                            <option value="61">{{__('agent.61')}}</option>
                                                            <option value="62">{{__('agent.62')}}</option>
                                                            <option value="63">{{__('agent.63')}}</option>
                                                            <option value="64">{{__('agent.64')}}</option>
                                                            <option value="65">{{__('agent.65')}}</option>
                                                            <option value="66">{{__('agent.66')}}</option>
                                                            <option value="67">{{__('agent.67')}}</option>
                                                            <option value="68">{{__('agent.68')}}</option>
                                                            <option value="69">{{__('agent.69')}}</option>
                                                            <option value="70">{{__('agent.70')}}</option>
                                                            <option value="71">{{__('agent.71')}}</option>
                                                            <option value="72">{{__('agent.72')}}</option>
                                                            <option value="73">{{__('agent.73')}}</option>
                                                            <option value="74">{{__('agent.74')}}</option>
                                                            <option value="75">{{__('agent.75')}}</option>
                                                            <option value="76">{{__('agent.76')}}</option>
                                                            <option value="77">{{__('agent.77')}}</option>
                                                            <option value="78">{{__('agent.78')}}</option>
                                                            <option value="79">{{__('agent.79')}}</option>
                                                            <option value="80">{{__('agent.80')}}</option>
                                                            <option value="81">{{__('agent.81')}}</option>
                                                            <option value="82">{{__('agent.82')}}</option>
                                                            <option value="83">{{__('agent.83')}}</option>
                                                            <option value="84">{{__('agent.84')}}</option>
                                                            <option value="85">{{__('agent.85')}}</option>
                                                            <option value="86">{{__('agent.86')}}</option>
                                                            <option value="87">{{__('agent.87')}}</option>
                                                            <option value="88">{{__('agent.88')}}</option>
                                                            <option value="89">{{__('agent.89')}}</option>
                                                            <option value="90">{{__('agent.90')}}</option>
                                                            <option value="93">{{__('agent.93')}}</option>
                                                            <option value="94">{{__('agent.94')}}</option>
                                                            <option value="95">{{__('agent.95')}}</option>
                                                            <option value="96">{{__('agent.96')}}</option>
                                                            <option value="97">{{__('agent.97')}}</option>
                                                            <option value="98">{{__('agent.98')}}</option>
                                                            <option value="99">{{__('agent.99')}}</option>
                                                            <option value="100">{{__('agent.100')}}</option>
                                                            <option value="101">{{__('agent.101')}}</option>
                                                            <option value="102">{{__('agent.102')}}</option>
                                                            <option value="103">{{__('agent.103')}}</option>
                                                            <option value="104">{{__('agent.104')}}</option>
                                                            <option value="105">{{__('agent.105')}}</option>
                                                            <option value="106">{{__('agent.106')}}</option>
                                                            <option value="107">{{__('agent.107')}}</option>
                                                            <option value="108">{{__('agent.108')}}</option>
                                                            <option value="109">{{__('agent.109')}}</option>
                                                            <option value="110">{{__('agent.110')}}</option>
                                                            <option value="111">{{__('agent.111')}}</option>
                                                            <option value="112">{{__('agent.112')}}</option>
                                                            <option value="113">{{__('agent.113')}}</option>
                                                            <option value="114">{{__('agent.114')}}</option>
                                                            <option value="115">{{__('agent.115')}}</option>
                                                            <option value="116">{{__('agent.116')}}</option>
                                                            <option value="117">{{__('agent.117')}}</option>
                                                            <option value="118">{{__('agent.118')}}</option>
                                                            <option value="119">{{__('agent.119')}}</option>
                                                            <option value="120">{{__('agent.120')}}</option>
                                                            <option value="121">{{__('agent.121')}}</option>
                                                            <option value="122">{{__('agent.122')}}</option>
                                                            <option value="123">{{__('agent.123')}}</option>
                                                            <option value="124">{{__('agent.124')}}</option>
                                                            <option value="125">{{__('agent.125')}}</option>
                                                            <option value="126">{{__('agent.126')}}</option>
                                                            <option value="127">{{__('agent.127')}}</option>
                                                            <option value="128">{{__('agent.128')}}</option>
                                                            <option value="129">{{__('agent.129')}}</option>
                                                            <option value="130">{{__('agent.130')}}</option>
                                                            <option value="131">{{__('agent.131')}}</option>
                                                            <option value="132">{{__('agent.132')}}</option>
                                                            <option value="133">{{__('agent.133')}}</option>
                                                            <option value="134">{{__('agent.134')}}</option>
                                                            <option value="135">{{__('agent.135')}}</option>
                                                            <option value="136">{{__('agent.136')}}</option>
                                                            <option value="137">{{__('agent.137')}}</option>
                                                            <option value="138">{{__('agent.138')}}</option>
                                                            <option value="139">{{__('agent.139')}}</option>
                                                            <option value="140">{{__('agent.140')}}</option>
                                                            <option value="141">{{__('agent.141')}}</option>
                                                            <option value="142">{{__('agent.142')}}</option>
                                                            <option value="143">{{__('agent.143')}}</option>
                                                            <option value="144">{{__('agent.144')}}</option>
                                                            <option value="145">{{__('agent.145')}}</option>
                                                            <option value="146">{{__('agent.146')}}</option>
                                                            <option value="147">{{__('agent.147')}}</option>
                                                            <option value="148">{{__('agent.148')}}</option>
                                                            <option value="149">{{__('agent.149')}}</option>
                                                            <option value="150">{{__('agent.150')}}</option>
                                                            <option value="151">{{__('agent.151')}}</option>
                                                            <option value="152">{{__('agent.152')}}</option>
                                                            <option value="153">{{__('agent.153')}}</option>
                                                            <option value="154">{{__('agent.154')}}</option>
                                                            <option value="155">{{__('agent.155')}}</option>
                                                            <option value="156">{{__('agent.156')}}</option>
                                                            <option value="157">{{__('agent.157')}}</option>
                                                            <option value="158">{{__('agent.158')}}</option>
                                                            <option value="159">{{__('agent.159')}}</option>
                                                            <option value="160">{{__('agent.160')}}</option>
                                                            <option value="161">{{__('agent.161')}}</option>
                                                            <option value="162">{{__('agent.162')}}</option>
                                                            <option value="163">{{__('agent.163')}}</option>
                                                            <option value="164">{{__('agent.164')}}</option>
                                                            <option value="165">{{__('agent.165')}}</option>
                                                            <option value="166">{{__('agent.166')}}</option>
                                                            <option value="167">{{__('agent.167')}}</option>
                                                            <option value="168">{{__('agent.168')}}</option>
                                                            <option value="169">{{__('agent.169')}}</option>
                                                            <option value="170">{{__('agent.170')}}</option>
                                                            <option value="171">{{__('agent.171')}}</option>
                                                            <option value="172">{{__('agent.172')}}</option>
                                                            <option value="173">{{__('agent.173')}}</option>
                                                            <option value="174">{{__('agent.174')}}</option>
                                                            <option value="175">{{__('agent.175')}}</option>
                                                            <option value="176">{{__('agent.176')}}</option>
                                                            <option value="177">{{__('agent.177')}}</option>
                                                            <option value="178">{{__('agent.178')}}</option>
                                                            <option value="179">{{__('agent.179')}}</option>
                                                            <option value="180">{{__('agent.180')}}</option>
                                                            <option value="181">{{__('agent.181')}}</option>
                                                            <option value="182">{{__('agent.182')}}</option>
                                                            <option value="183">{{__('agent.183')}}</option>
                                                            <option value="184">{{__('agent.184')}}</option>
                                                            <option value="185">{{__('agent.185')}}</option>
                                                            <option value="186">{{__('agent.186')}}</option>
                                                            <option value="187">{{__('agent.187')}}</option>
                                                            <option value="188">{{__('agent.188')}}</option>
                                                            <option value="189">{{__('agent.189')}}</option>
                                                            <option value="190">{{__('agent.190')}}</option>
                                                            <option value="191">{{__('agent.191')}}</option>
                                                            <option value="192">{{__('agent.192')}}</option>
                                                            <option value="193">{{__('agent.193')}}</option>
                                                            <option value="194">{{__('agent.194')}}</option>
                                                            <option value="195">{{__('agent.195')}}</option>
                                                            <option value="196">{{__('agent.196')}}</option>
                                                            <option value="197">{{__('agent.197')}}</option>
                                                            <option value="198">{{__('agent.198')}}</option>
                                                            <option value="199">{{__('agent.199')}}</option>
                                                            <option value="200">{{__('agent.200')}}</option>
                                                            <option value="201">{{__('agent.201')}}</option>
                                                            <option value="202">{{__('agent.202')}}</option>
                                                            <option value="203">{{__('agent.203')}}</option>
                                                            <option value="204">{{__('agent.204')}}</option>
                                                            <option value="205">{{__('agent.205')}}</option>
                                                            <option value="206">{{__('agent.206')}}</option>
                                                            <option value="207">{{__('agent.207')}}</option>
                                                            <option value="208">{{__('agent.208')}}</option>
                                                            <option value="209">{{__('agent.209')}}</option>
                                                            <option value="210">{{__('agent.210')}}</option>
                                                            <option value="211">{{__('agent.211')}}</option>
                                                            <option value="212">{{__('agent.212')}}</option>
                                                            <option value="213">{{__('agent.213')}}</option>
                                                            <option value="214">{{__('agent.214')}}</option>
                                                            <option value="215">{{__('agent.215')}}</option>
                                                            <option value="216">{{__('agent.216')}}</option>
                                                            <option value="217">{{__('agent.217')}}</option>
                                                            <option value="218">{{__('agent.218')}}</option>
                                                            <option value="219">{{__('agent.219')}}</option>
                                                            <option value="220">{{__('agent.220')}}</option>
                                                            <option value="221">{{__('agent.221')}}</option>
                                                            <option value="222">{{__('agent.222')}}</option>
                                                            <option value="223">{{__('agent.223')}}</option>
                                                            <option value="224">{{__('agent.224')}}</option>
                                                            <option value="225">{{__('agent.225')}}</option>
                                                            <option value="226">{{__('agent.226')}}</option>
                                                            <option value="227">{{__('agent.227')}}</option>
                                                            <option value="228">{{__('agent.228')}}</option>
                                                            <option value="229">{{__('agent.229')}}</option>
                                                            <option value="230">{{__('agent.230')}}</option>
                                                            <option value="231">{{__('agent.231')}}</option>
                                                            <option value="232">{{__('agent.232')}}</option>
                                                            <option value="233">{{__('agent.233')}}</option>
                                                            <option value="234">{{__('agent.234')}}</option>
                                                            <option value="235">{{__('agent.235')}}</option>
                                                            <option value="236">{{__('agent.236')}}</option>
                                                            <option value="237">{{__('agent.237')}}</option>
                                                            <option value="238">{{__('agent.238')}}</option>
                                                            <option value="239">{{__('agent.239')}}</option>
                                                            <option value="240">{{__('agent.240')}}</option>
                                                            <option value="241">{{__('agent.241')}}</option>
                                                            <option value="242">{{__('agent.242')}}</option>
                                                            <option value="243">{{__('agent.243')}}</option>
                                                            <option value="244">{{__('agent.244')}}</option>
                                                            <option value="245">{{__('agent.245')}}</option>
                                                            <option value="246">{{__('agent.246')}}</option>
                                                            <option value="247">{{__('agent.247')}}</option>
                                                            <option value="248">{{__('agent.248')}}</option>
                                                            <option value="249">{{__('agent.249')}}</option>
                                                            <option value="250">{{__('agent.250')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Age')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="building_age">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Elevator')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg"id="building_elevator">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="No">{{__('agent.No')}}</option>
                                                            <option value="yes">{{__('agent.yes')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--Land--}}
                                    <div class="d-none" id="type_land">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Land m²')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <input type="number" id="land_landm2" class="form-control py-3" placeholder="Please eneter the amount">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Status')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="land_status">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
                                                            <option value="partly rented">{{__('agent.partly rented')}}</option>
                                                            <option value="full rented">{{__('agent.full rented')}}</option>
                                                            <option value="used by owner">{{__('agent.used by owner')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Type of land')}} <i class="fw-bold fa fa-asterisk text-danger"></i></label>
                                                    <div class="location-area">
                                                        <select class="form-select form-control-lg" id="land_type">
                                                            <option value="">---{{__('agent.Please Select')}}---</option>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-1 row" id="append_dynamic_form">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-between d-flex p-3">
                            <button class="ud-btn btn-thm" type="button" onclick="switchTabs(2)">
                                {{__('Next')}} <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="tab-pane fade" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">
                            <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative min-height-tab">
                                <div class="d-flex align-items-center justify-content-between pb-3 flex-wrap gap-3">
                                    <h4 class="title fz17 mb-0">{{__('Description')}}</h4>
                                    <div class="editor-toolbar">
                                        <!-- Heading options -->
                                        <select class="btn btn-sm" onchange="formatDoc('formatBlock', this.value); this.selectedIndex=0;">
                                            <option value="" selected>Format</option>
                                            <option value="h1">Heading 1</option>
                                            <option value="h2">Heading 2</option>
                                            <option value="h3">Heading 3</option>
                                            <option value="h4">Heading 4</option>
                                            <option value="h5">Heading 5</option>
                                            <option value="h6">Heading 6</option>
                                            <option value="p">Paragraph</option>
                                        </select>
                                        <!-- Font size options -->
                                        <select class="btn btn-sm" onchange="formatDoc('fontSize', this.value); this.selectedIndex=0;">
                                            <option value="" selected>Font Size</option>
                                            <option value="1">Very Small</option>
                                            <option value="2">Small</option>
                                            <option value="3">Normal</option>
                                            <option value="4">Medium Large</option>
                                            <option value="5">Large</option>
                                            <option value="6">Very Large</option>
                                            <option value="7">Maximum</option>
                                        </select>
                                        <!-- Existing toolbar buttons -->
                                        <button type="button" class="btn btn-sm" onclick="formatDoc('bold')"><i class="fa fa-bold"></i></button>
                                        <button type="button" class="btn btn-sm" onclick="formatDoc('italic')"><i class="fa fa-italic"></i></button>
                                        <button type="button" class="btn btn-sm" onclick="formatDoc('underline')"><i class="fa fa-underline"></i></button>
                                        <button type="button" class="btn btn-sm" onclick="formatDoc('insertunorderedlist')"><i class="fa fa-list-ul"></i></button>
                                        <button type="button" class="btn btn-sm" onclick="formatDoc('insertorderedlist')"><i class="fa fa-list-ol"></i></button>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="editor-container">
                                            <div id="editor" contenteditable="true" class="form-control editor-content"></div>
                                            <textarea id="descriptionEditor" name="property_description" class="d-none"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-between d-flex p-3">
                            <button class="ud-btn btn-thm" type="button" onclick="switchTabs(1)">
                                <i class="fa fa-arrow-left"></i> {{__('Back')}}
                            </button>
                            <button class="ud-btn btn-thm" type="button" onclick="switchTabs(3)">
                                {{__('Next')}} <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="tab-pane fade" id="nav-item3" role="tabpanel" aria-labelledby="nav-item3-tab">
                            <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative min-height-tab">
                                <div class="d-flex align-items-center justify-content-between pb-3 flex-wrap gap-3">
                                    <h4 class="title fz17 mb-0">{{__('Upload photos of your property')}}</h4>
                                    <span class="h6 badge bg_new_color">{{ __('agent.images_free', ['free_images' => $settings->free_images, 'price_per_image' => $settings->credits_per_image]) }}</span>
                                </div>
                                <!-- Update the image upload section -->
                                <div class="col-lg-12">
                                    <div class="upload__box mt-2">
                                        <div class="upload__btn-box d-flex flex-column align-items-center justify-content-center p-5 borderStyle">
                                            <h5>{{__('Upload Photos of Your Property')}}</h5>
                                            <span class="d-block pb-4">{{__('Photos must be JPG or PNG Format and at least 2048x768')}}</span>
                                            <label class="custom__btn rounded btn p-0">
                                                <p class="mb-0 ud-btn btn-thm" style="font-weight: normal">
                                                    {{__('Browse Files')}}
                                                    <i class="fa fa-arrow-right"></i>
                                                </p>
                                                <input type="file" id="ad_image" multiple accept="image/jpeg,image/png" class="product_image upload__inputfile">
                                            </label>
                                            <!-- Thumbnail Selection -->
                                            <div class="thumbnail-selection mt-4 d-none">
                                                <h6>{{__('Select Thumbnail')}}</h6>
                                                <div class="thumbnail-options d-flex flex-wrap gap-3" id="thumbnailOptions"></div>
                                            </div>
                                            
                                            <!-- Image Cropping Modal -->
                                            <div class="modal fade" id="imageCropModal" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">{{__('Crop Image')}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="img-container">
                                                                <img id="cropImage" src="" alt="Image to crop">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                                                            <button type="button" class="btn btn-primary" id="cropButton">{{__('    Crop')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="upload__img-wrap mt-3 ms-1 w-100" id="parentElement"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-content-between d-flex p-3">
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(2)">
                                <i class="fa fa-arrow-left"></i> Back
                            </button>
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(4)">
                                Next <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="tab-pane fade" id="nav-item4" role="tabpanel" aria-labelledby="nav-item4-tab">
                            <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                                <h4 class="title fz17 mb30">{{__('agent.Property Location')}}</h4>
                                <div class="row">
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="mb20">
                                            <label
                                            class="heading-color ff-heading fw600 mb10">{{__('user.City')}}</label>
                                            <div class="location-area">
                                                <select class="form-select form-control-lg" id="property_city">
                                                    <option value="">---{{__('agent.Please Select')}}----</option>
                                                    @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="mb20">
                                            <label
                                            class="heading-color ff-heading fw600 mb10">{{__('user.Town')}}</label>
                                            <div class="location-area">
                                                <select class="form-select form-control-lg" id="property_town">
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="mb20">
                                            <label
                                            class="heading-color ff-heading fw600 mb10">{{__('user.District')}}</label>
                                            <div class="location-area">
                                                <select class="form-select form-control-lg" id="property_district">
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="mb30">
                                                <label
                                                class="heading-color ff-heading fw600 mb10">{{__('user.Latitude')}}</label>
                                                <input type="text" readonly id="property_latitude"
                                                class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-xl-4">
                                            <div class="mb30">
                                                <label
                                                class="heading-color ff-heading fw600 mb10">{{__('user.Longitude')}}</label>
                                                <input type="text" readonly id="property_longitude"
                                                class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-12 d-none" id="map_div">
                                        <input type="hidden" value="" id="pac-input">
                                        <div class="mb20 mt30">
                                            <label class="heading-color ff-heading fw600 mb30">Place the listing pin on the map</label>
                                            {{--                                                    <iframe id="map" class="h550" loading="lazy" src="" title="Custom Map" aria-label="Custom Map"></iframe>--}}
                                            <div id="map" style="width: 100%; height: 350px;"
                                            class="h550 rounded-5"></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <h4 class="title fz17 mb30">{{__('agent.Distance')}}</h4>
                                <div class="row">
                                    @foreach($locations as $location)
                                    <?php
                                    $options = explode('-', $location->location_details[0]->answer ?? '');
                                    $options_values = explode('-', $location->location_details_en[0]->answer ?? '');
                                    ?>
                                    <div class="col-sm-6 col-xl-4">
                                        <div class="mb30">
                                            
                                            <label class="heading-color d-flex align-items-center ff-heading fw600 mb10">{{$location->location_details[0]->title}}
                                                
                                                <i class="  {{$location->mandatory == 'true' ? '' : 'd-none'}} fw-bold fa fa-asterisk text-danger"></i>
                                            </label>
                                            
                                            <div class="location-area">
                                                <select class="form-select form-control-lg"
                                                name="property_locations_values[]"
                                                data-property_location_ids="{{$location->id}}">
                                                <option value="">---{{__('agent.Please Select')}}---
                                                </option>
                                                @foreach($options as $key => $option)
                                                @if (isset($options_values[$key]))
                                                <option value="{{ $options_values[$key] }}">{{ $option }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class=" justify-content-between d-flex p-3">
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(3)"><i
                                class="fa fa-arrow-left"></i> Back
                            </button>
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(5)">
                                Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-item5" role="tabpanel" aria-labelledby="nav-item5-tab">
                            <div
                            class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative min-height-tab">
                            <h4 class="title fz17 mb30">{{__('agent.Property Price')}}</h4>
                            
                            <div class="row">
                                <div class="col-sm-6 col-xl-4">
                                    <div class="mb20">
                                        <label
                                        class="heading-color ff-heading fw600 mb10">{{__('agent.Select Currency')}}</label>
                                        <div class="location-area">
                                            <select class="form-select form-control-lg" id="property_currency">
                                                @foreach($currencies as $currency)
                                                <option
                                                value="{{$currency->id}}">{{$currency->code}}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <div class="mb20">
                                        <label
                                        class="heading-color ff-heading fw600 mb10">{{__('user.Price')}}</label>
                                        <input type="text" id="property_price" class="form-control"
                                        placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" justify-content-between d-flex p-3">
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(4)"><i
                                class="fa fa-arrow-left"></i> Back
                            </button>
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(6)">
                                Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-item6" role="tabpanel" aria-labelledby="nav-item6-tab">
                            <div
                            class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative min-height-tab">
                            <h4 class="title fz17 mb30">{{__('agent.Select Features')}}</h4>
                            <div class="row" id="append_features">
                                
                                
                            </div>
                        </div>
                        <div class=" justify-content-between d-flex p-3">
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(5)"><i
                                class="fa fa-arrow-left"></i> Back
                            </button>
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(7)">
                                Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-item7" role="tabpanel" aria-labelledby="nav-item7-tab">
                            <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative min-height-tab">
                                <h4 class="title fz17 mb30">{{__('agent.Select Payment')}}</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-12">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">
                                                    {{__('agent.Select Duration')}}
                                                </label>
                                                <div class="location-area">
                                                    <select class="form-select form-control-lg"
                                                    id="property_duration">
                                                    {{--                                                                <option value="0">---{{__('agent.Please Select')}}----</option>--}}
                                                    <option disabled
                                                    value="1">{{__('agent.One month (30 days - :credits Credits)', ['credits' => $settings->credits_one_month])}}</option>
                                                    <option disabled
                                                    value="2">{{__('agent.Two months (60 days - :credits Credits)', ['credits' => $settings->credits_two_month])}}</option>
                                                    <option selected
                                                    value="3">{{__('agent.Three months (90 days - :credits Credits)', ['credits' => $settings->credits_three_month])}}
                                                    <span class="text-danger" style="font-weight: bold; font-size: 16px; text-decoration: underline;">{{__('agent.today 10 credits only')}}</span>
                                                </option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-none">
                                    <div class="checkbox-style1">
                                        <label
                                        class="custom_checkbox">{{__('agent.Went to highlight as featured')}}
                                        <input type="checkbox" name="" id="want_to_highlight" value="">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <div class="container">
                                        <table id="credits_table" class="table">
                                            
                                            <tbody>
                                                <tr>
                                                    <td class="border-bottom-0 fw-bold">{{__('agent.Creating an ad:')}}</td>
                                                    <td class="border-bottom-0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold border-bottom-0">{{__('agent.Duration - 3 months')}}</td>
                                                    <td class="text-danger fw-bold border-bottom-0">10 {{__('agent.Credits')}}</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="border-bottom-0 fw-bold">{{__('agent.Total Credits:')}}</td>
                                                    <td class="text-danger fw-bold  border-bottom-0"
                                                    id="total_credits">10 {{__('agent.Credits')}}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class=" justify-content-between d-flex p-3">
                            <button class="ud-btn btn-thm flex-grow-0" type="button" onclick="switchTabs(6)"><i
                                class="fa fa-arrow-left"></i> Back
                            </button>
                            <button class="ud-btn btn-thm" id="property_submit_btn" type="submit">
                                {{__('agent.Submit Property')}}
                                <i class="fal fa-arrow-right-long"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    // Editor functionality
    function formatDoc(command, value = null) {
        if (value) {
            document.execCommand(command, false, value);
        } else {
            document.execCommand(command, false, null);
        }
    }
    
    // Sync editor content with hidden textarea
    document.getElementById('editor').addEventListener('input', function() {
        document.getElementById('descriptionEditor').value = this.innerHTML;
    });
    
    // Initialize editor
    document.addEventListener('DOMContentLoaded', function() {
        const editor = document.getElementById('editor');
        
        // Add placeholder text
        editor.setAttribute('placeholder', '{{__("Enter property description")}}');
        
        // Handle form submission
        const form = editor.closest('form');
        if (form) {
            form.addEventListener('submit', function() {
                document.getElementById('descriptionEditor').value = editor.innerHTML;
            });
        }
        
        // Prevent unwanted formatting on paste
        editor.addEventListener('paste', function(e) {
            e.preventDefault();
            const text = (e.originalEvent || e).clipboardData.getData('text/plain');
            document.execCommand('insertText', false, text);
        });
    });
    
    // function switchTabs(tab) {
    //     // Update tab button IDs to match the correct order
    //     switch(tab) {
    //         case 1:
    //         $("#nav-item1-tab").click();
    //         break;
    //         case 2:
    //         // Target the description tab (nav-item2-tab)
    //         $("#nav-item2-tab[data-bs-target='#nav-item2']").click();
    //         break;
    //         case 3:
    //         $("#nav-item3-tab").click();
    //         break;
    //         case 4:
    //         $("#nav-item4-tab").click();
    //         break;
    //         case 5:
    //         $("#nav-item5-tab").click();
    //         break;
    //         case 6:
    //         $("#nav-item6-tab").click();
    //         break;
    //         case 7:
    //         $("#nav-item7-tab").click();
    //         break;
    //     }
    // }
    
    // Add this in your existing script section
    function initializeCropper(imageElement) {
        return new Cropper(imageElement, {
            aspectRatio: 16 / 9,
            viewMode: 2,
            dragMode: 'move',
            autoCropArea: 0.65,
            restore: false,
            guides: true,
            center: true,
            highlight: true,
            cropBoxMovable: true,
            cropBoxResizable: true,
            toggleDragModeOnDblclick: false,
        });
    }
    // Add to your existing JavaScript
    let selectedThumbnail = null;
    let cropper = null;
    
    document.getElementById('ad_image').addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        if (files.length > 0) {
            // Show thumbnail selection area
            document.querySelector('.thumbnail-selection').classList.remove('d-none');
            
            // Clear existing thumbnails
            const thumbnailOptions = document.getElementById('thumbnailOptions');
            thumbnailOptions.innerHTML = '';
            
            // Create thumbnail options
            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.dataset.index = index;
                    img.onclick = function() {
                        selectThumbnail(this);
                    };
                    img.ondblclick = function() {
                        openCropModal(this);
                    };
                    thumbnailOptions.appendChild(img);
                    
                    // Select first image as default thumbnail
                    if (index === 0) {
                        selectThumbnail(img);
                    }
                };
                reader.readAsDataURL(file);
            });
        }
    });
    
    function selectThumbnail(imgElement) {
        // Remove selected class from all thumbnails
        document.querySelectorAll('.thumbnail-options img').forEach(img => {
            img.classList.remove('selected');
        });
        
        // Add selected class to clicked thumbnail
        imgElement.classList.add('selected');
        selectedThumbnail = imgElement;
    }
    
    function openCropModal(imgElement) {
        const modal = new bootstrap.Modal(document.getElementById('imageCropModal'));
        const cropImage = document.getElementById('cropImage');
        cropImage.src = imgElement.src;
        
        modal.show();
        
        // Initialize cropper
        if (cropper) {
            cropper.destroy();
        }
        cropper = initializeCropper(cropImage);
    }
    
    document.getElementById('cropButton').addEventListener('click', function() {
        if (!cropper) return;
        
        // Get cropped canvas
        const canvas = cropper.getCroppedCanvas({
            width: 800,    // Set desired width
            height: 450    // Set desired height
        });
        
        // Convert canvas to blob
        canvas.toBlob(function(blob) {
            // Update the selected thumbnail with cropped image
            if (selectedThumbnail) {
                selectedThumbnail.src = canvas.toDataURL();
            }
            
            // Close modal
            bootstrap.Modal.getInstance(document.getElementById('imageCropModal')).hide();
            
            // Destroy cropper
            cropper.destroy();
            cropper = null;
        });
    });
</script>
<script>
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
    function switchTabs(tab) {
        // First, remove active class from all tabs
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        
        // Then activate the selected tab
        $(`#nav-item${tab}-tab`).addClass('active');
        $(`#nav-item${tab}`).addClass('show active');
        
        // Additional validation before switching tabs
        if (tab === 2) { // When switching to description tab
            validateFirstTab();
        }
    }
    
    // Add this to handle tab clicks directly
    $('.nav-link').on('click', function(e) {
        e.preventDefault();
        let tabId = $(this).attr('id').replace('-tab', '');
        let tabNumber = parseInt(tabId.replace('nav-item', ''));
        switchTabs(tabNumber);
    });
    
    // Update your HTML structure to include proper tab navigation:
    
    $("#property_price").change(function () {
        
        let price = $("#property_price").val();
        if (price != "") {
            price = price.toString();
            price = price.replace(',', '');
            price = price.replaceAll('.', '');
            price = price.replaceAll(/[^0-9.,]/g, '');
            
            var parsedPrice = parseFloat(price);
            // Check if parsedPrice is NaN
            if (isNaN(parsedPrice)) {
                parsedPrice = 0; // Set to 0 if NaN
            }
            var roundedPrice = Math.floor(parsedPrice / 1000) * 1000;
            
            sap = '$1.';
            
            if ($("#property_currency option:selected").text() == 'USD') {
                sap = '$1,';
            }
            
            $("#property_price").val(roundedPrice.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, sap));
            
        }
    });
    
    $(document).ready(function () {
        $("#add_property_li").addClass('-is-active');
        
        // Update table based on property duration selection
        $('#property_duration').change(function () {
            var durationCredits = parseInt($(this).val());
            if (durationCredits != 1) {
                
                var totalCredits = durationCredits * 10;
                
                var existingRow = $('#credits_table tbody').find('tr:contains("{{__('agent.Duration')}}")');
                if (existingRow.length) {
                    existingRow.find('td:first').text('{{__('agent.Duration')}} ' + durationCredits + ' {{__('agent.months')}}');
                    existingRow.find('td:last').text(totalCredits);
                } else {
                    $('#credits_table tbody').append('<tr><td>{{__('agent.Duration')}} ' + durationCredits + ' {{__('agent.months')}}</td><td>' + totalCredits + '</td></tr>');
                }
                updateTotalCredits();
            } else {
                // Remove row if durationCredits is 0
                var existingRow = $('#credits_table tbody').find('tr:contains("{{__('agent.Duration')}}")');
                if (existingRow.length) {
                    existingRow.remove();
                    updateTotalCredits(); // Update total credits after removing the row
                }
            }
        });
        
        // Update table based on highlighting property checkbox
        $('#want_to_highlight').change(function () {
            var highlightCredits = $(this).is(':checked') ? {{$settings->highlight_in_color}} : 0;
            if (highlightCredits) {
                $('#credits_table tbody').append('<tr><td>{{__('agent.Went to highlight as featured')}}</td><td class="text-danger fw-bold">' + highlightCredits + '{{__('agent.Credits')}}</td></tr>');
            } else {
                $('#credits_table tbody tr:contains("{{__('agent.Went to highlight as featured')}}")').remove();
            }
            updateTotalCredits();
        });
        
        //Add amount on extra images
        // Add amount on extra images
        $("#ad_image").change(updateImagesCredits);
        
        $('body').on('click', ".upload__img-close", updateImagesCredits);
        
        function updateImagesCredits() {
            
            let freeImages = parseInt("{{ $settings->free_images }}");
            let creditsPerImage = parseInt("{{ $settings->credits_per_image }}");
            let uploadImageCount = uploadProductImg.length;
            let totalImages = uploadImageCount;
            let extraImages = totalImages - freeImages;
            let imagesCredits = 0;
            
            if (extraImages > 0) {
                imagesCredits = extraImages * creditsPerImage;
                
                // Check if row already exists, update it; otherwise, append a new row
                let row = $('#credits_table tbody tr:contains("{{__('agent.Extra images')}}")');
                if (row.length > 0) {
                    row.find('td:eq(0)').text("{{__('agent.Extra images')}} " + extraImages);
                    row.find('td:eq(1)').text(imagesCredits);
                } else {
                    $('#credits_table tbody').append('<tr><td class="fw-bold border-0">{{__('agent.Extra images')}} ' + extraImages + '</td><td class="text-danger fw-bold">' + imagesCredits + ' {{__("agent.Credits")}}</td></tr>');
                }
            } else {
                // Remove row if extra images count is not greater than 0
                $('#credits_table tbody tr:contains("{{__('agent.Extra images')}}")').remove();
            }
            
            updateTotalCredits();
        }
        
        function updateTotalCredits() {
            var totalCredits = 0; // Initial credits for creating an ad
            $('#credits_table tbody tr').each(function () {
                var creditsText = $(this).find('td:last').text().trim(); // Get text content and remove leading/trailing spaces
                var numericPart = creditsText.match(/\d+(\.\d+)?/); // Extract numeric part using regular expression
                if (numericPart !== null) {
                    var credits = parseFloat(numericPart[0]); // Parse numeric part as float
                    totalCredits += credits;
                }
            });
            $('#total_credits').text(totalCredits + ' {{__("agent.Credits")}}');
        }
    });
    
</script>
@endsection
