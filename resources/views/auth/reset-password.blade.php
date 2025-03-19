@extends('pages.layouts.master')
@section('pageTitle','Reset Password')
@section('content')
    <section class="our-compare pt60 pb60">
        <img src="{{asset('agent/images/icon/login-page-icon.svg')}}" alt="" class="login-bg-icon wow fadeInLeft" data-wow-delay="300ms">
        <div class="container">
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-lg-6">
                    <div class="log-reg-form signup-modal form-style1 bgc-white p50 p30-sm default-box-shadow2 bdrs12">
                        <div class="text-center mb40">
                            <img class="mb15" src="{{asset('agent/images/header-logo2.svg')}}" alt="">
                            <h2>{{__('Reset Password')}}</h2>
                            
                        </div>
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="mb15">
                                <label class="form-label fw600 dark-color">Email</label>
                                <input type="email"  value="{{ $request->email ?? old('email') }}" autocomplete="email" autofocus required class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb15">
                                <label class="form-label fw600 dark-color">Password</label>
                                <input type="password" required class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb15">
                                <label class="form-label fw600 dark-color">Confirm Password</label>
                                <input type="password" required class="form-control" name="password_confirmation" id="c_password" placeholder="Confirm Password">
                            </div>

                            <div class="d-grid mb15">
                                <button class="ud-btn btn-thm" type="submit">{{ __('Reset Password') }}<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

