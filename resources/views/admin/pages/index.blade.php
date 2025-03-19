@extends('admin.layouts.master')
@section('pageTitle', __('admin.Dashboard'))
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>{{__('admin.Dashboard')}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">{{__('admin.Dashboard')}}</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xxl-3 col-md-6 d-none">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">{{__('admin.Total Credits')}}</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{number_format(Auth::user()->balance)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">{{ __('Today Visitors') }}</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-list"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ @$todayVisitors }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">{{__('admin.Broker Offices')}}</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-list"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{number_format($agencies->count())}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">{{__('admin.New Agents')}}</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-user-plus"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{number_format($users_new->count())}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">{{__('admin.Agents')}}</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{number_format($users->count())}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">{{__('admin.Properties')}}</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{number_format($properties->count())}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">{{__('admin.Contact Form Messages')}}</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa fa-comment"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{number_format($messages->count())}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection
@section('script')
<script>

    $(document).ready(function() {
        $("#indexli").addClass("nav-active");
    });
</script>
@endsection
