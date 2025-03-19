@extends('pages.layouts.master')
@section('pageTitle',__('user.contact'))
@section('content')
    <!-- Our Contact With Map -->
    <section class="p-0">
        <iframe loading="lazy" class="home8-map contact-page" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6342301.000437545!2d35.129329549999994!3d39.0876459!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b0155c964f2671%3A0x40d9dbd42a625f2a!2zVMO8cmtpeWU!5e0!3m2!1sen!2s!4v1704181614349!5m2!1sen!2s"  aria-label="Turkey"></iframe>
    </section>
    <section>
        <div class="container">
            <div class="row d-flex align-items-end">
                <div class="col-lg-5 position-relative">
                    <div class="home8-contact-form default-box-shadow1 bdrs12 bdr1 p30 mb30-md bgc-white">
                        <h4 class="form-title mb25">{{__('user.Have questions? Get in touch!')}}</h4>

                        <form class="form-style1" id="contact_us">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw600 mb10">{{__('user.Full Name')}}</label>
                                        <input type="text" id="name" class="form-control" required placeholder="{{__('user.Your Name')}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw600 mb10">{{__('user.Email')}}</label>
                                        <input type="email" id="email" class="form-control" required placeholder="{{__('user.Your Email')}}">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw600 mb10">{{__('user.Subject')}}</label>
                                        <input type="text" id="subject" class="form-control" required placeholder="{{__('user.Your Subject')}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb10">
                                        <label class="heading-color ff-heading fw600 mb10">{{__('user.Message')}}</label>
                                        <textarea cols="30" rows="4" id="message" required placeholder="{{__('user.There are many variations of passages.')}}"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-grid">
                                        <button class="ud-btn btn-thm" id="submit_btn" type="submit">{{__('user.Submit')}}<i class="fal fa-arrow-right-long"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-5 offset-lg-2">
                    <h2 class="mb30 text-capitalize">{{__('user.We’d Love To Hear From You.')}}</h2>
                    <p class="text">{{__('user.lorem contact')}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Explore Apartment -->
    <section class=" d-none pt0 pb90 pb10-md">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms">
                    <div class="main-title text-center">
                        <h2 class="title">Visit Our Office</h2>
                        <p class="paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 wow fadeInLeft" data-wow-delay="00ms">
                    <div class="iconbox-style8 text-center">
                        <!--              <div class="icon"><img src="images/icon/paris.svg" alt=""></div>-->
                        <div class="iconbox-content">
                            <h4 class="title">Turkey</h4>
                            <p class="text mb-1">Adana City , Southern Turkey , Turkey</p>
                            <h6 class="mb10">(000)-000-0000</h6>
                            <a class="text-decoration-underline" href="#">Open Google Map</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay="300ms">
                    <div class="iconbox-style8 active text-center">
                        <!--              <div class="icon"><img src="images/icon/london.svg" alt=""></div>-->
                        <div class="iconbox-content">
                            <h4 class="title">Turkey</h4>
                            <p class="text mb-1">Adana City , Southern Turkey , Turkey</p>
                            <h6 class="mb10">(000)-000-0000</h6>
                            <a class="text-decoration-underline" href="#">Open Google Map</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay="300ms">
                    <div class="iconbox-style8 text-center">
                        <!--              <div class="icon"><img src="images/icon/new-york.svg" alt=""></div>-->
                        <div class="iconbox-content">
                            <h4 class="title">Turkey</h4>
                            <p class="text mb-1">Adana City , Southern Turkey , Turkey</p>
                            <h6 class="mb10">(000)-000-0000</h6>
                            <a class="text-decoration-underline" href="#">Open Google Map</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our CTA -->
    @include('pages.includes.need_help')
@endsection
