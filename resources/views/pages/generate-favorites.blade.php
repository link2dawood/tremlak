
@forelse($similars as $same)
    <div class="item col-md-4 " id="card_div{{$same->id}}">
        <div class="listing-style1 position-relative" style="min-height: 430px !important;">
            <a href="{{route('property_details',['slug' => $same->slug])}}">
                <div class="list-thumb flex-shrink-0 list-thumbNew">
                    <img class="w-100"
                         src="{{$same->preview_image !='' ? asset($same->preview_image) :asset('agent/images/placeholder.png') }}"
                         alt="">

                    @if($same->highlight == 'true')
                        <div class="list-tag fz12"><span
                                class="flaticon-electricity me-2"></span>FEATURED
                        </div>
                    @endif
                </div>
            </a>
            <div class="list-content">
                <a href="{{route('property_details',['slug' => $same->slug])}}">
                    <div class="d-flex align-items-start justify-content-between flex-row">
                        <div>
                            <div class=" h5 mb-1">{{getCurrency($same->price_in_usd,$same->currency_id,$same->price)}}</div>
                            <h6 class="list-title"> {{compiledText('title',$same->property_type_id,$same->id)}} </h6>
                            <p class="list-text">{{$same->property_city->title}}
                                / {{$same->property_town->title}}
                                / {{$same->property_district->title}}</p>
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
                                src="{{asset('agent/images/icon/floor.svg')}}">{{ getFloorLabel($same->apartment_attribute->floors ?? '') }}
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
{{--                        <a class="d-flex gap-2 align-items-center" ><img--}}
{{--                                src="{{asset('agent/images/icon/length.svg')}}"> {{$same->building_attribute->grossm2 ?? ''}}--}}
{{--                        </a>--}}
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
                        <a class="d-flex gap-2 align-items-center" ><img
                                src="{{asset('agent/images/icon/price.svg')}}"> {{$same->building_attribute->pricem2 ?? ''}}
                        </a>
                    </div>
                @endif
                <hr class="mt-2 mb-2">
{{--                <div class="">--}}
{{--                    <!--<div class="d-flex align-items-end gap-2 d-none">-->--}}
{{--                    <!--    <span class="flaticon-user"></span>-->--}}
{{--                    <!--    <span>{{$same->property_agent->fname}} {{$same->property_agent->lname}}</span>-->--}}
{{--                    <!--</div>-->--}}
{{--                    <div class="text-center mt-2 position-absolute trash_btn">--}}
{{--                        <a onclick="removeFavorite(`{{$same->id}}`)"><span class="fa fs-6 fa-trash-alt"></span></a>--}}
{{--                        <i class="fa fa-calendar"></i>--}}
{{--                       <span>{{date('d-m-Y',strtotime($same->create_date))}}</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="d-flex align-items-end justify-content-between text-end gap-2 w-100">
                    <a class="btn btn-sm btn-danger text-white" onclick="removeFavorite(`{{$same->id}}`)">
                        <span class="fa fs-6 fa-trash-alt"></span>
                    </a>
                    <a>
                        <i class="far  fs-6 fa-calendar"></i>
                        <span>{{date('d-m-Y',strtotime($same->create_date))}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@empty
    <h2 class="text-center my-3">{{__('user.No property in your favorite list')}}</h2>
@endforelse

