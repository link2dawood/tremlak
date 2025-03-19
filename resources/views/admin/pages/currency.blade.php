@extends('admin.layouts.master')
@section('pageTitle', __('admin.Currencies'))
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{__('admin.Dashboard')}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                <li class="breadcrumb-item active">{{__('admin.Currencies')}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row pt-4">
            <div class="card table-overflow">
                <div class="card-body">
                    <div class=" my-3 d-flex justify-content-between">
                        <h3 class="">{{__('admin.Currencies')}}</h3>
                        <button class="btn btn-dark " type="button" onclick="addcurrencymodal()" >{{__('admin.Add New Currency')}}</button>
                    </div>
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Flag')}}</th>
                                <th scope="col">{{__('admin.Title')}}</th>
                                <th scope="col">{{__('admin.Code')}}</th>
                                <th scope="col">{{__('admin.Symbol')}}</th>
                                <th scope="col">{{__('admin.Rate')}}</th>
                                <th scope="col">{{__('admin.Status')}}</th>
                                <th scope="col">{{__('Order')}}</th>
                                <th scope="col">{{__('admin.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<div class="modal fade" id="addcurrencymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New Currency')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card mb-3">
                <div class="card-body">

                    <form class="row g-3" id="currency_sbmit">

                        <div class="col-12">
                            <label for="title" class="form-label">{{__('admin.Name')}}</label>
                            <input type="text" id="title" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="code" class="form-label">{{__('admin.Code')}}</label>
                            <input type="text" id="code" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="flags" class="form-label">{{__('admin.Flag')}}</label>
                            <input type="file" id="flags" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="symbol" class="form-label">{{__('admin.Symbol')}}</label>
                            <input type="text" id="symbol" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="rate" class="form-label">{{__('admin.Rate')}}</label>
                            <input type="text" id="rate" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="odr" class="form-label">{{__('Order')}}</label>
                            <input type="number" id="odr" name="odr" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-dark w-100" id="submit_btn" type="submit">{{__('admin.Submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editcurrencymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit Currency')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <form class="row g-3" id="edit_currency">
                        <input type="hidden" id="currency_id">

                        <div class="col-12">
                            <label for="title" class="form-label">{{__('admin.Name')}}</label>
                            <input type="text" id="edit_title" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="code" class="form-label">{{__('admin.Code')}}</label>
                            <input type="text" id="edit_code" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="edit_flags" class="form-label">{{__('admin.Flag')}}</label>
                            <input type="file" id="edit_flags" class="form-control" >
                        </div>
                        <div class="col-12">
                            <label for="symbol" class="form-label">{{__('admin.Symbol')}}</label>
                            <input type="text" id="edit_symbol" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="rate" class="form-label">{{__('admin.Rate')}}</label>
                            <input type="text" id="edit_rate" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="odr" class="form-label">{{__('Order')}}</label>
                            <input type="number" id="edit_odr" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-dark w-100" id="edit_currency_btn" type="submit">{{__('admin.Update')}}</button>
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
        $("#currencyli").addClass("nav-active");
        $("#property_settings_nev").addClass("active");
        $("#property_settings_nev").removeClass("collapse");
        $("#property_settings_nev_link").removeClass("collapsed");
        $("#property_settings_nev_link").addClass("active");

        var table= $('#example').DataTable({
                ajax: "{{ route('currency') }}", // Ajax route
                serverSide: true,
                processing: true,
                columns: [
                    // Define your data columns here
                    { data: "id", name: "id" },
                    { data: "flags", name: "flags" },
                    { data: "title", name: "title" },
                    { data: "code", name: "code" },
                    { data: "symbol", name: "symbol" },
                    { data: "rate", name: "rate" },
                    { data: "status", name: "status" },
                    { data: "odr", name: "odr" },
                    { data: "action", name: "action" },
                    ],

                "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],

            });

        table.draw();

    });

    function addcurrencymodal(){
        $("#addcurrencymodal").modal('show');
    }
    function updateCurrencyRate(id,rate){

        $('#rate_currency_id').val(id);
        $('#edit_title').val(title);
        $('#edit_position').val(position);
        $("#editcurrencymodal").modal('show')

        }//
        function EditCurrency(id,title,symbol,code,rate,odr){

            $('#currency_id').val(id);
            $('#edit_title').val(title);
            $('#edit_symbol').val(symbol);
            $('#edit_code').val(code);
            $('#edit_rate').val(rate);
             $('#edit_odr').val(odr);  // Changed from '#odr' to '#edit_odr'
             $("#editcurrencymodal").modal('show')

        }//
        // For add form
        $("#currency_sbmit").on("submit", function(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('title', $('#title').val());
            formData.append('code', $('#code').val());
            formData.append('symbol', $('#symbol').val());
            formData.append('rate', $('#rate').val());
            // formData.append('odr', $('#odr').val());  // Make sure this is included
            let odrValue = $('#odr').val();
            formData.append('odr', odrValue ? odrValue : '0');

            if($('#flags')[0].files[0]) {
                formData.append('flags', $('#flags')[0].files[0]);
            }
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                url: "save_currency",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == "true" || data.status == true) {
                     Swal.fire({
                         icon: data.icon,
                         title: lang["Success"],
                         text: data.message,
                     }).then(() => {
                         location.reload();
                     });
                 } else {
                     Swal.fire({
                         icon: data.icon,
                         title: lang["Failed"],
                         text: data.message,
                     }).then(() => {
                      {{--window.location.href='{{session('location')}}';--}}
                  });
                 }
             },
             error: function(xhr) {
                let response = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: "error",
                    title: "Failed",
                    text: response.message,
                });
            }
        });

        });

// Similar approach for your update form

        $("#edit_currency").submit(function (event) {
            event.preventDefault();


            $("#edit_currency_btn").attr("disabled", true);
            $("#edit_currency_btn").html(`Please wait... <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>`);

            var ajax_data = new FormData();
            ajax_data.append('id', $("#currency_id").val());
            ajax_data.append('title', $("#edit_title").val());
            ajax_data.append('symbol', $("#edit_symbol").val());
            ajax_data.append('code', $("#edit_code").val());
            ajax_data.append('rate', $("#edit_rate").val());
            ajax_data.append('odr', $("#edit_odr").val());
            var fileInput = $("#edit_flags")[0];

            if (fileInput.files.length > 0) {
                ajax_data.append('flags', fileInput.files[0]);
            }

            $.ajax({
                url: 'update_currency',
                type: "POST",
                processData: false,
                contentType: false,
                data: ajax_data,
                success: function (data) {

                    $("#editcurrencymodal").modal('hide');

                    if (data.status == "true" || data.status == true) {
                        Swal.fire({
                            icon: data.icon,
                            title: lang["Success"],
                            text: data.message,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: data.icon,
                            title: lang["Failed"],
                            text: data.message,
                        }).then(() => {
                    // {{--window.location.href='{{session('location')}}';--}}
                        });
                    }
                    $("#edit_currency_btn").attr("disabled", false);
                    $("#edit_currency_btn").html("Update");
        }//success
    });//ajax


        });
    </script>

    @endsection
