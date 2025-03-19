@extends('pages.layouts.master')
@section('pageTitle',__('Agent Details'))
@section('content')
    <!-- Agent Section Area -->
    <section class="agent-single pt-0">
        <div class="cta-agent bgc-thm-light mx-auto maxw1600 pt60 pb60 bdrs12 position-relative mx20-lg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7">
                        <div class="agent-single d-sm-flex align-items-center">
                            <div class="single-img mb30-sm">
                                <img style="width: 150px; height: 150px;"  class="rounded-circle" src="{{$user->image_path != '' ? asset($user->image_path) : asset('agent/images/placeholder.png') }}" alt="">
                            </div>
                            <div class="single-contant ml30 ml0-xs">
                                <h2 class="title mb-0">{{$user->name}}</h2>
                                <p class="fz15">{{__('user.Company Agent at')}} <b>{{$user->broker_office->title ?? ''}}</b></p>
                                <div class="agent-meta mb15 d-md-flex align-items-center">
{{--                                    <a class="text fz15 pe-2 bdrr1" href="#"><i class="fas fa-star fz10 review-color2 pr10"></i>5.0 • 49 Reviews</a>--}}
{{--                                    <a class="text fz15 pe-2 ps-2 bdrr1" href="mailto:{{$user->email}}"><i class="flaticon-email pe-1"></i>{{$user->email}}</a>--}}
                                    <a class="text fz15 ps-2" href="tel:{{$user->phone}}"><i class="flaticon-smartphone pe-1"></i></a>
                                    <a class="text {{$user->whatsapp == '' ? 'd-none' : ''}} fz15 ps-2" target="_blank" href="https://wa.me/{{$user->whatsapp ?? ''}}"><i class="flaticon-whatsapp pe-1"></i></a>
                                </div>
                                <div class="agent-social">
                                    <a class="mr20" href="{{$user->agent_social_links->facebook ?? '#'}}"><i class="fab fa-facebook-f"></i></a>
                                    <a class="mr20" href="{{$user->agent_social_links->twitter ?? '#'}}"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16px" height="16px" viewBox="0,0,256,256"><g fill="#191818" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(16,16)"><path d="M2.29688,2c-0.244,0 -0.38514,0.27561 -0.24414,0.47461l4.43555,6.23047l-4.47461,5.29492h1.33203l3.74805,-4.44727l2.86719,4.02734c0.188,0.264 0.49145,0.41992 0.81445,0.41992h2.92773c0.244,0 0.38514,-0.27561 0.24414,-0.47461l-4.67188,-6.5625l4.18164,-4.96289h-1.30273l-3.48047,4.11914l-2.63477,-3.69922c-0.188,-0.264 -0.49145,-0.41992 -0.81445,-0.41992zM3.6543,3h1.57031l7.12109,10h-1.57031z"></path></g></g></svg></a>
                                    <a class="mr20" href="{{$user->agent_social_links->instagram ?? '#'}}"><i class="fab fa-instagram"></i></a>
{{--                                    <a href="{{$user->agent_social_links->linkedin ?? '#'}}"><i class="fab fa-linkedin-in"></i></a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-8 pr40 pr20-lg">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="agent-single-details mt30 pb30">
                                <h6 class="fz17 mb30">{{__('user.About')}} {{$user->name}}</h6>
                                <p class="text">{{$user->about_me}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="agent-single-form home8-contact-form default-box-shadow1 bdrs12 bdr1 p30 mb30-md bgc-white position-relative">
                        <h6 class="title fz17 ">{{__('user.Office Information')}}</h6>
                        <div class="mb35">
                            <img class="img-fluid bdrs12" src="{{$user->broker_office->image_path != '' ? asset($user->broker_office->image_path) : asset('agent/images/placeholder.png') }}">
                        </div>
                        <div class="list-news-style d-flex align-items-center justify-content-between mb10">
                            <div class="flex-shrink-0"><h6 class="fz14 mb-0">{{__('user.Office Name')}}</h6></div>
                            <div class="news-content flex-shrink-1 ms-3 text-end">
                                <p class="text mb-0 fz14">{{$user->broker_office->title ?? ''}}</p>
                            </div>
                        </div>
                        <div class="list-news-style d-flex align-items-center justify-content-between mb10">
                            <div class="flex-shrink-0"><h6 class="fz14 mb-0">{{__('user.City')}}</h6></div>
                            <div class="news-content flex-shrink-1 ms-3 text-end">
                                <p class="text mb-0 fz14">{{$user->broker_office->city_date->title ?? ''}}</p>
                            </div>
                        </div>
{{--                        <div class="list-news-style d-flex align-items-center justify-content-between">--}}
{{--                            <div class="flex-shrink-0"><h6 class="fz14 mb-0">{{__('user.Member since')}}</h6></div>--}}
{{--                            <div class="news-content flex-shrink-1 ms-3 text-end">--}}
{{--                                <p class="text mb-0 fz14">{{date('Y-m-d',strtotime($user->broker_office->create_date)) ?? ''}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
