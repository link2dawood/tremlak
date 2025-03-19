@extends('pages.layouts.master')
@section('pageTitle',__('user.about'))
@section('content')
    <section class="breadcumb-section2 p-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb-style1">
                        <h2 class="title">{{__('user.about')}}</h2>
                        <div class="breadcumb-list">
                            <a href="{{route('/')}}">{{__('user.home')}}</a>
                            <a href="#">{{__('user.about')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our About Area -->
    <section class="our-about pb90">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-6">
                    <h2>{{__('user.We’re on a Mission to Change View of Real Estate Field.')}}</h2>
                </div>
                <div class="col-lg-6">
                    <p class="text mb25">{{__('user.about text 1')}}</p>
                    <p class="text mb55">{{__('user.about text 2')}}</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="why-chose-list style3">
                                <div class="list-one mb30">
                                    <span class="list-icon flex-shrink-0 flaticon-garden mb20"></span>
                                    <div class="list-content flex-grow-1">
                                        <h6 class="mb-1">{{__('user.Modern Villa')}}</h6>
                                        <p class="text mb-0 fz14">{{__('user.Modern Villa text')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="why-chose-list style3">
                                <div class="list-one mb30">
                                    <span class="list-icon flex-shrink-0 flaticon-secure-payment mb20"></span>
                                    <div class="list-content flex-grow-1">
                                        <h6 class="mb-1">{{__('user.Secure Payment')}}</h6>
                                        <p class="text mb-0 fz14">{{__('user.Secure Payment text')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Agents -->
    <section class="pt-0 pb80 pb50-md d-none">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                <div class="col-lg-9 mx-auto text-center">
                    <div class="main-title2">
                        <h2 class="title">Our Exclusive Agents</h2>
                        <p class="paragraph">Aliquam lacinia diam quis lacus euismod</p>
                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="300ms">

                <div class="col-auto">
                    <div class="feature-style2 mb30">
                        <div class="feature-img"><img class="bdrs12" src="{{asset('agent/images/team/agent-8.jpg')}}" alt=""></div>
                        <div class="feature-content pt20">
                            <h6 class="title mb-1">Cody Fisher</h6>
                            <p class="text fz15">Broker</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- CTA Banner -->
    <section class="pt-0 pb-0">
        <div class="cta-banner3 bgc-thm-light mx-auto maxw1600 pt100 pt60-lg pb90 pb60-lg bdrs24 position-relative overflow-hidden mx20-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-5 pl30-md pl15-xs wow fadeInRight" data-wow-delay="500ms">
                        <div class="mb30">
                            <h2 class="title text-capitalize">{{__('user.Let’s Find The Right Selling Option For You')}}</h2>
                        </div>
                        <div class="why-chose-list style2">
                            <div class="list-one d-flex align-items-start mb30">
                                <span class="list-icon flex-shrink-0 flaticon-security"></span>
                                <div class="list-content flex-grow-1 ml20">
                                    <h6 class="mb-1">{{__('user.Property Management')}}</h6>
                                    <p class="text mb-0 fz15">{{__('user.Property Management text')}}</p>
                                </div>
                            </div>
                            <div class="list-one d-flex align-items-start mb30">
                                <span class="list-icon flex-shrink-0 d-flex justify-content-center align-items-center "><i class="fa fa-globe"></i></span>
                                <div class="list-content flex-grow-1 ml20">
                                    <h6 class="mb-1">{{__('user.Language Services')}}</h6>
                                    <p class="text mb-0 fz15">{{__('user.Language Services text')}}</p>
                                </div>
                            </div>
                            <div class="list-one d-flex align-items-start mb30">
                                <span class="list-icon flex-shrink-0 flaticon-investment"></span>
                                <div class="list-content flex-grow-1 ml20">
                                    <h6 class="mb-1">{{__('user.Currency Services')}}</h6>
                                    <p class="text mb-0 fz15">{{__('user.Currency Services text')}}</p>
                                </div>
                            </div>
                        </div>
                        <a href="{{asset('properties')}}" class="ud-btn btn-dark">{{__('user.properties')}}<i class="fal fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our CTA -->
    @include('pages.includes.need_help')
@endsection
