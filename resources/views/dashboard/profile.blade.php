@extends('dashboard.layouts.master')
@section('pageTitle',__('user.My Profile'))
@section('content')
<div class="dashboard__content property-page bgc-f7">
    <div class="row align-items-center pb40">
        <div class="col-lg-12">
            <div class="dashboard_title_area">
                <h2>{{__('user.My Profile')}}</h2>
                <p class="text">{{__('agent.We are glad to see you again!')}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="col-xl-12 profile-content-styles">
                    <div class="profile-box position-relative mb40 ">
                        <div class="profile-img">
                            <div class="profile-content ">
                                <label class="position-relative" for="profile_image">
                                    <input type="file" id="profile_image" class="mb-0 profileImage" value="Add Image" hidden="">
                                    <i class="fa fa-pencil position-absolute"></i>
                                </label>
                                <img class="rounded-circle" style="object-fit: cover"
                                src="{{ Auth::user()->image_path !='' ? asset(Auth::user()->image_path) : asset('agent/images/placeholder.png')  }}"
                                alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <form class="form-style1" id="update_profile_agent">
                        <div class="row">
                            <div class="col-sm-6 col-xl-4">
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.First name')}}</label>
                                    <input type="text" class="form-control" required id="fname"
                                    value="{{Auth::user()->fname}}" placeholder="{{__('agent.First name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Last name')}}</label>
                                    <input type="text" class="form-control" required id="lname"
                                    value="{{Auth::user()->lname}}" placeholder="{{__('agent.Last name')}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Email')}}</label>
                                    <input type="email" required id="email" class="form-control"
                                    value="{{Auth::user()->email}}" placeholder="{{__('agent.Email')}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Phone Number')}}</label>
                                    <input type="tel" class="form-control" required id="phone"
                                    value="{{Auth::user()->phone}}"
                                    placeholder="{{__('agent.Your Phone Number')}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Whatsapp Number')}}</label>
                                    <input type="tel" class="form-control" required id="whatsapp"
                                    value="{{Auth::user()->whatsapp}}"
                                    placeholder="{{__('agent.Your Whatsapp Number')}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-4">
                                <div class="mb20">
                                    <label class="heading-color ff-heading fw600 mb10">{{__('agent.Website')}}</label>
                                    <input type="url" id="website" class="form-control"
                                    value="{{Auth::user()->website}}"
                                    placeholder="{{__('agent.Your Website')}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-end">
                                    <button class="ud-btn btn-dark" id="update_profile_sub_btn" type="submit">
                                        {{__('agent.Update Profile')}}
                                        <i class="fal fa-arrow-right-long"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">{{__('agent.Broker Office')}}</h4>
                <form class="form-style1" id="update_broker_office">
                    <input type="hidden" id="office_id" value="{{Auth::user()->broker_office_id}}">
                    <div class="row">
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="form-label fw600 dark-color">{{__('agent.Name of the real estate agency')}}</label>
                                <input type="text" value="{{ Auth::user()->broker_office->title ?? '' }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="{{__('agent.Name of the real estate agency')}}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="form-label fw600 dark-color">{{__('agent.Real Estate Trade Certificate No')}}</label>
                                <input type="text" 
                                value="{{ Auth::user()->broker_office?->certificate_no ?? '' }}" 
                                class="form-control form-control-lg @error('certificate_no') is-invalid @enderror" 
                                id="certificate_no" 
                                placeholder="{{__('agent.Real Estate Trade Certificate No')}}">

                                <label class="form-label fw600 dark-color">
                                    <input type="checkbox" 
                                    value="" 
                                    {{ Auth::user()->broker_office?->certificate_no_later == 'true' ? 'checked' : '' }} 
                                    class="" 
                                    id="certificate_no_later" 
                                    placeholder="">
                                    {{__('agent.I will submit it later')}}
                                </label>

                                @error('certificate_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="form-label fw600 dark-color">{{__('agent.Real Estate City')}}</label>
                                <div class="bootselect-multiselect my-1">
                                    <select class="selectpicker" data-live-search="true"  title="{{__('user.City')}}"  id="city_id" data-width="100%">
                                        @foreach($cities_global as $city)
                                        <option {{ (Auth::user()->broker_office && Auth::user()->broker_office->city_id == $city->id) ? 'selected' : '' }} value="{{$city->id}}">{{$city->title}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="form-label fw600 dark-color">{{__('agent.Agency Logo')}}</label>
                                <input type="file"  accept="image/png, image/gif, image/jpeg" class="form-control form-control-lg profile_file_input @error('image_path') is-invalid @enderror" id="image_path" placeholder="{{__('agent.Agency Logo')}}">
                                @error('image_path')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-12">
                            <div class="mb20">
                                @if( Auth::user()->broker_office && Auth::user()->broker_office->image_path != '')
                                <div class="single-img mb-2 profile_page_image">
                                    <img src="{{asset(Auth::user()->broker_office->image_path)}}">
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-end">
                                <button class="ud-btn btn-dark" id="update_broker_office_btn" type="submit">

                                    @if(Auth::user()->broker_office_id == '')
                                    {{__('agent.Add Office')}}
                                    @else
                                    {{__('agent.Update Office')}}
                                    @endif

                                    <i class="fal fa-arrow-right-long"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">{{__('agent.Social Media')}}</h4>
                <form class="form-style1" id="update_social_links">
                    <div class="row">
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">{{__('agent.Facebook')}}</label>
                                <input type="url" id="facebook" value="{{@$social_links->facebook}}"
                                class="form-control"
                                placeholder="{{__('agent.Facebook')}} {{__('agent.Link')}}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">{{__('agent.Instagram')}}</label>
                                <input type="url" id="instagram" value="{{@$social_links->instagram}}"
                                class="form-control"
                                placeholder="{{__('agent.Instagram')}} {{__('agent.Link')}}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">{{__('agent.Twitter')}}</label>
                                <input type="url" id="twitter" value="{{@$social_links->twitter}}"
                                class="form-control"
                                placeholder="{{__('agent.Twitter')}} {{__('agent.Link')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-end">
                                <button class="ud-btn btn-dark" id="update_social_links_btn" type="submit">
                                    {{__('agent.Update Social')}}
                                    <i class="fal fa-arrow-right-long"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">{{__('agent.Change password')}}</h4>
                <form class="form-style1" id="update_password">
                    <div class="row">
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">{{__('agent.Old Password')}}</label>
                                <input type="password" class="form-control" id="old_password" required
                                placeholder="{{__('agent.Your Old Password')}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">{{__('agent.New Password')}}</label>
                                <input type="password" class="form-control" required id="new_password"
                                placeholder="{{__('agent.Your New Password')}}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-4">
                            <div class="mb20">
                                <label class="heading-color ff-heading fw600 mb10">{{__('agent.Confirm New Password')}}</label>
                                <input type="password" class="form-control" required id="confirm_password"
                                placeholder="{{__('agent.Confirm New Password')}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-end">
                                <button class="ud-btn btn-dark" id="update_password_btn" type="submit">
                                    {{__('agent.Change Password')}}
                                    <i class="fal fa-arrow-right-long"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $("#profile_li").addClass('-is-active');
    });

        // function readURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //         reader.onload = function(e) {
        //             $('#imagePreview').css('background-image', 'url('+e.target.result +')');
        //             $('#imagePreview').hide();
        //             $('#imagePreview').fadeIn(650);
        //         }
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }
        // $("#imageUpload").change(function() {
        //     readURL(this);
        // });
</script>
@endsection
