@extends('dashboard.layouts.master')
@section('pageTitle',__('user.messages'))
@section('content')
    <div class="dashboard__content bgc-f7">
        <div class="row align-items-center pb40">
            <div class="col-xxl-4">
                <div class="dashboard_title_area">
                    <h2>{{__('user.messages')}}</h2>
{{--                    <p class="text">We are glad to see you again!</p>--}}
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 p20-xs mb30 overflow-hidden position-relative">
                    <div class="row">
                        <div class="col-12">

                            <video width="100%" style="border-radius: 12px; border: 2px solid #000;" autoplay muted loop playsinline preload="metadata">
                                <source src="http://www.adrianparr.com/download/keyboard-video.mp4" type="video/mp4">
                            </video>
                        </div>
                        <p class="col-12">
                            {{__('agent.message text')}}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#messages_li").addClass('-is-active');
        });
    </script>
@endsection
