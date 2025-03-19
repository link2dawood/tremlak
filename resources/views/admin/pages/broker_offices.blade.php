@extends('admin.layouts.master')
@section('pageTitle', __('admin.Broker Offices'))
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Broker Offices')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Broker Offices')}}</h3>
                            <button class="btn btn-dark " type="button" onclick="addBrokerOfficemodal()" >
                                {{__('admin.Add New Broker Office')}}
                            </button>
                        </div>
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}</th>
                                <th scope="col">{{__('admin.Image')}}</th>
                                <th scope="col">{{__('admin.Title')}}</th>
                                <th scope="col">{{__('admin.City')}}</th>
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
    <div class="modal fade" id="addBrokerOfficemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New Broker Office')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="BrokerOffice_submit">

                            <div class="col-12">
                                <label for="title" class="form-label">{{__('admin.Broker Office Name')}}</label>
                                <input type="text" id="title" class="form-control"  required>
                            </div>

                            <div class="col-12">
                                <label for="BrokerOffice_image" class="form-label">{{__('admin.Broker Office Image')}}</label>
                                <input type="file" id="BrokerOffice_image"  accept="image/*"  class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="city" class="form-label">{{__('admin.Select City')}}</label>
                                <select class="form-select" id="city_id">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->title}} </option>
                                    @endforeach
                                </select>
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
    <div class="modal fade" id="editBrokerOfficemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit Broker Office')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="edit_BrokerOffice">
                            <input type="hidden" id="BrokerOffice_id">

                            <div class="col-12">
                                <label for="title" class="form-label">{{__('admin.Broker Office Name')}}</label>
                                <input type="text" id="edit_title" class="form-control"  required>
                            </div>

                            <div class="col-12">
                                <label for="edit_BrokerOffice_image" class="form-label">{{__('admin.Broker Office Image')}}</label>
                                <input type="file" id="edit_BrokerOffice_image" accept="image/*" class="form-control"  >
                            </div>
                            <div class="col-12">
                                <label for="edit_city" class="form-label">{{__('admin.Select City')}}</label>
                                <select class="form-select" id="edit_city_id">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->title}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="edit_BrokerOffice_btn" type="submit">{{__('admin.Update')}}</button>
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
            $("#broker_officesli").addClass("nav-active");
            $("#fbrokers").addClass("active");
            $("#fbrokers").removeClass("collapse");
            $("#fbrokers_link").removeClass("collapsed");
            $("#fbrokers_link").addClass("active");

            var table= $('#example').DataTable({
                ajax: "{{ route('broker_offices') }}", // Ajax route
                serverSide: true,
                processing: true,
                columns: [
                    // Define your data columns here
                    { data: "id", name: "id" },
                    { data: "image", name: "image" },
                    { data: "title", name: "title" },
                    { data: "city", name: "city" },
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

        function addBrokerOfficemodal(){
            $("#addBrokerOfficemodal").modal('show');
        }
        function EditBrokerOffice(BrokerOffice_id,title,city){

            $('#BrokerOffice_id').val(BrokerOffice_id);
            $('#edit_title').val(title);
            $('#edit_city_id').val(city);
            $("#editBrokerOfficemodal").modal('show')

        }

    </script>

@endsection

