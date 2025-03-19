@extends('admin.layouts.master')
@section('pageTitle', __('admin.Credit Packages'))
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Credit Packages')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Credit Packages')}}</h3>
                            <button class="btn btn-dark " type="button" onclick="addpackagemodal()" >{{__('admin.Add New Package')}}</button>
                        </div>
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Title')}}</th>
                                <th scope="col">{{__('admin.Credits')}}</th>
                                <th scope="col">{{__('admin.Price')}}</th>
                                <th scope="col">{{__('admin.Color')}}</th>
                                <th scope="col">{{__('admin.Text 1')}}</th>
                                <th scope="col">{{__('admin.Text 2')}}</th>
                                <th scope="col">{{__('admin.Description')}}</th>
                                <th scope="col">{{__('admin.Status')}}</th>
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

    <div class="modal fade" id="addpackagemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New Package')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="package_submit">

                            <div class="col-12">
                                <label for="credits" class="form-label">{{__('admin.Credits')}}</label>
                                <input type="number" id="credits" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="credits" class="form-label">{{__('admin.Price')}}</label>
                                <input type="number" id="price" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="color" class="form-label">{{__('admin.Color')}}</label>
                                <input type="color" id="color" class="form-control"  required>
                            </div>
                            <div class="box-group" id="accordion">
                                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                @foreach ($language_global as $key => $language)
                                    <!-- Escape the english details -->
                                    <div class="panel box mt-3">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse{{ $language->short_name }}" aria-expanded="false" class="collapsed">
                                                    {{ $language->name }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $language->short_name }}" class="panel-collapse collapse"
                                             aria-expanded="false" style="height: 0px;">
                                            <div class="box-body">

                                                <div class="col-12 mb-1">
                                                    <label  class="form-label">{{__('admin.Title')}} </label>
                                                    <input type="text"
                                                           name="title[]"
                                                           class="form-control">

                                                </div>
                                                <div class="col-12 mb-1">
                                                    <label  class="form-label">{{__('admin.Text 1')}} </label>
                                                    <input type="text"
                                                           name="text_1[]"
                                                           class="form-control">

                                                </div>
                                                <div class="col-12 mb-1">
                                                    <label  class="form-label">{{__('admin.Text 2')}} </label>
                                                    <input type="text"
                                                           name="text_2[]"
                                                           class="form-control">

                                                </div>
                                                <div class="col-12 mb-1">
                                                    <label  class="form-label">{{__('admin.Description')}} </label>
                                                    <input type="text"
                                                           name="description[]"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
    <div class="modal fade" id="editpackagemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit Package')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="edit_package">
                            <input type="hidden" id="package_id">

                            <div class="col-12">
                                <label for="edit_credits" class="form-label">{{__('admin.Credits')}}</label>
                                <input type="number" id="edit_credits" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="edit_price" class="form-label">{{__('admin.Price')}}</label>
                                <input type="number" id="edit_price" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="edit_color" class="form-label">{{__('admin.Color')}}</label>
                                <input type="color" id="edit_color" class="form-control"  required>
                            </div>
                            <div class="box-group" id="accordion">
                                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                @foreach ($language_global as $key => $language)
                                    <!-- Escape the english details -->
                                    <div class="panel box mt-3">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#collapse{{ $language->short_name }}" aria-expanded="false" class="collapsed">
                                                    {{ $language->name }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{ $language->short_name }}" class="panel-collapse collapse"
                                             aria-expanded="false" style="height: 0px;">
                                            <div class="box-body">

                                                <div class="col-12 mb-1">
                                                    <label  class="form-label">{{__('admin.Title')}} </label>
                                                    <input type="text"
                                                           name="edit_title[]"
                                                           class="form-control">

                                                </div>
                                                <div class="col-12 mb-1">
                                                    <label  class="form-label">{{__('admin.Text 1')}} </label>
                                                    <input type="text"
                                                           name="edit_text_1[]"
                                                           class="form-control">

                                                </div>
                                                <div class="col-12 mb-1">
                                                    <label  class="form-label">{{__('admin.Text 2')}} </label>
                                                    <input type="text"
                                                           name="edit_text_2[]"
                                                           class="form-control">

                                                </div>
                                                <div class="col-12 mb-1">
                                                    <label  class="form-label">{{__('admin.Description')}} </label>
                                                    <input type="text"
                                                           name="edit_description[]"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="edit_package_btn" type="submit">{{__('admin.Update')}}</button>
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
            $("#packagesli").addClass("nav-active");
            $("#property_discount").addClass("active");
            $("#property_discount").removeClass("collapse");
            $("#property_discount_link").removeClass("collapsed");
            $("#property_discount_link").addClass("active");

            var table= $('#example').DataTable({
                ajax: "{{ route('packages') }}", // Ajax route
                serverSide: true,
                processing: true,
                columns: [
                    // Define your data columns here
                    { data: "id", name: "id" },
                    { data: "title", name: "title" },
                    { data: "credits", name: "credits" },
                    { data: "price", name: "price" },
                    { data: "color", name: "color" },
                    { data: "text_1", name: "text_1" },
                    { data: "text_2", name: "text_2" },
                    { data: "description", name: "description" },
                    { data: "status", name: "status" },
                    { data: "action", name: "action" },
                ],

                "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],

            });
        });

        function addpackagemodal(){
            $("#addpackagemodal").modal('show');
        }
        function EditPackage(id,credits,price,color){

            $('#package_id').val(id);
            $('#edit_credits').val(credits);
            $('#edit_price').val(price);
            $('#edit_color').val(color);

            var ajax_data = new FormData();
            ajax_data.append('package_id',id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "get_packages_details",
                type: "POST",
                processData: false,
                contentType: false,
                data: ajax_data,
                success: function (data) {
                    let result = data;
                    var description;
                    var titles;
                    if (result.status == true) {
                        titles = result.titles;
                        description = result.descriptions;

                        console.log(titles,description)

                        $("input[name='edit_title[]']").each(function (index) {
                            // Check if the index is within the bounds of the 'titles' array
                            if (index < titles.length) {

                                $(this).val(titles[index]);
                            } else {

                                $(this).val(''); // Set empty value or handle it based on your requirement
                            }
                        });
                        $("input[name='edit_description[]']").each(function (index) {
                            // Check if the index is within the bounds of the 'titles' array
                            if (index < description.length) {

                                $(this).val(description[index]);
                            } else {

                                $(this).val(''); // Set empty value or handle it based on your requirement
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: lang["Something went wrong, please try again!"],
                        }).then(() => {

                        });
                    }
                }
            });

            $("#editpackagemodal").modal('show')

        }//EditPackage

    </script>

@endsection
