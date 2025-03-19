@extends('admin.layouts.master')
@section('pageTitle', __('admin.Cities'))
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Cities')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Cities')}}</h3>
                            <button class="btn btn-dark " type="button" onclick="addcitymodal()" >{{__('admin.Add New City')}}</button>
                        </div>
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">ID#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Number</th>
                                <th scope="col">Position</th>
                                <th scope="col">Status</th>
                                <th scope="col">Show on Home</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    <div class="modal fade" id="addcitymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New City')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">

                        <form class="row g-3" id="city_submit">

                            <div class="col-12">
                                <label for="title" class="form-label">{{__('admin.City Name')}}</label>
                                <input type="text" id="title" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="number" class="form-label">{{__('admin.City Number')}}</label>
                                <input type="number" id="number" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="position" class="form-label">{{__('admin.Position')}}</label>
                                <input type="number" id="position" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="city_image" class="form-label">{{__('admin.City Image')}}</label>
                                <input type="file" id="city_image"  accept="image/*"  class="form-control"  required>
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
    <div class="modal fade" id="editcitymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit City')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="edit_city">
                            <input type="hidden" id="city_id">
                            <div class="col-12">
                                <label for="edit_title" class="form-label">{{__('admin.City Name')}}</label>
                                <input type="text" id="edit_title" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="edit_number" class="form-label">{{__('admin.City Number')}}</label>
                                <input type="number" id="edit_number" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_position" class="form-label">{{__('admin.Position')}}</label>
                                <input type="number" id="edit_position" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="edit_city_image" class="form-label">{{__('admin.City Image')}}</label>
                                <input type="file" id="edit_city_image" accept="image/*" class="form-control"  >
                            </div>

                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="edit_city_btn" type="submit">{{__('admin.Update')}}</button>
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
            $("#citiesli").addClass("nav-active");
            $("#property_location").addClass("active");
            $("#property_location").removeClass("collapse");
            $("#property_location_link").removeClass("collapsed");
            $("#property_location_link").addClass("active");

            var table= $('#example').DataTable({
                ajax: "{{ route('cities') }}", // Ajax route
                serverSide: true,
                processing: true,
                columns: [
                    // Define your data columns here
                    { data: "id", name: "id" },
                    { data: "image", name: "image" },
                    { data: "title", name: "title" },
                    { data: "number", name: "number" },
                    { data: "position", name: "position" },
                    { data: "status", name: "status" },
                    { data: "show_on_home", name: "show_on_home" },
                    { data: "action", name: "action" },
                ],
                "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],

            });


        });

        function addcitymodal(){
            $("#addcitymodal").modal('show');
        }
        function EditCity(city_id,title,edit_number,position){

            $('#city_id').val(city_id);
            $('#edit_title').val(title);
            $('#edit_number').val(edit_number);
            $('#edit_position').val(position);
            $("#editcitymodal").modal('show')

        }

    </script>

@endsection
