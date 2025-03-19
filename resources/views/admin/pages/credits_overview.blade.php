@extends('admin.layouts.master')
@section('pageTitle', __('admin.Credits Overview'))
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{__('admin.Dashboard')}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                <li class="breadcrumb-item active">{{__('admin.Credits Overview')}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class=" pt-4 row d-flex">
            <div class="">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class="packages_table table-responsive">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="title my-2">{{__('agent.Credit Discounts')}}</h4>
                                <a href="{{ route('credits.export') }}" class="btn btn-primary">{{__('Download CSV')}}</a>
                            </div>

                            <table class="table-style3 table at-savesearch" id="buy_credits">
                                <thead class="t-head">
                                    <tr>
                                        <th scope="col">{{__('agent.ID')}}</th>
                                        <th scope="col">{{__('agent.Payment Type')}}</th>
                                        <th scope="col">{{__('agent.First Name')}}</th>
                                        <th scope="col">{{__('agent.Last Name')}}</th>
                                        <th scope="col">{{__('agent.Email')}}</th>
                                        <th scope="col">{{__('agent.Company Name')}}</th>
                                        <th scope="col">{{__('agent.Tax Number')}}</th>
                                        <th scope="col">{{__('agent.Agent Info')}}</th>
                                        <th scope="col">{{__('agent.Package')}}</th>
                                        <th scope="col">{{__('agent.Amount Paid')}}</th>
                                        {{--                                        <th scope="col">{{__('agent.Discount')}}</th>--}}
                                        <th scope="col">{{__('agent.Buy Date')}}</th>
                                        <th scope="col">{{__('agent.Expiry Date')}}</th>

                                    </tr>
                                </thead>
                                <tbody class="t-body">
                                    @foreach($BuyCredits as $buy)
                                    <tr>
                                        <td>{{$buy->id}}</td>
                                        <td>{{$buy->payment_type}}</td>
                                        <td>{{$buy->fname}}</td>
                                        <td>{{$buy->lname}}</td>
                                        <td>{{$buy->email}}</td>
                                        <td>{{$buy->company_name}}</td>
                                        <td>{{$buy->tax_number}}</td>
                                        <td>{{$buy->agent->fname ?? ''  . ' '.$buy->agent->lname ?? ''}}</td>
                                        <td>{{$buy->package->package_details[0]->title ?? '' }} - {{$buy->package->credits ?? '' }}</td>
                                        <td>{{$buy->amount}}</td>
                                        {{--                                            <td>{{$buy->discount}}</td>--}}
                                        <td>{{ date('d-m-Y',strtotime($buy->create_date)) }}</td>
                                        <td>{{ date('d-m-Y',strtotime($buy->expire_date)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class="packages_table table-responsive">
                            <h4 class="title my-2">{{__('agent.Credits Used')}}</h4>
                            <table class="table-style3 table at-savesearch" id="use_credits">
                                <thead class="t-head">
                                    <tr>
                                        <th scope="col">{{__('agent.ID')}}</th>
                                        <th scope="col">{{__('agent.Agent Info')}}</th>
                                        <th scope="col">{{__('agent.Credits')}}</th>
                                        <th scope="col">{{__('agent.Description')}}</th>
                                        <th scope="col">{{__('agent.Used Date')}}</th>

                                    </tr>
                                </thead>
                                <tbody class="t-body">
                                    @foreach($UseCredits as $use)
                                    <tr>
                                        <td>{{$use->id}}</td>
                                        <td>{{ optional($use->agent)->fname . ' ' . optional($use->agent)->lname }}</td>
                                        <td>{{$use->amount}}</td>
                                        <td>{{$use->status}}</td>
                                        <td>{{date('d-m-Y',strtotime($use->create_date))}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card table-overflow">
                <div class="card-body">
                    <div class="packages_table table-responsive">
                        <h4 class="title my-2">{{__('Credits Assigned History')}}</h4>
                        <table class="table-style3 table at-savesearch" id="assigned_credits">
                            <thead class="t-head">
                                <tr>
                                    <th scope="col">{{__('ID')}}</th>
                                    <th scope="col">{{__('Agent')}}</th>
                                    <th scope="col">{{__('Credits')}}</th>
                                    <th scope="col">{{__('Description')}}</th>
                                    <th scope="col">{{__('Assigned Date')}}</th>
                                </tr>
                            </thead>
                            <tbody class="t-body">
                                @foreach($CreditHistory as $credit)
                                <tr>
                                    <td>{{ $credit->id }}</td>
                                    <td>{{ optional($use->agent)->fname . ' ' . optional($use->agent)->lname }}</td>
                                    <td>{{ $credit->credits }}</td>
                                    <td>{{ $credit->description }}</td>
                                    <td>{{ date('d-m-Y', strtotime($credit->created_at)) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>

@endsection
@section('script')

<script>
    $(document).ready(function() {
        $("#credits_overviewli").addClass("nav-active");
        $("#property_discount").addClass("active");
        $("#property_discount").removeClass("collapse");
        $("#property_discount_link").removeClass("collapsed");
        $("#property_discount_link").addClass("active");
        $('#buy_credits').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],
            "order": [[3 , "desc" ]]
        });
        $('#use_credits').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],
            "order": [[2 , "desc" ]]

        });
        $('#assigned_credits').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],
            "order": [[2 , "desc" ]]

        });
    });
</script>

@endsection
