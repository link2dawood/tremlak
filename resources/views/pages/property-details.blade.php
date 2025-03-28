@extends('pages.layouts.master')
@section('pageTitle',__('user.Property Details'))
@section('content')
<style type="text/css">
    .sp-img-content, .sp-img-content a, .sp-img-content img {
        border-radius: 0 !important;
    }

    .row.mb30.mt30 {
        border-radius: 0 !important;
        overflow: hidden; /* Ensures no inherited border-radius */
    }
    .thirdChild:nth-of-type(2) .sp-img-content .popup-img {
        border-radius: 0 !important;
    }
    .thirdChild:nth-of-type(4) .sp-img-content .popup-img {
        border-radius: 0 !important;
    }
    .owl-nav{
        margin-top: 50px;
    }
    .owl-dots{
        margin-top: 50px;
    }
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

</style>
<section class="pt60 pb90 bgc-f7">
    <div class="container">
        <div class="row wow fadeInUp" data-wow-delay="100ms">
            <div class="col-lg-8">
                <div class="single-property-content mb30-md">
                    <h2 class="sp-lg-title">{{compiledText('title',$property->property_type_id,$property->id)}}</h2>
                    <div class="pd-meta mb15 d-md-flex align-items-center">
                        <p class="text fz15 mb-0 bdrr1 pr10 bdrrn-sm d-none">{{$property->property_agent->fname}} {{$property->property_agent->lname}}</p>
                        <a class="ff-heading bdrr1 fz15 pr10 ml10 ml0-sm bdrrn-sm" href="#"><i
                            class="far fa-clock pe-2"></i>{{date('d-m-Y',strtotime($property->create_date))}}
                        </a>
                        <a class="ff-heading ml10 ml0-sm fz15" href="#"><i
                            class="flaticon-fullscreen pe-2 align-text-top"></i>{{$property->slug}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-property-content">
                        <div class="property-action text-lg-end">
                            <h2 class="sp-lg-title ">{{getCurrency($property->price_in_usd,$property->currency_id,$property->price)}}</h2>
                            <div class="d-flex mb20 mb10-md align-items-center justify-content-lg-end">

                                <a class="icon mr10" id="favoriteIcon{{$property->id}}" onclick="toggleFavorite(`{{$property->id}}`)">
                                    <span id="heartIcon{{$property->id}}" data-fav-icon="{{$property->id}}" class="fav_icon fa fa-heart"></span>
                                </a>

                                <a class="icon mr10 p-2" onclick="testingspan()"><span class="flaticon-share-1"></span></a>
                            </div>

                            <p class="text space fz15 d-none" >{{$property->property_type->property_type_details[0]->title ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb30 mt30 wow fadeInUp" data-wow-delay="300ms">
                <div class="col-sm-6">
                    <div class="sp-img-content mb15-md h-100">
                        <a class="popup-img preview-img-1 sp-img "
                        href="{{$property->preview_image !='' ? asset($property->preview_image) :asset('agent/images/placeholder.png') }}">
                        <img class="w-100 h-100"
                        src="{{$property->preview_image !='' ? asset($property->preview_image) :asset('agent/images/placeholder.png') }}"
                        alt="1.jpg">
                    </a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">

                    @foreach($property->property_images as $images)
                    <?php
                    if($property->preview_image == $images->image_path){
                        continue;
                    }
                    ?>
                    <div class="col-6 ps-sm-0 thirdChild">
                        <div class="sp-img-content ">
                            <a class="popup-img preview-img-2 sp-img h-100  {{$loop->iteration > 5 ? 'd-none' : ''}}"
                               href="{{$images->image_path !='' ? asset($images->image_path) :asset('agent/images/placeholder.png') }}">
                               <img class="w-100 h-100 "
                               src="{{$images->image_path !='' ? asset($images->image_path) :asset('agent/images/placeholder.png')}}"
                               alt="2.jpg">
                           </a>
                       </div>
                   </div>
                   @endforeach
               </div>
           </div>
       </div>
       <div class="row wrap wow fadeInUp" data-wow-delay="500ms">
        <div class="col-lg-8">

            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 px30 pt30 pb20 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb10 ">{{__('user.Property Details')}}</h4>
                <div class="row">
                    {{--                                //show the property attribute icons with thire value--}}
                    @if($property->property_type_id == 1)
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/apartment_type.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('Apartment-Type')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->type ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/condition.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Condition')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->conditionp ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/length.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('gross/net')}}</h6>
                                <!-- <p class="text mb-0 fz15">{{$property->apartment_attribute->grossm2 ?? ''}} / {{$property->apartment_attribute->netm2 ?? ''}}</p> -->
                                <p class="text mb-0 fz15">
                                    {{ number_format($property->apartment_attribute->grossm2 ?? 0, 0, '', '.') }} /
                                    {{ number_format($property->apartment_attribute->netm2 ?? 0, 0, '', '.') }}
                                </p>

                            </div>
                        </div>
                    </div>
                    {{--                                <div class="col-sm-6 col-lg-4">--}}
                        {{--                                    <div class="overview-element mb-2 d-flex align-items-start">--}}
                            {{--                                        <img src="{{asset('agent/images/icon/length.svg')}}">--}}
                            {{--                                        <div class="ml15">--}}
                                {{--                                            <h6 class="mb-0">{{__('agent.Net m²')}}</h6>--}}
                                {{--                                            <p class="text mb-0 fz15">{{$property->apartment_attribute->netm2 ?? ''}}</p>--}}
                            {{--                                        </div>--}}
                        {{--                                    </div>--}}
                    {{--                                </div>--}}
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/bed.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Bedrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->bed_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/couch.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Livingrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->living_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/bathroom.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Bathrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->bath_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/age.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Age')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->age ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/status.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Status')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->status ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/floor.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('Floor')}}</h6>
                                <p class="text mb-0 fz15">{{ getFloorLabel($property->apartment_attribute->floors ?? '') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/floor.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Building-Floors')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->floors ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/elevator.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Elevator')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->apartment_attribute->elevator ?? ''))}}</p>
                            </div>
                        </div>
                    </div>

                    @elseif($property->property_type_id == 2)

                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/condition.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Condition')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->villa_attribute->conditionp ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            <div class="ml15">
                                <h6 class="mb-0">{{__('gross/net')}}</h6>
                                <!-- <p class="text mb-0 fz15">{{$property->villa_attribute->grossm2 ?? ''}} / {{$property->villa_attribute->netm2 ?? ''}}</p> -->
                                <p class="text mb-0 fz15">
                                    {{ number_format($property->villa_attribute->grossm2 ?? 0, 0, '', '.') }} /
                                    {{ number_format($property->villa_attribute->netm2 ?? 0, 0, '', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/length.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Land m²')}}</h6>
                                <p class="text mb-0 fz15">{{$property->villa_attribute->landm2 ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/bed.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Bedrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->villa_attribute->bed_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/couch.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Livingrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->villa_attribute->living_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/bathroom.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Bathrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->villa_attribute->bath_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/age.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Age')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->villa_attribute->age ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/floor.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('Floors')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->villa_attribute->floors ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/garden.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Garden')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->villa_attribute->garden ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @elseif($property->property_type_id == 3)
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/condition.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Condition')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->house_attribute->conditionp ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/length.svg')}}">--}}
                            {{--                                        <div class="ml15">--}}
                                {{--                                            <h6 class="mb-0">{{__('agent.Villa m² gross')}}</h6>--}}
                                {{--                                            <p class="text mb-0 fz15">{{$property->house_attribute->grossm2 ?? ''}}</p>--}}
                            {{--                                        </div>--}}

                            <div class="ml15">
                                <h6 class="mb-0">{{__('gross/net')}}</h6>
                                <!-- <p class="text mb-0 fz15">{{$property->house_attribute->grossm2 ?? ''}} / {{$property->house_attribute->netm2 ?? ''}}</p> -->
                                <p class="text mb-0 fz15">
                                    {{ number_format($property->house_attribute->grossm2 ?? 0, 0, '', '.') }} /
                                    {{ number_format($property->house_attribute->netm2 ?? 0, 0, '', '.') }}
                                </p>
                            </div>

                        </div>
                    </div>
                    {{--                                <div class="col-sm-6 col-lg-4">--}}
                        {{--                                    <div class="overview-element mb-2 d-flex align-items-start">--}}
                            {{--                                        <img src="{{asset('agent/images/icon/length.svg')}}">--}}
                            {{--                                        <div class="ml15">--}}
                                {{--                                            <h6 class="mb-0">{{__('agent.Villa m² net')}}</h6>--}}
                                {{--                                            <p class="text mb-0 fz15">{{$property->house_attribute->netm2 ?? ''}}</p>--}}
                            {{--                                        </div>--}}
                        {{--                                    </div>--}}
                    {{--                                </div>--}}
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/length.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Land m²')}}</h6>
                                <!-- <p class="text mb-0 fz15">{{$property->house_attribute->landm2 ?? ''}}</p> -->
                                <p class="text mb-0 fz15">
                                    {{ number_format($property->house_attribute->landm2 ?? 0, 0, '', '.') }}
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/bed.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Bedrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->house_attribute->bed_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/couch.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Livingrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->house_attribute->living_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/bathroom.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Bathrooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->house_attribute->bath_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/age.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Age')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->house_attribute->age ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/floor.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('Floors')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->house_attribute->floors ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/garden.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Garden')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->house_attribute->garden ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @elseif($property->property_type_id == 4)
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/condition.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Condition')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->building_attribute->conditionp ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/length.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Building m²')}}</h6>
                                <!-- <p class="text mb-0 fz15">{{$property->building_attribute->grossm2 ?? ''}}</p> -->
                                <p class="text mb-0 fz15">
                                    {{ number_format($property->building_attribute->grossm2 ?? 0, 0, '', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/floor.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('Floors')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->building_attribute->floors ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/flats.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('Flats')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->building_attribute->flats ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/shop.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('Shops')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->building_attribute->shops ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/storage.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('Storage-Rooms')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->building_attribute->storage_rooms ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/age.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Age')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->building_attribute->age ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/elevator.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Elevator')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->building_attribute->elevator ?? ''))}}</p>
                            </div>
                        </div>
                    </div>
                    @elseif($property->property_type_id == 5)
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/lenght.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Land m²')}}</h6>
                                <p class="text mb-0 fz15">{{$property->land_attribute->landm2 ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                    {{--                                <div class="col-sm-6 col-lg-4">--}}
                        {{--                                    <div class="overview-element mb-2 d-flex align-items-start">--}}
                            {{--                                        --}}{{--                                        <img src="{{asset('agent/images/icon/price.svg')}}">--}}
                            {{--                                        <div class="ml15">--}}
                                {{--                                            <h6 class="mb-0">{{__('agent.Price / m²')}}</h6>--}}
                                {{--                                            <p class="text mb-0 fz15">{{$property->land_attribute->pricem2 ?? ''}}</p>--}}
                            {{--                                        </div>--}}
                        {{--                                    </div>--}}
                    {{--                                </div>--}}
                    <div class="col-sm-6 col-lg-4">
                        <div class="overview-element mb-2 d-flex align-items-start">
                            {{--                                        <img src="{{asset('agent/images/icon/land.svg')}}">--}}
                            <div class="ml15">
                                <h6 class="mb-0">{{__('agent.Type if land')}}</h6>
                                <p class="text mb-0 fz15">{{__('agent.'.($property->land_attribute->type ?? ''))}}</p>
                            </div>
                        </div>
                    </div>

                    @endif

                </div>

            </div>

            <!--<div class="ps-widget bgc-white bdrs12 default-box-shadow2 px30 pt30 pb20 mb30 overflow-hidden position-relative">-->
            <!--    <h4 class="title fz17 mb10">{{__('user.Property Description')}}</h4>-->

            <!--    <p class="text mb10">{{compiledText('description',$property->property_type_id,$property->id)}}</p>-->
            <!--</div>-->
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 px30 pt30 pb20 mb30 overflow-hidden position-relative">
                    <h4 class="title fz17 mb10">{{ __('user.Property Description') }}</h4>
                
                    <p class="text mb10">
                        @if(is_null($property->description))
                            {{ compiledText('description', $property->property_type_id, $property->id) }}
                        @else
                            {!! $property->description !!}
                        @endif
                    </p>
                </div>

            @if(count($property->outlooks()) > 0)
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 px30 pt30 pb20 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb-0">{{__('user.Features')}}</h4>
                <div class="row">
                    {{--                                @foreach ($property->outlooks() as $outlook)--}}
                    {{--                                    <div class="col-sm-6 col-md-4">--}}
                        {{--                                        <div class="pd-list mb10-sm">--}}
                            {{--                                            @foreach($outlook as $look)--}}

                            {{--                                                @if(true)--}}
                            {{--                                                    <p class="fw-bold">{{$look->category->features_category_details[0]->title ?? ''}}</p>--}}
                            {{--                                                @endif--}}

                            {{--                                                <p class="text mb10"><i--}}
                                {{--                                                        class="fas fa-circle fz6 align-middle pe-2"></i>{{$look->feature_details[0]->title}}--}}
                            {{--                                                </p>--}}
                            {{--                                            @endforeach--}}
                        {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                @endforeach--}}
                    <div class="">
                        @foreach ($property->outlooks() as $category => $features)
                        <div class="">
                            <h4 class="title fz17 mb-0" style="color: #e30a17" >{{ $category }}</h4>
                            <div class="row">
                                @foreach($features as $feature)
                                <div class="col-sm-6 col-md-4 mt-2">
                                    <div class="pd-list mb10-sm">
                                        <!-- Display the type of property feature -->

                                        <p class="text mb10"><i class="fas fa-circle fz6 align-middle pe-2"></i>{{ $feature }}</p> <!-- Display selected features -->

                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            @endif
            @if(count($property->near_by_locations()) > 0)
            <div class=" ps-widget bgc-white bdrs12 default-box-shadow2 px30 pt30 pb20 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb10">{{__('user.Whats Nearby?')}}</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="navtab-style1">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade fz15 active show" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                                    <p class="dark-color fw600 mb-4">{{__('user.Distance to the...')}}</p>
                                    @foreach ($property->near_by_locations()->chunk(3) as $chunk)
                                    <div class="row">

                                        @foreach ($chunk as $key => $location)
                                        <?php $location_values = explode(',', $property->location_values) ?>
                                        {{--                                                        {{dd($loop->parent->index)}}--}}

                                        <div class="col-md-4">
                                            <div class="nearby d-sm-flex align-items-center mb20">
                                                <div class="details">
                                                    <p class="dark-color fw600 mb-0">{{ $location->location_details[0]->title }}</p>
                                                    <p class="text mb-0">{{ $location_values[($loop->parent->index * 3) + ($loop->index)] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb20 overflow-hidden position-relative">
                <h4 class="title fz17 mb10">{{__('user.Address')}}</h4>
                <div class="row">
                    {{--                            <div class="col-md-6 col-xl-4">--}}
                        {{--                                <div class="d-flex justify-content-between">--}}
                            {{--                                    <div class="pd-list">--}}
                                {{--                                        <p class="fw600 mb10 ff-heading dark-color">{{__('user.City')}}: </p>--}}
                                {{--                                        <p class="fw600 mb10 ff-heading dark-color">{{__('user.Town')}}: </p>--}}
                                {{--                                        <p class="fw600 mb-0 ff-heading dark-color">{{__('user.District')}}: </p>--}}
                            {{--                                    </div>--}}
                            <div class="pd-list">
                                <p class="text mb10">{{$property->property_city->title}} / {{$property->property_town->title}} / {{$property->property_district->title}}</p>
                            </div>
                        {{--                                </div>--}}
                    {{--                            </div>--}}
                    <div class="col-md-6 col-xl-4 mb-2 d-none">
                        <div class="d-flex justify-content-between">
                            <div class="pd-list">
                                <p class="fw600 mb10 ff-heading dark-color">{{__('user.Latitude')}}: </p>
                                <p class="fw600 mb10 ff-heading dark-color">{{__('user.Longitude')}}: </p>

                            </div>
                            <div class="pd-list">
                                <p class="text mb10">{{$property->latitude}}</p>
                                <p class="text mb10">{{$property->longitude}}</p>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 d-none" id="map_div">
                        <input type="hidden" value="" id="pac-input">
                        <div id="map" style="width: 100%; height: 350px;" class="h550 rounded-5"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="column">
                <div class="default-box-shadow1 bdrs12 bdr1 p30 mb30-md bgc-white position-relative">
                    <div class="widget-wrapper mb-0">
                        <h6 class="title fz17 mb10 text-center">{{__('user.Agent Information')}}</h6>
                        <div class="agent-single d-flex justify-content-center align-items-center pb25 gap-4">

                            @if(isset($property->property_agent->broker_office->image_path) && $property->property_agent->broker_office->image_path  !='')
                            <div style="width: 160px" class="single-img mb-2 h90 img_bg">
                                <img  class=" rounded"
                                src="{{asset($property->property_agent->broker_office->image_path)}}">
                            </div>
                            @endif

                            @if(isset($property->property_agent->image_path) && $property->property_agent->image_path !='')
                            <div class="w90 h90 single-img mb-2 img_bg">
                                <img class=" rounded"
                                src="{{asset($property->property_agent->image_path)}}">
                            </div>
                            @endif
                        </div>
                        <div class="single-contant ml20 ml0-xs text-center mb-3">
                            {{--                                    <a href="{{ route('agent_details', ['id' => $property->property_agent->id]) }}"--}}
                                {{--                                       class="text-decoration-none">--}}
                                <h5 class="title mb-0">{{$property->property_agent->fname ?? ''}} {{$property->property_agent->lname ?? ''}}</h5>
                            {{--                                    </a>--}}
                            {{--                                    <form action="{{route('view_agents')}}" method="POST">--}}
                                {{--                                        @csrf--}}
                                {{--                                        <input type="hidden" value="{{$property->property_agent->broker_office->id}}"--}}
                                {{--                                               name="broker_office_search">--}}
                                <h5 class="title mb-0">{{$property->property_agent->broker_office->title ?? ''}}</h5>

                            {{--                                    </form>--}}
                            {{--                                    @if(isset($property->property_agent->broker_office->certificate_no) && $property->property_agent->broker_office->certificate_no !='')--}}
                            <h5 class="title mt-3 mb-0">{{__('user.Real Estate Trade Certificate No.')}}</h5>
                            <p class="title mb-0">{{$property->property_agent->broker_office->certificate_no ?? trans('user.not yet submitted')}}</p>
                            {{--                                    @endif--}}
                        </div>
                        <div class="single-contant ml20 ml0-xs text-center mb-3">

                            <a href="{{route('properties',['agent_id'=>$property->property_agent->id])}}"
                                class="h5 btn btn-link text-decoration-none title mb-1 text-danger">
                                {{__('user.Other properties of this agent')}}
                            </a>

                        </div>
                        <div class="col-md-12">
                            <div class="d-grid mb-2">
                                <button class="ud-btn btn-thm" type="button" data-bs-toggle="modal" data-bs-target="#messageModal">
                                    {{ __('Send Message To Agent') }}
                                    <i class="fal fa-arrow-right-long"></i>
                                </button>
                            </div>

                            <!-- Message Modal -->
                            <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" style="color:white" id="messageModalLabel"><i class="fas fa-envelope"></i> {{ __('Send Message to Agent') }}</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">
                                            <form id="messageForm">
                                                <input type="hidden" name="agent_id" value="{{ $property->property_agent->id ?? '' }}">
                                                <input type="hidden" name="is_read" value="false">
                                                <input type="hidden" name="property_id" value="{{$property->id ?? '' }}">
                                                <!-- Contact Method -->
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">{{ __('Preferred Contact Method') }}</label>
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="contact_method" value="WhatsApp" id="contact_whatsapp" required>
                                                            <label class="form-check-label" for="contact_whatsapp"><i class="fab fa-whatsapp text-success"></i> WhatsApp</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="contact_method" value="Phone" id="contact_phone">
                                                            <label class="form-check-label" for="contact_phone"><i class="fas fa-phone-alt text-primary"></i> Phone</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="contact_method" value="Email" id="contact_email">
                                                            <label class="form-check-label" for="contact_email"><i class="fas fa-envelope text-warning"></i> Email</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Contact Input Field -->
                                                <div id="contactInputDiv" class="mb-3 d-none">
                                                    <label id="contactLabel" class="form-label fw-bold"></label>
                                                    <input type="text" id="contactInput" class="form-control">
                                                </div>

                                                <!-- Inquiry Type -->
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">{{ __('Your Inquiry') }}</label>
                                                    <select class="form-select" name="inquiry" required>
                                                        <option value="" selected disabled>-- Select an option --</option>
                                                        <option value="What is the final price?">What is the final price?</option>
                                                        <option value="Can I view the property?">Can I view the property?</option>
                                                        <option value="I need more information, please contact me.">I need more information, please contact me.</option>
                                                    </select>
                                                </div>

                                                <!-- Language Selection -->
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">{{ __('Preferred Language(s)') }}</label>
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="language[]" value="Turkish" id="lang_turkish">
                                                            <label class="form-check-label" for="lang_turkish">🇹🇷 Turkish</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="language[]" value="English" id="lang_english">
                                                            <label class="form-check-label" for="lang_english">English</label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="language[]" value="Arabic" id="lang_arabic">
                                                            <label class="form-check-label" for="lang_arabic">Arabic</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="text-center">
                                                    <button type="submit" style="color:white;" class="btn btn-danger w-100"><i class="fas fa-paper-plane"></i> {{ __('Send Message') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($property->property_agent->phone)
                        <div class="d-grid">
                            <button class="ud-btn btn-thm" type="button" id="show_phone">
                                {{__('user.Show Phone Number')}}
                                <i class="fal fa-arrow-right-long"></i>
                            </button>
                            <div class="single-contant ml20 ml0-xs text-center mb-3 d-none "
                            id="phone_div">
                            <a target="_blank" href="tel:{{$property->property_agent->phone ?? ''}}"
                               class=" h5 title mb-0">{{$property->property_agent->phone ?? ''}}</a>
                           </div>
                       </div>
                       @endif
                       @if($property->property_agent->whatsapp)
                       <div class="d-grid mt-2">
                        <button class="ud-btn btn-thm" type="button" id="show_whatsapp">
                            {{__('user.Show Whatsapp Number')}}
                            <i class="fal fa-arrow-right-long"></i>
                        </button>
                        <div class="single-contant ml20 ml0-xs text-center mb-3 d-none"
                        id="whatsapp_div">
                        <a target="_blank"
                        href="https://wa.me/{{$property->property_agent->whatsapp ?? ''}}"
                        class=" h5 title mb-0">{{$property->property_agent->whatsapp ?? ''}}</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="mt-5">
                <h2 class="title">{{__('agent.Similar Homes')}}</h2>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="property-city-slider navi_pagi_top_right slider-dib-sm slider-3-grid owl-theme owl-carousel new_stH">
                @foreach($similars as $same)
                <div class="item">
                    <div style="min-height: 430px !important;" class="listing-style1" data-property-id="{{ $same->id }}" >
                        <a href="{{route('property_details',['slug' => $same->slug])}}">
                            <div class="list-thumb flex-shrink-0 list-thumbNew">
                                <img
                                src="{{$same->preview_image !='' ? asset($same->preview_image) :asset('agent/images/placeholder.png') }}"
                                alt="">

                                @if($same->highlight == 'true')
                                <div class="list-tag fz12"><span
                                    class="flaticon-electricity me-2"></span>FEATURED
                                </div>
                                @endif
                            </div>
                        </a>
                        <style type="text/css">
                            .list-title {
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                                min-height: 2.8em;
                                line-height: 1.4em;
                                text-overflow: ellipsis;
                            }

                        </style>
                        <div class="list-content">
                            <a href="{{route('property_details',['slug' => $same->slug])}}">
                                <div class="d-flex align-items-start justify-content-between flex-row">
                                    <div>
                                        <div class=" h5 mb-1">{{getCurrency($same->price_in_usd,$same->currency_id,$same->price)}}</div>
                                        <h6 class="list-title fixed-title"> {{compiledText('title',$same->property_type_id,$same->id)}} </h6>
                                        <p class="list-text">{{$same->property_city->title}} / {{$same->property_town->title}} / {{$same->property_district->title}}</p>
                                    </div>

                                </div>
                            </a>
                            {{--                                                //show the property attribute icons with thire value--}}
                            @if($same->property_type_id == 1)
                            <div class="list-meta d-flex align-items-center flex-row">
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/bed.svg')}}"> {{$same->apartment_attribute->bed_rooms ?? ''}}
                                </a>
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/couch.svg')}}"> {{$same->apartment_attribute->living_rooms ?? ''}}
                                </a>

                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/bathroom.svg')}}"> {{$same->apartment_attribute->bath_rooms ?? ''}}
                                </a>
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/floor.svg')}}"> {{ getFloorLabel($same->apartment_attribute->floors ?? '') }}
                                </a>

                            </div>
                            @elseif($same->property_type_id == 2)
                            <div class="list-meta d-flex align-items-center flex-row">
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/bed.svg')}}"> {{$same->villa_attribute->bed_rooms ?? ''}}
                                </a>
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/couch.svg')}}"> {{$same->villa_attribute->living_rooms ?? ''}}
                                </a>

                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/bathroom.svg')}}"> {{$same->villa_attribute->bath_rooms ?? ''}}
                                </a>
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/floor.svg')}}"> {{$same->villa_attribute->floors ?? ''}}
                                </a>
                            </div>
                            @elseif($same->property_type_id == 3)
                            <div class="list-meta d-flex align-items-center flex-row">
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/bed.svg')}}"> {{$same->house_attribute->bed_rooms ?? ''}}
                                </a>
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/couch.svg')}}"> {{$same->house_attribute->living_rooms ?? ''}}
                                </a>

                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/bathroom.svg')}}"> {{$same->house_attribute->bath_rooms ?? ''}}
                                </a>
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/floor.svg')}}"> {{$same->house_attribute->floors ?? ''}}
                                </a>
                            </div>
                            @elseif($same->property_type_id == 4)
                            <div class="list-meta d-flex align-items-center flex-row">
                                {{--                                                <a class="d-flex gap-2 align-items-center" ><img--}}
                                    {{--                                                        src="{{asset('agent/images/icon/length.svg')}}"> {{$same->building_attribute->grossm2 ?? ''}}--}}
                                {{--                                                </a>--}}
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/floor.svg')}}"> {{$same->building_attribute->floors ?? ''}}
                                </a>
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/age.svg')}}"> {{$same->building_attribute->age ?? ''}}
                                </a>
                            </div>
                            @elseif($same->property_type_id == 5)
                            <div class="list-meta d-flex align-items-center flex-row d-none">
                                <a class="d-flex gap-2 align-items-center" ><img
                                    src="{{asset('agent/images/icon/length.svg')}}"> {{$same->building_attribute->landm2 ?? ''}}
                                </a>
                                {{--                                                <a class="d-flex gap-2 align-items-center" ><img--}}
                                    {{--                                                        src="{{asset('agent/images/icon/price.svg')}}"> {{$same->building_attribute->pricem2 ?? ''}}--}}
                                {{--                                                </a>--}}
                            </div>
                            @endif
                            <hr class="mt-2 mb-2">
                            <div class="list-meta2 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center justify-content-between gap-2 d-none">
                                    <span class="flaticon-user"></span>
                                    <span>{{$same->property_agent->fname ?? ''}} {{$same->property_agent->lname ?? ''}}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-2 minW100">
                                    <div class="">
                                        <a onclick="toggleFavorite(`{{$same->id}}`)" id="favoriteIcon{{$property->id}}">
                                            <span id="heartIcon{{$same->id}}" class="fa fs-6 fa-heart"></span>
                                        </a>
                                    </div>
                                    <div>
                                        <i class="far fs-6 fa-calendar"></i>
                                        <span>{{date('d-m-Y',strtotime($same->create_date))}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    document.getElementById("messageForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch("{{ url('/send-message') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Accept": "application/json"
            },
            body: formData
        })
        .then(response => response.text())  // First, read the raw response
        .then(text => {
            console.log("Raw Response:", text);
            return JSON.parse(text); // Try to parse it manually
        })
        .then(data => {
            if (data.success) {
                // alert("Message sent successfully!");
                document.getElementById("messageForm").reset();
                let modal = bootstrap.Modal.getInstance(document.getElementById("messageModal"));
                if (modal) {
                    modal.hide();
                }
            } else {
                alert("Error: " + (data.error || "Failed to send message."));
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            alert("A network error occurred. Check console for details.");
        });
    });

    // Functionality to show input field based on contact method selection
    document.querySelectorAll('input[name="contact_method"]').forEach(radio => {
        radio.addEventListener("change", function () {
            let contactInputDiv = document.getElementById("contactInputDiv");
            let contactInput = document.getElementById("contactInput");
            let contactLabel = document.getElementById("contactLabel");

            contactInputDiv.classList.remove("d-none"); // Show the input field

            if (this.value === "WhatsApp") {
                contactLabel.textContent = "Enter your WhatsApp Number:";
                contactInput.type = "tel";
                contactInput.placeholder = "e.g., +123456789";
                contactInput.name = "contact";
            } else if (this.value === "Phone") {
                contactLabel.textContent = "Enter your Phone Number:";
                contactInput.type = "tel";
                contactInput.placeholder = "e.g., +987654321";
                contactInput.name = "contact";
            } else if (this.value === "Email") {
                contactLabel.textContent = "Enter your Email Address:";
                contactInput.type = "email";
                contactInput.placeholder = "e.g., example@email.com";
                contactInput.name = "contact";
            }
        });
    });
</script>
<script>
    $("#show_phone").click(function (e) {
        e.preventDefault();
        $("#phone_div").removeClass('d-none');
        $("#show_phone").addClass('d-none');
    });
    $("#show_whatsapp").click(function (e) {
        e.preventDefault();
        $("#whatsapp_div").removeClass('d-none');
        $("#show_whatsapp").addClass('d-none');
    });

    function testingspan() {

        var dataValue = window.location.href;
        navigator.clipboard.writeText(dataValue);
        Swal.fire(lang["Success"], lang["Property link is copied you can share it."], "success");
    }

</script>
<script>

    setTimeout(function () {
        initMap({{floatval($property->latitude)}}, {{floatval($property->longitude)}}, false);
        $("#map_div").removeClass('d-none')
    }, 1000);
</script>
<script>
        // $('.sp-img-content .hidden').hide();

    $(document).ready(function () {

            // Get the array of favorite property IDs from local storage
            var favoritePropertyIdsStr = localStorage.getItem('favorites') || '[]'; // Default to empty array if no favorites are stored
            // Remove single quotes from the beginning and end of the string
            favoritePropertyIdsStr = favoritePropertyIdsStr.replace(/^'(.*)'$/, '$1');
            var favoritePropertyIds = JSON.parse(favoritePropertyIdsStr);


            // for the single property on the top icon
            var fav_icon = $(".fav_icon").data('fav-icon').toString(); // Assuming you have a data attribute containing the property ID

            if (favoritePropertyIds.includes(fav_icon)) {

                // Property is a favorite, so set the heart icon to filled
                $(this).find('.fav_icon').addClass('text-danger');
            } else {
                // Property is not a favorite, so set the heart icon to empty
                $(this).find('.fav_icon').removeClass('text-danger');
            }

            // Loop through each property
            $('.listing-style1').each(function() {
                var propertyId = $(this).data('property-id').toString(); // Assuming you have a data attribute containing the property ID

                // Check if the property ID exists in the array of favorite property IDs
                if (favoritePropertyIds.includes(propertyId)) {

                    // Property is a favorite, so set the heart icon to filled
                    $(this).find('.fa-heart').addClass('text-danger');
                } else {
                    // Property is not a favorite, so set the heart icon to empty
                    $(this).find('.fa-heart').removeClass('text-danger');
                }
            });
        });
    </script>

    @endsection
    <style>
        .listing-style1 {
            height: 500px; 
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>