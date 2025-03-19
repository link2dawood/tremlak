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
