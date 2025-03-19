@extends('admin.layouts.master')
@section('pageTitle', __('admin.Settings'))
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">{{__('admin.Settings')}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row mx-0">
            <div class="col-md-6 mb-5 d-flex">
                <div class="h-100">
                    <form class="row g-3 bg-white shadow p-3 rounded" id="update_settings">
                        <h3 class="">{{__('admin.Update Settings')}}</h3>
                        <div class="col-md-12">
                            <label for="site_name" class="form-label">{{__('admin.Enter Site Name')}}</label>
                            <input type="text" required placeholder="E.g website name" class="form-control"
                            value="{{$settings['site_name']}}" id="site_name">
                        </div>
                        <div class="col-md-12">
                            <label for="phone_number"
                            class="form-label">{{__('admin.Enter Contact Number')}}</label>
                            <input type="text" required placeholder="E.g +9263865892" class="form-control"
                            value="{{$settings['phone_number']}}" id="phone_number">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">{{__('admin.Enter Contact Email')}}</label>
                            <input type="text" required placeholder="E.g tremlak@gmail.com" class="form-control"
                            value="{{$settings['email']}}" id="email">
                        </div>
                        <div class="col-md-12">
                            <label for="logo" class="form-label">{{__('admin.Select Logo')}}</label>
                            <input type="file" accept="image/*" class="form-control" id="logo">
                        </div>
                        <div class="col-md-12">
                            <label for="offer_image"
                            class="form-label">{{__('admin.Select Credits Offer Image')}}</label>

                            <input type="file" accept="image/*" class="form-control" id="offer_image">
                            @if($settings->offer_image != '')
                            <div class="my-2 d-flex align-items-start justify-content-between">
                                <img class="rounded" src="{{asset($settings->offer_image)}}" style="height: 100px; width: 100px">
                                <button type="button" class="btn btn-danger"
                                onclick="removeCreditsOfferImage()"><i class="fa fa-trash"></i></button>
                            </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <button type="submit" id="update_settings_btn"
                            class="btn btn-dark">{{__('admin.Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-5 d-flex">
                <div class="h-100">
                    <form class="row g-3 bg-white shadow p-3 rounded" id="update_price">
                        <h3 class="">{{__('admin.Update Charges')}}</h3>
                        <div class="col-md-12">
                            <label for="credit_expiration_days"
                            class="form-label">{{__('admin.Credits expiration days')}}</label>
                            <input type="text" required placeholder="E.g 30 " class="form-control"
                            value="{{$settings->credit_expiration_days}}" id="credit_expiration_days">
                        </div>
                        <div class="col-md-12">
                            <label for="create_ad" class="form-label">{{__('admin.Ad creation credits')}}</label>
                            <input type="text" required placeholder="E.g 10" class="form-control"
                            value="{{$settings->create_ad}}" id="create_ad">
                        </div>
                        <div class="col-md-12">
                            <label for="renew_ad" class="form-label">{{__('admin.Ad Renewal credits')}}</label>
                            <input type="text" required placeholder="E.g 5" class="form-control"
                            value="{{$settings->renew_ad}}" id="renew_ad">
                        </div>
                        <div class="col-md-12">
                            <label for="free_images"
                            class="form-label">{{__('admin.Number of free image')}} </label>
                            <input type="text" required placeholder="E.g 5" class="form-control"
                            value="{{$settings->free_images}}" id="free_images">
                        </div>
                        <div class="col-md-12">
                            <label for="credits_per_image"
                            class="form-label">{{__('admin.Extra credits for each image')}} </label>
                            <input type="text" required placeholder="E.g 5" class="form-control"
                            value="{{$settings->credits_per_image}}" id="credits_per_image">
                        </div>
                        <div class="col-md-12">
                            <label for="credits_one_month"
                            class="form-label">{{__('admin.Credits for one month')}} </label>
                            <input type="text" required placeholder="E.g 5" class="form-control"
                            value="{{$settings->credits_one_month}}" id="credits_one_month">
                        </div>
                        <div class="col-md-12">
                            <label for="credits_two_month"
                            class="form-label">{{__('admin.Credits for two months')}} </label>
                            <input type="text" required placeholder="E.g 5" class="form-control"
                            value="{{$settings->credits_two_month}}" id="credits_two_month">
                        </div>
                        <div class="col-md-12">
                            <label for="credits_three_month"
                            class="form-label">{{__('admin.Credits for three months')}} </label>
                            <input type="text" required placeholder="E.g 5" class="form-control"
                            value="{{$settings->credits_three_month}}" id="credits_three_month">
                        </div>
                        <div class="col-md-12">
                            <label for="highlight_in_color"
                            class="form-label">{{__('admin.Ad feature credits')}}</label>
                            <input type="text" required placeholder="E.g 3" class="form-control"
                            value="{{$settings->highlight_in_color}}" id="highlight_in_color">
                        </div>
                        <div class="col-12">
                            <button type="submit" id="update_price_btn"
                            class="btn btn-dark">{{__('admin.Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-5 d-flex">
                <div class="h-100">
                    <form class="row g-3 bg-white shadow p-3 rounded" id="update_social_links_settings">
                        <h3 class="">{{__('admin.Update Social Media Links')}}</h3>
                        <div class="col-md-12">
                            <label for="youtube" class="form-label">{{__('admin.YouTube')}}</label>
                            <input type="url" required placeholder="https://www.youtube.com/" class="form-control"
                            value="{{$social_links->youtube ?? ''}}" id="youtube">
                        </div>
                        <div class="col-md-12">
                            <label for="instagram" class="form-label">{{__('admin.Instagram')}}</label>
                            <input type="url" required placeholder="https://www.instagram.com/" class="form-control"
                            value="{{$social_links->instagram ?? ''}}" id="instagram">
                        </div>
                        <div class="col-md-12">
                            <label for="tiktok" class="form-label">{{__('admin.TikTok')}}</label>
                            <input type="url" required placeholder="https://www.tiktok.com/" class="form-control"
                            value="{{$social_links->tiktok ?? ''}}" id="tiktok">
                        </div>
                        <div class="col-12">
                            <button type="submit" id="update_social_links_btn"
                            class="btn btn-dark">{{__('admin.Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 mb-5 d-flex">
                <div class="h-100">
                    <form class="row g-3 bg-white shadow p-3 rounded" id="update_seo_links">
                        <h3 class="">{{__('admin.Update SEO Details')}}</h3>
                        <div class="col-md-12">
                            <label for="seo_canonical" class="form-label">{{__('SEO Canonical')}}</label>
                            <input type="text" required class="form-control" placeholder="E.g canonical"
                            value="{{$settings->seo_canonical}}" id="seo_canonical">
                        </div>
                        <div class="col-md-12">
                            <label for="seo_author" class="form-label">{{__('admin.SEO Author')}}</label>
                            <input type="text" required class="form-control"
                            placeholder="{{__('admin.SEO Author')}}" value="{{$settings->seo_author}}"
                            id="seo_author">
                        </div>
                        <div class="col-md-12">
                            <label for="seo_keywords" class="form-label">{{__('admin.SEO Keywords')}}</label>
                            <input type="text" required class="form-control"
                            placeholder="{{__('admin.SEO Keywords')}}" value="{{$settings->seo_keywords}}"
                            id="seo_keywords">
                        </div>
                        <div class="col-md-12">
                            <label for="seo_description" class="form-label">{{__('admin.SEO Description')}}</label>
                            <input type="text" required class="form-control"
                            placeholder="{{__('admin.SEO Description')}}"
                            value="{{$settings->seo_description}}" id="seo_description">
                        </div>
                        <div class="col-12">
                            <button type="submit" id="update_seo_btn"
                            class="btn btn-dark">{{__('admin.Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12 mb-5 d-flex">
                <div class="h-100">
                    <form class="row g-3 bg-white shadow p-3 rounded" id="update_stripe_keys">
                        <h3 class="">{{__('admin.Stripe keys')}}</h3>
                        <div class="col-md-12">
                            <label for="seo_canonical" class="form-label">{{__('admin.STRIPE_PUBLIC_KEY')}}</label>
                            <input type="password" required class="form-control"
                            placeholder="{{__('admin.STRIPE_PUBLIC_KEY')}}"
                            value="{{$settings->STRIPE_PUBLIC_KEY}}" id="STRIPE_PUBLIC_KEY">
                        </div>
                        <div class="col-md-12">
                            <label for="seo_author" class="form-label">{{__('admin.STRIPE_SECRET_KEY')}}</label>
                            <input type="password" required class="form-control"
                            placeholder="{{__('admin.STRIPE_SECRET_KEY')}}"
                            value="{{$settings->STRIPE_SECRET_KEY}}" id="STRIPE_SECRET_KEY">
                        </div>

                        <div class="col-12">
                            <button type="submit" id="update_stripe_btn"
                            class="btn btn-dark">{{__('admin.Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="h-100">
                    <form action="{{ url('admin/update-email-detail') }}" method="POST" enctype="multipart/form-data" class="row g-3 bg-white shadow p-3 rounded">
                        @csrf
                        @method('POST') 
                        <h3 class="">{{__('Email Details')}}</h3>
                        <div class="col-md-12">
                            <label for="email" class="form-label">{{__('Email')}}</label>
                            <input type="email" required class="form-control"
                            placeholder="E.g tremlak@gmail.com"
                            value="{{@$email->email}}" name="email">
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">{{__('Address')}}</label>
                            <input type="text" required class="form-control"
                            placeholder="Enter Address"
                            value="{{@$email->address}}" name="address">
                        </div>
                        <div class="col-md-12">
                            <label for="text" class="form-label">{{ __('Main Text') }}</label>
                            <div id="quill-editor" style="height: 200px;">{!! @$email->text !!}</div>
                            <input type="hidden" name="text" id="hidden-text">
                        </div>

                        <div class="col-md-12">
                            <label for="offer_image"
                            class="form-label">{{__('Logo For Email')}}</label>

                            <input type="file" accept="image/*" name="logo" class="form-control" id="logo">
                            @if(@$email->logo != '')
                            <div class="my-2 d-flex align-items-start justify-content-between">
                                <img class="rounded" src="{{asset(@$email->logo)}}" style="height: 100px; width: 100px">
                            </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <button type="submit"
                            class="btn btn-dark">{{__('admin.Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

</main><!-- End #main -->
@endsection
@section('script')
<script>
    var quill = new Quill('#quill-editor', {
        theme: 'snow'
    });

    quill.on('text-change', function() {
        document.getElementById('hidden-text').value = quill.root.innerHTML;
    });
</script>
<!-- <script>
    var quill = new Quill('#quill-editor', {
        theme: 'snow'
    });

    // Pre-fill Quill editor with existing data
    quill.root.innerHTML = `{!! @$email->text !!}`;

    // Update hidden input before form submission
    document.querySelector("form").onsubmit = function() {
        document.getElementById('hidden-text').value = quill.root.innerHTML;
    };
</script>
 -->

<script>
    $(document).ready(function () {
        $("#settingsli").addClass("nav-active");
        $("#property_settings_nev").addClass("active");
        $("#property_settings_nev").removeClass("collapse");
        $("#property_settings_nev_link").removeClass("collapsed");
        $("#property_settings_nev_link").addClass("active");

    });
</script>
@endsection
