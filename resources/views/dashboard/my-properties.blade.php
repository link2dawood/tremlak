@extends('dashboard.layouts.master')
@section('pageTitle',__('agent.My Properties'))
@section('content')
<div class="dashboard__content property-page bgc-f7">
    <div class="row align-items-center pb40">
        <div class="col-xxl-3">
            <div class="dashboard_title_area">
                <h2>{{__('agent.My Properties')}}</h2>
                <p class="text">{{__('agent.We are glad to see you again!')}}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="packages_table table-responsive">

                    <table class="table-style3 table at-savesearch" id="example">
                        <thead class="t-head">
                            <tr>
                                <th scope="col">{{__('agent.ID')}}</th>
                                <th scope="col">{{__('agent.Title')}}</th>
                                <th scope="col">{{__('Price')}}</th>
                                <th scope="col">{{__('agent.Duration')}}</th>
                                <th scope="col" data-sort="date">{{ __('agent.Create Date') }}</th>
                                <th scope="col" data-sort="date">{{ __('agent.Expire Date') }}</th>
                                <th scope="col">{{__('agent.Expired')}}</th>
                                <th scope="col">{{__('agent.Admin Status')}}</th>
                                <th scope="col">{{__('agent.Status')}}</th>
                                <th scope="col">{{__('agent.Action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="t-body">
                            @foreach($properties as $property)
                            <tr>
                                <td class="vam">{{$property->slug}}</td>
                                <th scope="row">
                                    <div class="listing-style1 dashboard-style d-xxl-flex align-items-center mb-0">
                                        <div class="list-content py-0 p-0 mt-2 mt-xxl-0 ps-xxl-4">
                                           <div class="h6 list-title">
                                            <a href="{{ route('property_details', ['slug' => $property->slug]) }}">
                                                @if($property->property_type_id)
                                                {{ compiledText('title', $property->property_type_id, $property->id) }}
                                                @else
                                                No Title Available
                                                @endif
                                            </a>
                                        </div> 
                                    </div>
                                </div>
                            </th>
                            <td data-order="{{ $property->price }}">
                                <a href="{{ route('property_details', ['slug' => $property->slug]) }}">
                                    <div class="list-price">
                                        {{ showsaperater($property->price, $property->property_currency->code) }} {{ $property->property_currency->code ?? '' }}
                                    </div>
                                </a>
                            </td>
                            <td class="vam">{{$property->duration}} months</td>
                            <!--<td class="vam">{{ date('d-m-Y',strtotime($property->create_date)) }}</td>-->
                            <!--<td class="vam">{{ date('d-m-Y',strtotime($property->expire_date)) }}</td>-->
                            <td class="vam" data-order="{{ date('Y-m-d', strtotime($property->create_date)) }}">
                                {{ date('d-m-Y', strtotime($property->create_date)) }}
                            </td>
                            <td class="vam" data-order="{{ date('Y-m-d', strtotime($property->expire_date)) }}">
                                {{ date('d-m-Y', strtotime($property->expire_date)) }}
                            </td>
                            <td class="vam">
                                @php
                                $currentDate = now(); // Get current date
                                $expireDate = \Carbon\Carbon::parse($property->expire_date); // Convert expire_date to Carbon
                                @endphp

                                @if($currentDate->greaterThan($expireDate)) 
                                {{-- Expired: Show Renew Button --}}
                                <a type="button" class="btn btn-light btn-sm fw-bold" onclick="renewProperty('{{ $property->id }}')" 
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('agent.Renew') }}">
                                   {{ __('agent.Renew') }}
                               </a>
                               @else 
                               {{-- Not Expired: Show "No" --}}
                               <span class="bg-success badge rounded-pill">{{ __('agent.No') }}</span>
                               @endif
                           </td>

                           <td class="vam">
                            @if($property->admin_status == 0)
                            <span class="pending-style style1">{{__('agent.Paused')}}</span>
                            @else
                            <span class="pending-style style2">{{__('agent.Published')}}</span>
                            @endif
                        </td>
                        <td class="vam">
                            @if($property->status == 0)
                            <span class="pending-style style1">{{__('agent.Paused')}}</span>
                            @else
                            <span class="pending-style style2">{{__('agent.Published')}}</span>
                            @endif
                        </td>
                        <td class="vam">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton{{$property->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$property->id}}">
                                    <li>
                                        <a href="{{ route('edit_property', ['slug' => $property->slug]) }}" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('agent.Edit')}}">
                                            <span class="fas fa-pen fa"></span> {{__('agent.Edit')}}
                                        </a>
                                    </li>
                                    <li>
                                        @if($property->status == 0)
                                        <a href="#" class="dropdown-item" onclick="UpdatePropertyStatus('{{$property->id}}', 1)" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('agent.Publish')}}">
                                            <span class="fa fa-check"></span> {{__('agent.Publish')}}
                                        </a>
                                        @else
                                        <a href="#" class="dropdown-item" onclick="UpdatePropertyStatus('{{$property->id}}', 0)" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('agent.Pause')}}">
                                            <span class="fa fa-ban"></span> {{__('agent.Pause')}}
                                        </a>
                                        @endif
                                    </li>
                                    {{--                                                @if($property->expire_status == 1)--}}
                                    {{--                                                    <li>--}}
                                        {{--                                                        <a href="#" class="dropdown-item" onclick="renewProperty('{{$property->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('agent.Renew')}}">--}}
                                            {{--                                                            <span class="fa fa-refresh"></span> {{__('agent.Renew')}}--}}
                                        {{--                                                        </a>--}}
                                    {{--                                                    </li>--}}
                                    {{--                                                @endif--}}
                                    <li>
                                        <a href="#" class="dropdown-item" onclick="deleteProperty('{{$property->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('agent.Delete')}}">
                                            <span class="flaticon-bin"></span> {{__('agent.Delete')}}
                                        </a>
                                    </li>
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
</div>
</div>
<div class="modal fade" id="renew_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('agent.Renew Property')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">{{__('agent.Renew Property')}}</h5>
                    </div>
                    <form class="row g-3" id="renew_property">
                        <input type="hidden" id="property_id">

                        <div class="col-12">
                            {{--                                <label class="heading-color ff-heading fw600 mb10 d-block h-5">{{__('agent.Amount')}}: <span id="amount"><?=$settings->credits_three_month?></span></label>--}}
                            <label class="heading-color ff-heading fw600 mb10">Select Duration</label>
                            <div class="location-area">
                                <select class="selectpicker" id="property_duration">
                                    {{-- <option value="0">---Please Select----</option>--}}
                                    <option disabled value="1">{{__('agent.One month (30 days - :credits Credits)', ['credits' => $settings->credits_one_month])}}</option>
                                    <option disabled value="2">{{__('agent.Two months (60 days - :credits Credits)', ['credits' => $settings->credits_two_month])}}</option>
                                    <option selected value="3">{{__('agent.Three months (90 days - :credits Credits)', ['credits' => $settings->credits_three_month])}}</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button class="ud-btn btn-thm" id="renew_btn" type="submit">{{__('agent.Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $("#my_property_li").addClass('-is-active');

        $('#property_duration').change(function() {
            var durationCredits = parseInt($(this).val());

            if(durationCredits != 1){
                console.log(durationCredits)
                var totalCredits = durationCredits * {{$settings->renew_ad}};
                $("#amount").html(totalCredits);
            } else {
                var totalCredits = {{$settings->renew_ad}};
                $("#amount").html(totalCredits);
            }

        });

    });
    $('#example').DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "order": [[ 0, "desc" ]]
            // dom: 'lBfrtip',
            // buttons: [
            //     'csv'
            // ],
    });
    function renewProperty(property_id){
        $("#property_id").val(property_id);
        $("#renew_modal").modal('show')
    }
</script>
@endsection
