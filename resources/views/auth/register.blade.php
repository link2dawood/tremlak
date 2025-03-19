@extends('pages.layouts.master')
@section('pageTitle',__('Register'))
@section('content')
    <section class="our-compare pt60 pb60">
        {{--        <img src="{{asset('agent/images/icon/register-page-icon.svg')}}" alt="" class="login-bg-icon wow fadeInLeft" data-wow-delay="300ms">--}}
        <div class="container">
            <div class="row wow fadeInRight" data-wow-delay="300ms">
                <div class="col-lg-8 mx-auto">
                    <div class="log-reg-form signup-modal form-style1 bgc-white p50 p30-sm default-box-shadow2 bdrs12 border">
                        <div class="text-center mb-3">
                            <img class="mb-0" src="{{asset('agent/images/header-logo2.svg')}}" alt="">
                            <h2 class="mb-0">{{__('agent.Create account')}}</h2>
                            <p class="text mb-0">{{__('agent.Create account and get access of this website.')}}</p>
                        </div>
                        <form method="POST" class="row " action="{{ route('register') }}">
                            @csrf

                            <div class="col-md-12 my-2">
                                <label class="custom_checkbox fz14 d-flex align-items-center gap-2 ff-heading @error('confirmation') is-invalid @enderror" >
                                    <span class="fw-bold" style="padding-top: 3px;font-size: 16px">{{__('agent.I confirm that I am an officially licensed real estate agent in Türkiye')}}</span>
                                    <input class="mb-2" type="checkbox"  name="confirmation">
                                    <span class="checkmark"></span>
                                </label>
                                @error('confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb15 col-md-6">
                                <label class="form-label fw600 dark-color">{{__('agent.First name')}}</label>
                                <input type="text" value="{{ old('fname') ?? '' }}" class="form-control @error('fname') is-invalid @enderror" name="fname" placeholder="{{__('agent.Enter First name')}}">
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb15 col-md-6">
                                <label class="form-label fw600 dark-color">{{__('agent.Last name')}}</label>
                                <input type="text" value="{{ old('lname') ?? '' }}" class="form-control @error('lname') is-invalid @enderror" name="lname" placeholder="{{__('agent.Enter Last name')}}">
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb15 col-md-12">
                                <label class="form-label fw600 dark-color">{{__('agent.Email')}}</label>
                                <input type="email"  value="{{ old('email') ?? '' }}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{__('agent.Enter Email')}}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb15 col-md-6">
                                <label class="form-label fw600 dark-color">{{__('agent.Password')}}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{__('agent.Enter Password')}}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb15 col-md-6">
                                <label class="form-label fw600 dark-color">{{__('agent.Confirm Password')}}</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="{{__('agent.Enter Confirm Password')}}">
                            </div>
{{--                            <h4 class="my-2">{{__('agent.Broker Office')}}</h4>--}}
{{--                            <div class="mb15 col-md-6">--}}
{{--                                <label class="form-label fw600 dark-color">{{__('agent.Name of the real estate agency')}}</label>--}}
{{--                                <input type="text" value="{{ old('title') ?? '' }}" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="{{__('agent.Name of the real estate agency')}}">--}}
{{--                                @error('title')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="mb15 col-md-6">--}}
{{--                                <label class="form-label fw600 dark-color">{{__('agent.Real Estate Trade Certificate No')}}</label>--}}
{{--                                <input type="text" value="{{ old('certificate_no') ?? '' }}" class="form-control @error('certificate_no') is-invalid @enderror" name="certificate_no" placeholder="{{__('agent.Real Estate Trade Certificate No')}}">--}}
{{--                                @error('certificate_no')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="mb15 col-md-6">--}}
{{--                                <label class="form-label fw600 dark-color">{{__('agent.Real Estate City')}}</label>--}}
{{--                                <div class="bootselect-multiselect my-1">--}}
{{--                                    <select class="selectpicker" data-live-search="true"  title="{{__('user.City')}}"  name="city_id" data-width="100%">--}}
{{--                                        @foreach($cities_global as $city)--}}
{{--                                            <option value="{{$city->id}}">{{$city->title}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                @error('city_id')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                            <div class="mb15 col-md-6">--}}
{{--                                <label class="form-label fw600 dark-color">{{__('agent.Agency Logo')}}</label>--}}
{{--                                <input type="file"  accept="image/png, image/gif, image/jpeg" class="form-control registerFile @error('image_path') is-invalid @enderror" name="image_path" placeholder="{{__('agent.Agency Logo')}}">--}}
{{--                                @error('image_path')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                            <div class="d-grid mb15 ">
                                <button class="ud-btn btn-thm" type="submit">{{__('agent.Register')}}<i class="fal fa-arrow-right-long"></i></button>
                            </div>
                            <div class="hr_content mb15"><hr><span class="hr_top_text">OR</span></div>
                        </form>
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
                        <p class="dark-color text-center mb0 mt10">{{__('agent.Have an account?')}} <a class="dark-color fw600" href="{{route('login')}}">{{__('agent.Login')}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
{{--    <script>--}}
{{--        $('#confirmation').change(function(){--}}
{{--            // Set the second checkbox's state to match the first checkbox--}}
{{--            $('#confirmation2').prop('checked', $(this).is(':checked'));--}}
{{--        });--}}
{{--    </script>--}}
@endsection
