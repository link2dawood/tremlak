@extends('admin.layouts.master')
@section('pageTitle', __('admin.Properties'))
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{__('admin.Dashboard')}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}">{{__('admin.Home')}}</a></li>
                <li class="breadcrumb-item active">{{__('admin.Properties')}}</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="card table-overflow">
                <div class="card-body">
                    <div class=" my-3 d-flex justify-content-between">
                        <h3 class="">{{__('admin.Properties')}}</h3>
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}</th>
                                <th style="min-width: 150px" scope="col">{{__('admin.Title')}}</th>
                                <th scope="col">{{__('Price')}}</th>
                                <th scope="col">{{__('admin.Visitors')}}</th>
                                <th scope="col">{{__('admin.Posted')}}</th>
                                <th scope="col">{{__('admin.Expire')}}</th>
                                <th scope="col">{{__('admin.Expired')}}</th>
                                <th scope="col">{{__('admin.Duration')}}</th>
                                <th scope="col">{{__('admin.City')}}</th>
                                <th scope="col">{{__('admin.Agent')}}</th>
                                <th scope="col">{{__('agent.Admin Status')}}</th>
                                <th scope="col">{{__('admin.Status')}}</th>
                                <th scope="col">{{__('admin.Type')}}</th>
                                <th scope="col">{{__('admin.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($properties as $property)
                            <tr>
                                <td class="vam">{{$property->id}}</td>
                                <td scope="row">
                                    <div class="d-xxl-flex align-items-center mb-0">
                                        <div class="list-content py-0 p-0 mt-2 mt-xxl-0">
                                            <div class="h6 list-title"><a class="text-decoration-none text-dark" href="{{route('property_details',['slug' => $property->slug])}}"> {{compiledText('title',$property->property_type_id,$property->id)}} </a></div>
                                            <div class="h6 list-title"><a class="text-decoration-none text-dark" href="{{route('property_details',['slug' => $property->slug])}}"> {{$property->slug}} </a></div>
                                            {{--                                                <p class="list-text mb-0">{{$property->property_province->title}}, {{$property->property_city->title}}, {{$property->property_district->title}}</p>--}}

                                        </div>
                                    </div>
                                </td>
                                    <!-- <td>
                                        <div class="list-price">{{$property->price}}  {{$property->property_currency->code ?? ''}}</div>
                                    </td> -->
                                    <td>
                                        <div class="list-price">
                                            {{ number_format($property->price, 0, '', '.') }}  {{ $property->property_currency->code ?? '' }}
                                        </div>
                                    </td>

                                    <td class="vam">{{$property->visitors}}</td>
                                    <td class="vam">{{date('d-m-Y',strtotime($property->create_date))}}</td>
                                    <td class="vam">{{date('d-m-Y',strtotime($property->expire_date))}}</td>
                                    <td class="vam">
                                        @if($property->expire_status == 1)
                                        <span class="bg-danger badge rounded-pill ">{{__('admin.Yes')}}</span>
                                        @else
                                        <span class="bg-success badge rounded-pill ">{{__('admin.No')}}</span>
                                        @endif
                                    </td>
                                    <td class="vam">{{$property->duration}} {{__('admin.months')}}</td>
                                    <td class="vam">{{$property->property_city->title ?? ''}}</td>
                                    <td scope="row">
                                        <div class="d-xxl-flex align-items-center mb-0">
                                            <div class="list-content py-0 p-0 mt-2 mt-xxl-0">
                                                <div class="h6 list-title"><a class="text-decoration-none text-dark" href="{{ route('agent_details', ['id' => $property->property_agent->id]) }}"> {{$property->property_agent->fname.' '.$property->property_agent->lname}} </a></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="vam">
                                        @if($property->admin_status == 0)
                                        <span class="bg-danger rounded-pill badge">{{__('admin.Paused')}}</span>
                                        @else
                                        <span class="bg-success rounded-pill badge">{{__('admin.Published')}}</span>
                                        @endif
                                    </td>
                                    <td class="vam">
                                        @if($property->status == 0)
                                        <span class="bg-danger rounded-pill badge">{{__('admin.Paused')}}</span>
                                        @else
                                        <span class="bg-success rounded-pill badge">{{__('admin.Published')}}</span>
                                        @endif
                                    </td>
                                    <td class="vam">{{$property->property_type->property_type_details[0]->title ?? ''}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton{{$property->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{__('admin.Actions')}}</button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$property->id}}">
                                                @if($property->admin_status == 0)
                                                <li><a class="dropdown-item" onclick="UpdatePropertyAdminStatus('{{$property->id}}', 1)" id="update_pending_status{{$property->id}}" title="{{__('admin.Publish')}}"><i class="fa fa-check"></i>
                                                {{__('admin.Publish')}}</a></li>
                                                @else
                                                <li><a class="dropdown-item" onclick="UpdatePropertyAdminStatus('{{$property->id}}', 0)" id="update_pending_status{{$property->id}}" title="{{__('admin.Pause')}}"><i class="fa fa-ban"></i>
                                                {{__('admin.Pause')}}</a></li>
                                                @endif
                                                <li><a class="dropdown-item" onclick="deleteAdminProperty('{{$property->id}}')" id="delete_property_btn{{$property->id}}" title="{{__('admin.Delete')}}"><i class="fa fa-trash"></i>
                                                {{__('admin.Delete')}}</a></li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection
    @section('script')

    <script>
        $(document).ready(function() {
            $("#propertiesli").addClass("nav-active");
            $("#property_settings").addClass("active");
            $("#property_settings").removeClass("collapse");
            $("#property_settings_link").removeClass("collapsed");
            $("#property_settings_link").addClass("active");
        });
    </script>
    @endsection
