@extends('pages.layouts.master')
@section('pageTitle',__('Login'))
@section('content')
    <section class="our-compare pt60 pb60">
{{--        <img src="{{asset('agent/images/icon/login-page-icon.svg')}}" alt="" class="login-bg-icon wow fadeInLeft" data-wow-delay="300ms">--}}
        <div class="container">
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-lg-6 mx-auto">
                    <div class="log-reg-form signup-modal border form-style1 bgc-white p50 p30-sm default-box-shadow2 bdrs12">
                        <div class="text-center mb40">
                            <img class="mb15" src="{{asset('agent/images/header-logo2.svg')}}" alt="">
                            <h2>{{__('agent.Sign in')}}</h2>
                            <p class="text">{{__('agent.Sign in with email and password.')}}</p>
                        </div>
                        <form  method="POST" action="{{ route('login') }}" >
                            @csrf
                            <div class="mb15">
                                <label class="form-label fw600 dark-color">{{__('agent.Email')}}</label>
                                <input type="email" required class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="{{__('agent.Enter Email')}}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb15">
                                <label class="form-label fw600 dark-color">{{__('agent.Password')}}</label>
                                <input type="password" class="form-control" required class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="{{__('agent.Enter Password')}}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="checkbox-style1 d-block d-sm-flex align-items-center justify-content-between mb10">
                                <label class="custom_checkbox fz14 ff-heading">{{__('agent.Remember me')}}
                                    <input type="checkbox" id="remember_me" name="remember" >
                                    <span class="checkmark"></span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="fz14 ff-heading" href="{{ route('password.request') }}">{{ __('agent.Forgot your password?') }}</a>
                                @endif
                            </div>
                            <div class="d-grid mb15">
                                <button class="ud-btn btn-thm" type="submit">{{__('agent.Login')}} <i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </form>
                        <div class="hr_content mb15"><hr><span class="hr_top_text">{{__('agent.OR')}}</span></div>
                        <form method="POST" action="{{route('redirectToGoogle')}}">
                            @csrf
                            <div class="col-md-12 my-2">
                                <label class="custom_checkbox fz14 d-flex align-items-center gap-2 ff-heading @error('confirmation2') is-invalid @enderror" >
                                    <span class="fw-bold" style="padding-top: 2px;font-size: 16px">{{__('agent.I confirm that I am an officially licensed real estate agent in Türkiye')}}</span>
                                    <input class="mb-2" type="checkbox"  name="confirmation2">
                                    <span class="checkmark"></span>
                                </label>
                                @error('confirmation2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="d-grid mb10">
                                <button type="submit" class="ud-btn btn-white fw400"><i class="fab fa-google"></i> {{__('agent.Continue With Google')}}</button>
                            </div>
                        </form>
                        <p class="dark-color text-center mb0 mt10">{{__('agent.Not register?')}}
                            <a class="dark-color fw600" href="{{route('register')}}">
                                {{__('agent.Create an account.')}}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
