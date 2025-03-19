@extends('pages.layouts.master')
@section('pageTitle','Forget Password')
@section('content')
    <section style="min-height: 100vh" class="our-compare pt60 pb60 align-items-center d-flex">
        <img src="{{asset('agent/images/icon/login-page-icon.svg')}}" alt="" class="login-bg-icon wow fadeInLeft"
             data-wow-delay="300ms">
        <div class="container">
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-lg-6">
                    <div class="log-reg-form signup-modal form-style1 bgc-white p50 p30-sm default-box-shadow2 bdrs12">
                        <div class="text-center mb40">
                            <img class="mb25" src="{{asset('/agent/images/header-logo2.svg')}}" alt="">
                            <h2>{{__('Forget Password')}}</h2>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb25">
                                <label class="form-label fw600 dark-color">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-grid mb20">
                                <button class="ud-btn btn-thm" type="submit">Submit<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
