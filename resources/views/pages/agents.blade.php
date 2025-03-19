@extends('pages.layouts.master')
@section('pageTitle',__('user.agents'))
@section('content')
    <section class="breadcumb-section2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcumb-style1">
                        <h2 class="title">{{__('user.agents')}}</h2>
                        <div class="breadcumb-list">
                            <a href="{{route('/')}}">{{__('user.home')}}</a>
                            <a href="#">{{__('user.agents')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="our-agents pt-0">
        <div class="container">
            <div class="row align-items-center mb20">
                <div class="advance-search-tab mt70 mt30-md mx-auto animate-up-3">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="advance-content-style1">
                                <div class="row">
                                    <div class="col-md-12 col-lg-10">
                                        <div class="advance-content-style1 at-home8">
                                            <form action="{{route('view_agents')}}" method="POST">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group my-1">
                                                            <input type="text" id="agent_name" name="agent_name_search" value="{{$agent_name_search}}" class="border rounded-2 form-control" placeholder="{{__('user.Enter agent name')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="bootselect-multiselect my-1">
                                                            <select class="selectpicker" name="broker_office_search">
                                                                <option value="">{{__('user.Select Broker Office')}}</option>
                                                                @foreach($broker_offices_global as $office)
                                                                    <option {{$broker_office_search == $office->id ? 'selected' : ''}} value="{{$office->id}}">{{$office->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="advance-search-icon ud-btn btn-thm mv-992" type="submit"><span class="d-flex align-items-center gap-2 justify-content-center"><span class="flaticon-search"></span><span>{{__('user.Search')}}</span></span></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{--                                    <div class="col-md-12 col-lg-2">--}}
                                    {{--                                        <div class="d-flex align-items-center justify-content-start justify-content-md-center my-1">--}}
                                    {{--                                            <button class="advance-search-icon ud-btn btn-thm mv-992" type="button"><span class="d-flex align-items-center gap-2 justify-content-center"><span class="flaticon-search"></span><span>Search</span></span></button>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 wow fadeInUp"
                 data-wow-delay="100ms">
                @foreach($agents as $agent)
                    <div class="col">
                        <a href="{{ route('agent_details', ['id' => $agent->id]) }}" class="text-decoration-none">
                            <div class="feature-style2 mb30">
                                <div class="feature-img">
                                    <img class="bdrs12" style="width: 100%; height:200px; object-fit:cover; border-radius: 12px;" src="{{$agent->image_path != '' ? asset($agent->image_path) : asset('agent/images/placeholder.png') }}" alt="">
                                </div>
                                <div class="feature-content pt20">
                                    <h6 class="title mb-1">{{$agent->name}}</h6>
                                    <p class="text fz15">{{$agent->broker_office->title ?? ''}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="300ms">
                <div class="mbp_pagination text-center">
                    <ul class="page_navigation">
                        {{-- Previous Page Link --}}
                        @if ($agents->onFirstPage())
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link"><span class="fas fa-angle-left"></span></span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $agents->previousPageUrl() }}"><span class="fas fa-angle-left"></span></a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($agents->getUrlRange(1, $agents->lastPage()) as $page => $url)
                            @if ($page == $agents->currentPage())
                                <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($agents->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $agents->nextPageUrl() }}"><span class="fas fa-angle-right"></span></a>
                            </li>
                        @else
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link"><span class="fas fa-angle-right"></span></span>
                            </li>
                        @endif
                    </ul>
                    <p class="mt10 pagination_page_count text-center">{{ $agents->firstItem() }} - {{ $agents->lastItem() }}
                        {{__('user.of')}} {{ $agents->total() }}
                        {{strtolower(__('user.agents'))}} {{__('user.available')}}</p>
                </div>
            </div>

        </div>
    </section>
@endsection
