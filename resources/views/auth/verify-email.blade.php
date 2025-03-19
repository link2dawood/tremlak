@extends('pages.layouts.master')
@section('pageTitle','Email Verification')
@section('content')
    <section class="our-compare pt60 pb60">
        <img src="{{asset('agent/images/icon/login-page-icon.svg')}}" alt="" class="login-bg-icon wow fadeInLeft" data-wow-delay="300ms">
        <div class="container">
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-lg-6">
                    <div class=" my-5 log-reg-form signup-modal form-style1 bgc-white p50 p30-sm default-box-shadow2 bdrs12">
                        <div class="mb40">
                            <img class="mb15" src="{{asset('agent/images/header-logo2.svg')}}" alt="">

                            <p class="text mb-2">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
                        </div>
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif
                        <div class="mt-4 d-flex items-center justify-content-between ">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <button class="ud-btn btn-thm" type="submit"> {{ __('Resend Verification Email') }} <i class="fal fa-arrow-right-long"></i></button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button class="ud-btn btn-thm" type="submit"> {{ __('Log Out') }}<i class="fal fa-arrow-right-long"></i></button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
