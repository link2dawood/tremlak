@extends('dashboard.layouts.master')
@section('pageTitle',__('agent.Credits'))
@section('content')
    <div class="dashboard__content property-page bgc-f7">
        <div class="row align-items-center pb40">
            <div class="col-xxl-3">
                <div class="dashboard_title_area">
                    <h2>{{__('agent.Credits')}}</h2>
                    <p class="text h3">{{__('agent.Available Credits')}} : <label
                            class="fw-bold"> {{Auth::user()->balance}}</label></p>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-12">

                <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                    <h4 class="title fz17 mb30">{{__('agent.Add Credits')}}</h4>

                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                @if($settings->offer_image !='')
                                    <img class="img-fluid mb-2 rounded-2" src="{{asset($settings->offer_image)}}">
                                @endif
                            </div>
                            <div class="mb20 row ">
                                @foreach($packages as $package)
                                    <div class="col-md-4 mt-4">
                                        <div class="card text-center rounded-2 pricingCard">
                                            <div class="card-header " style="background-color: {{$package->color}}">
                                                <h2 class="mb-0 text-white">{{$package->package_details[0]->title ?? ''}}</h2>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="py-4">
                                                    <h3 class="text-start px-3">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                                             width="30px" height="30px"><path fill="#43A047"
                                                                                              d="M40.6 12.1L17 35.7 7.4 26.1 4.6 29 17 41.3 43.4 14.9z"/></svg>
                                                    </span>
                                                        {{$package->credits}} {{__('agent.Credits')}}
                                                    </h3>
                                                    <h3 class="text-start px-3">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                                             width="30px" height="30px"><path fill="#43A047"
                                                                                              d="M40.6 12.1L17 35.7 7.4 26.1 4.6 29 17 41.3 43.4 14.9z"/></svg>
                                                    </span>
                                                        {{$package->package_details[0]->text_1 ?? ''}}
                                                    </h3>
                                                    <h3 class="text-start px-3">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                                             width="30px" height="30px"><path fill="#43A047"
                                                                                              d="M40.6 12.1L17 35.7 7.4 26.1 4.6 29 17 41.3 43.4 14.9z"/></svg>
                                                    </span>
                                                        {{$package->package_details[0]->text_2 ?? ''}}
                                                    </h3>
                                                </div>

                                                <hr class="mt-0 hr">
                                                <h3 class="text-center">

                                                    {{$package->price}} {{__('agent.TL')}}
                                                </h3>
                                                <p class="text-center">
                                                    ({{$package->package_details[0]->description ?? ''}})
                                                </p>
                                            </div>
                                            <div class="card-footer bg-transparent py-3">
                                                <button type="button"
                                                        onclick="setPackage(`{{$package->id}}`,`{{$package->price}}`)"
                                                        class="ud-btn btn-dark" id="purchase_btn{{$package->id}}">
                                                    {{__('agent.Purchase')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-auto justify-content-center">
                    <div class="col-xl-8">
                        <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                            <div class="row">
                                <div class="col-6">
                                    <label for="private_checkbox">
                                        <input type="radio" id="private_checkbox" value="private" checked name="select_payment_type"
                                               class="select_payment_type">
                                        {{__('agent.Private')}}
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label for="business_checkbox">
                                        <input type="radio" id="business_checkbox" value="business"
                                               name="select_payment_type" class="select_payment_type">
                                        {{__('agent.Business')}}
                                    </label>
                                </div>
                                <div class="col-12">
                                    <div class="" id="payment_div">
                                        <h2 class="heading-color ff-heading fw600 mb10">{{__('agent.Price')}}:
                                            <span id="charge_amount" class="text-success">0</span> <span class="text-success">TL</span>
                                        </h2>
                                        <form id="payment-form">
                                            <input type="hidden" value="" id="package_id">
                                            <input type="hidden" value="" id="payment_type">
                                            <div class="">
                                                <div id="card-element" class="form-control"></div>
                                                <div id="card-errors" class="my-2" role="alert"></div>
                                            </div>
                                            <div id="private" class="">
                                                <div class="col-12">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw600 mb10">{{__('agent.First name')}}</label>
                                                        <input type="text" class="form-control" id="fname"
                                                               value="{{Auth::user()->fname}}"
                                                               placeholder="{{__('agent.First name')}}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw600 mb10">{{__('agent.Last name')}}</label>
                                                        <input type="text" class="form-control" id="lname"
                                                               value="{{Auth::user()->lname}}"
                                                               placeholder="{{__('agent.Last name')}}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw600 mb10">{{__('agent.E-Mail Address for invoice')}}</label>
                                                        <input type="email" class="form-control"
                                                               value="{{Auth::user()->email}}" id="email"
                                                               placeholder="{{__('agent.E-Mail Address for invoice')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="business" class="d-none">
                                                <div class="col-12">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw600 mb10">{{__('agent.Company Name')}}</label>
                                                        <input type="text" class="form-control" id="company_name"
                                                               value="" placeholder="{{__('agent.Company Name')}}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw600 mb10">{{__('agent.Tax Number')}}</label>
                                                        <input type="text" class="form-control" id="tax_number"
                                                               value="" placeholder="{{__('agent.Tax Number')}}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb20">
                                                        <label class="heading-color ff-heading fw600 mb10">{{__('agent.E-Mail Address for invoice')}}</label>
                                                        <input type="email" class="form-control"
                                                               value="{{Auth::user()->email}}" id="business_email"
                                                               placeholder="{{__('agent.E-Mail Address for invoice')}}">
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                        <div class="col-md-12">
                                            <div class="btn-div-general text-center my-2">
                                                <button role="button" id="payment_btn" type="button"
                                                        class="ud-btn btn-dark">
                                                    {{__('agent.Submit')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--                <div class="col-xl-12">--}}
                {{--                    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">--}}
                {{--                        <div class="row">--}}

                {{--                            <div class="col-lg-6">--}}
                {{--                                <div class="packages_table table-responsive">--}}
                {{--                                    --}}{{--                                    <h4 class="title fz17 mb30">Credits Discounts</h4>--}}
                {{--                                    <table class="table-style3 table at-savesearch">--}}
                {{--                                        <thead class="t-head">--}}
                {{--                                        <tr>--}}
                {{--                                            <th scope="col">{{__('agent.Package')}}</th>--}}
                {{--                                            <th scope="col">{{__('agent.Discount%')}}</th>--}}
                {{--                                        </tr>--}}
                {{--                                        </thead>--}}
                {{--                                        <tbody class="t-body">--}}
                {{--                                        @foreach($discounts as $discount)--}}
                {{--                                            <tr>--}}
                {{--                                                <td>{{$discount->package->credits}}</td>--}}
                {{--                                                <td>{{$discount->discount}}</td>--}}
                {{--                                            </tr>--}}
                {{--                                        @endforeach--}}
                {{--                                        </tbody>--}}
                {{--                                    </table>--}}

                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-lg-6">--}}
                {{--                                @if($settings->offer_image !='')--}}
                {{--                                    <img class="img-fluid mb-2 rounded-2" src="{{asset($settings->offer_image)}}">--}}
                {{--                                @endif--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="row d-flex">
                    <div class="col-md-12">
                        <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                            <div class="packages_table table-responsive">
                                <h4 class="title fz17 mb30">{{__('agent.Credit Discounts')}}</h4>
                                <table class="table-style3 table at-savesearch" id="buy_credits">
                                    <thead class="t-head">
                                    <tr>
                                        <th scope="col">{{__('agent.Package')}}</th>
                                        <th scope="col">{{__('agent.Amount Paid')}}</th>
                                        {{--                                        <th scope="col">{{__('agent.Discount')}}</th>--}}
                                        <th scope="col">{{__('agent.Buy Date')}}</th>
                                        <th scope="col">{{__('agent.Expiry Date')}}</th>
                                        {{--                                        <th scope="col">{{__('agent.Status')}}</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody class="t-body">
                                    @foreach($BuyCredits as $buy)
                                        <tr>
                                            <td>{{$buy->package->package_details[0]->title ?? '' }}
                                                - {{$buy->package->credits ?? '' }}</td>
                                            <td>{{$buy->amount}}</td>
                                            {{--                                            <td>{{$buy->discount}}</td>--}}
                                            <td>{{ date('d-m-Y',strtotime($buy->create_date)) }}</td>
                                            <td>{{ date('d-m-Y',strtotime($buy->expire_date)) }}</td>
                                            {{--                                            <td>--}}
                                            {{--                                                @if($buy->status == 1)--}}
                                            {{--                                                    <span class="bg-success badge rounded-pill ">{{__('agent.Active')}}</span>--}}
                                            {{--                                                @else--}}
                                            {{--                                                    <span class="bg-danger badge rounded-pill ">{{__('agent.Expired')}}</span>--}}
                                            {{--                                                @endif--}}
                                            {{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                            <div class="packages_table table-responsive">
                                <h4 class="title fz17 mb30">{{__('agent.Credits Used')}}</h4>
                                <table class="table-style3 table at-savesearch" id="use_credits">
                                    <thead class="t-head">
                                    <tr>
                                        <th scope="col">{{__('agent.Credits')}}</th>
                                        {{--                                        <th scope="col">{{__('agent.Currency')}}</th>--}}
                                        <th scope="col">{{__('agent.Description')}}</th>
                                        <th scope="col">{{__('agent.Used Date')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody class="t-body">
                                    @foreach($UseCredits as $use)
                                        <tr>
                                            <td>{{$use->amount}}</td>
                                            {{--                                            <td>{{$use->currency->code ?? ''}}</td>--}}
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

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#credits_li").addClass('-is-active')

            $('#buy_credits').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],
                "order": [[3, "desc"]]
            });
            $('#use_credits').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],
                "order": [[2, "desc"]]

            });

        });
        $(".select_payment_type").change(function (e) {
            e.preventDefault();

            let payment_type = $(this).val(); // Get the value of the changed checkbox

            if (payment_type == 'private') {

                $("#payment_div").removeClass('d-none');
                $("#private").removeClass('d-none');
                $("#business").addClass('d-none');

            } else if (payment_type == 'business') {

                $("#payment_div").removeClass('d-none');
                $("#business").removeClass('d-none');
                $("#private").addClass('d-none');

            } else {
                $("#payment_div").addClass('d-none');
                $("#private").addClass('d-none');
                $("#business").addClass('d-none');
            }
            $("#payment_type").val(payment_type);
        });

        let lastSelectedButton = null; // Variable to keep track of the last selected button

        function setPackage(id, price) {
            $("#charge_amount").text(price);
            $("#package_id").val(id);

            // Remove styling from the last selected button if it exists
            if (lastSelectedButton) {
                lastSelectedButton.css({
                    "background-color": "",
                    "border": ""
                });
            }

            // Get the current button and apply the styling
            let currentButton = $("#purchase_btn" + id);
            currentButton.css({
                "background-color": "#e30a17",
                "border": "1px solid #e30a17"
            });

            // Update the last selected button
            lastSelectedButton = currentButton;
        }

        $("#credits").change(function (e) {
            e.preventDefault();
            let package_id = $("#credits option:selected").val();
            if (package_id != 0) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var ajax_data = new FormData();
                ajax_data.append('package_id', package_id);

                $.ajax({

                    url: '/get_discounted_credits',
                    type: "POST",
                    processData: false,
                    contentType: false,
                    data: ajax_data,
                    success: function (data) {

                        if (data.status == "true" || data.status == true) {

                            $("#charge_amount").text(data.result)

                        } else {
                            Swal.fire({
                                icon: data.icon,
                                title: lang['Failed'],
                                text: data.result,
                            }).then(() => {
                                $("#charge_amount").text(0)
                            });
                        }

                    }//success
                });//ajax
            } else {
                $("#charge_amount").text(0)
            }
        })


    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe(`{{$settings->STRIPE_PUBLIC_KEY}}`); // pass stripe api
    </script>
    <script>
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            if (event.error) {
                $('#card-errors').html(event.error.message);
            } else {
                $('#card-errors').html('');
            }
        });

        // Handle form submission.
        // var form = document.getElementById('payment-form');
        // form.addEventListener('submit', function(event) {
        $("#payment_btn").click(function (event) {

            event.preventDefault();
            let package_id = $("#package_id").val();

            if (package_id == '') {
                Swal.fire("Alert", lang["Please select a package!"], "info");
                return;
            }

            let payment_type = $("#payment_type").val(); // Get the value of the changed checkbox

            if (payment_type == 'private') {

                if ($("#fname").val() == '') {
                    Swal.fire("Alert", lang["Please enter your first name!"], "info");
                    return;
                }

                if ($("#lname").val() == '') {
                    Swal.fire("Alert", lang["Please enter your last name!"], "info");
                    return;
                }
                if ($("#email").val() == '') {
                    Swal.fire("Alert", lang["Please enter email address for invoice!"], "info");
                    return;
                }

            } else if (payment_type == 'business') {

                if ($("#company_name").val() == '') {
                    Swal.fire("Alert", lang["Please enter company name!"], "info");
                    return;
                }

                if ($("#tax_number").val() == '') {
                    Swal.fire("Alert", lang["Please enter tax number"], "info");
                    return;
                }
                if ($("#email").val() == '') {
                    Swal.fire("Alert", lang["Please enter email address for invoice!"], "info");
                    return;
                }

            }

            stripe.createToken(card).then(function (result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    $('#card-errors').html(result.error.message);
                    $("#payment_btn").html("Submit");
                    $("#payment_btn").prop('disabled', false);
                } else {

                    $("#payment_btn").html(`Please wait <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);
                    $("#payment_btn").prop('disabled', true);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var ajax_data = new FormData();
                    ajax_data.append('token', result.token.id);
                    ajax_data.append('package_id', package_id);
                    ajax_data.append('payment_type', payment_type);

                    if (payment_type == 'private') {

                        ajax_data.append('fname', $("#fname").val());
                        ajax_data.append('lname', $("#lname").val());
                        ajax_data.append('email', $("#email").val());

                    } else if (payment_type == 'business') {

                        ajax_data.append('company_name', $("#company_name").val());
                        ajax_data.append('tax_number', $("#tax_number").val());
                        ajax_data.append('email', $("#business_email").val());

                    }

                    $.ajax({

                        url: '/buy_credits',
                        type: "POST",
                        processData: false,
                        contentType: false,
                        data: ajax_data,
                        success: function (data) {

                            if (data.status == "true" || data.status == true) {
                                Swal.fire({
                                    icon: data.icon,
                                    title: lang['Success'],
                                    text: data.message,
                                }).then(() => {
                                    window.location.href = '/credits';
                                });
                            } else {
                                Swal.fire({
                                    icon: data.icon,
                                    title: lang['Failed'],
                                    text: data.message,
                                }).then(() => {

                                });
                            }

                            $("#payment_btn").attr("disabled", false);
                            $("#payment_btn").html("Submit");
                        }//success
                    });//ajax
                }
            });
        });
    </script>
@endsection
