@extends('admin.layouts.master')
@section('pageTitle', __('admin.Districts'))
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Districts')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Districts')}}</h3>
                            <button class="btn btn-dark " type="button" onclick="adddistrictmodal()" >{{__('admin.Add New District')}}</button>
                        </div>

                        <form class="" action="{{route('districts')}}" method="POST">
                            @csrf
                            <div class="row  align-items-ends justify-content-start mb-4">

                                <div class="col-md-4">
                                    <label for="city_id" class="form-label">{{__('admin.Select City')}}</label>
                                    <select class="form-select" name="city_id" id="city_id_search">
                                        <option value="">---{{__('admin.Please select')}}---</option>
                                        @foreach($cities as $city)
                                            <option {{$city_id_search == $city->id ? 'selected' : ''}} value="{{$city->id}}">{{$city->title}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="town_id" class="form-label">{{__('admin.Select Town')}}</label>
                                    <select class="form-select" name="town_id" id="town_id_search">
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-dark " type="submit" >{{__('admin.Search')}}</button>
                                    <a class="btn btn-dark " href="{{route('districts')}}" >{{__('admin.Reset')}}</a>
                                </div>
                            </div>
                        </form>

                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Title')}}</th>
                                <th scope="col">{{__('admin.City')}}</th>
                                <th scope="col">{{__('admin.Town')}}</th>
                                <th scope="col">{{__('admin.Longitude')}}</th>
                                <th scope="col">{{__('admin.Latitude')}}</th>
                                <th scope="col">{{__('admin.Status')}}</th>
                                <th scope="col">{{__('admin.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($districts as $district)
                                <tr>
                                    <td>{{$district->id}}</td>
                                    <td>{{$district->title}}</td>
                                    <td>{{$district->city_date->title ?? ''}}</td>
                                    <td>{{$district->town_date->title ?? ''}}</td>
                                    <td>{{$district->longitude}}</td>
                                    <td>{{$district->latitude}}</td>
                                    <td>
                                        @if ($district->status == 0)
                                            <span class="rounded-pill badge bg-info" title=" {{__('admin.Blocked')}} ">{{__('admin.Blocked')}}</span>
                                        @else
                                            <span class="rounded-pill badge bg-success" title="{{__('admin.Active')}}">{{__('admin.Active')}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton{{$district->id}}" data-bs-toggle="dropdown" aria-expanded="false">{{__('admin.Actions')}}</button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$district->id}}">
                                                <li><button class="dropdown-item" id="city_edit_btn{{$district->id}}" onclick="EditDistrict(`{{$district->id}}`,`{{$district->title}}` , `{{$district->latitude}}`, `{{$district->longitude}}`, `{{$district->city_id}}`,`{{$district->town_id}}`)" title="{{__('admin.Edit')}}"><i class="fa fa-edit"></i> {{__('admin.Edit')}}</button></li>
                                                @if ($district->status == 0)
                                                    <li><button class="dropdown-item" id="update_status{{$district->id}}" onclick="updateDistrictStatus(`{{$district->id}}`,1)" title="{{__('admin.Active')}}"><i class="fa fa-check"></i>{{__('admin.Active')}}</button></li>
                                                @else
                                                    <li><button class="dropdown-item" id="update_status{{$district->id}}" onclick="updateDistrictStatus(`{{$district->id}}`,0)" title="{{__('admin.Block')}}"><i class="fa fa-ban"></i>{{__('admin.Block')}}</button></li>
                                                @endif
                                                <li><button class="dropdown-item" id="city_delete_btn{{$district->id}}" onclick="deleteDistrict(`{{$district->id}}`)" title="{{__('admin.Delete')}}"><i class="fa fa-trash"></i>{{__('admin.Delete')}}</button></li>
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
    </main><!-- End #main -->
    <div class="modal fade" id="adddistrictmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New District')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="district_submit">

                            <div class="col-12">
                                <label for="edit_city" class="form-label">{{__('admin.Select City')}}</label>
                                <select class="form-select" id="city_id">
                                    <option value="">---{{__('admin.Please select')}}---</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->title}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="edit_town_id" class="form-label">{{__('admin.Select Town')}}</label>
                                <select class="form-select" id="town_id">

                                </select>
                            </div>
                            <div class="col-12">
                                <label for="title" class="form-label">{{__('admin.District Name')}}</label>
                                <input type="text" id="title" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="longitude" class="form-label">{{__('admin.Longitude')}}</label>
                                <input type="text" id="longitude" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="latitude" class="form-label">{{__('admin.Latitude')}}</label>
                                <input type="text" id="latitude" class="form-control"  required>
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
    <div class="modal fade" id="editdistrictmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit District')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="edit_district">
                            <input type="hidden" id="district_id">

                            <div class="col-12">
                                <label for="edit_city" class="form-label">{{__('admin.Select City')}}</label>
                                <select class="form-select" id="edit_city_id">
                                    <option value="">---{{__('admin.Please select')}}---</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->title}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="edit_town_id" class="form-label">{{__('admin.Select Town')}}</label>
                                <select class="form-select" id="edit_town_id">

                                </select>
                            </div>
                            <div class="col-12">
                                <label for="edit_title" class="form-label">{{__('admin.District Name')}}</label>
                                <input type="text" id="edit_title" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="longitude" class="form-label">{{__('admin.Longitude')}}</label>
                                <input type="text" id="edit_longitude" class="form-control"  required>
                            </div>
                            <div class="col-12">
                                <label for="latitude" class="form-label">{{__('admin.Latitude')}}</label>
                                <input type="text" id="edit_latitude" class="form-control"  required>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="edit_district_btn" type="submit">{{__('admin.Update')}}</button>
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
            $("#districtsli").addClass("nav-active");
            $("#property_location").addClass("active");
            $("#property_location").removeClass("collapse");
            $("#property_location_link").removeClass("collapsed");
            $("#property_location_link").addClass("active");

            var table= $('#example').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],

            });

            {{--var table= $('#example').DataTable({--}}
            {{--    ajax: "{{ route('districts') }}", // Ajax route--}}
            {{--    serverSide: true,--}}
            {{--    processing: true,--}}
            {{--    columns: [--}}
            {{--        // Define your data columns here--}}
            {{--        { data: "id", name: "id" },--}}
            {{--        { data: "title", name: "title" },--}}
            {{--        { data: "city", name: "city" },--}}
            {{--        { data: "town", name: "town" },--}}
            {{--        { data: "longitude", name: "longitude" },--}}
            {{--        { data: "latitude", name: "latitude" },--}}
            {{--        { data: "status", name: "status" },--}}
            {{--        { data: "action", name: "action" },--}}
            {{--    ],--}}
            {{--    "responsive": true, "lengthChange": true, "autoWidth": false,--}}
            {{--    // dom: 'lBfrtip',--}}
            {{--    // buttons: [--}}
            {{--    //     'csv'--}}
            {{--    // ],--}}

            {{--});--}}

            //on search filter
            if(`{{$city_id_search}}` !=''){
                $('#city_id_search').val(`{{$city_id_search}}`).change();

                setTimeout(function(){
                    $('#town_id_search').val(`{{$town_id_search}}`);

                }, 500);
            }
        });

        function adddistrictmodal(){
            $("#adddistrictmodal").modal('show');
        }
        var selected_town_id='';
        function EditDistrict(district_id,title,latitude,longitude,city,town){

            $('#district_id').val(district_id);
            $('#edit_title').val(title);
            $('#edit_latitude').val(latitude);
            $('#edit_longitude').val(longitude);
            $('#edit_city_id').val(city).change();
            $('#edit_town_id').val(town);
            selected_town_id=town;
            $("#editdistrictmodal").modal('show')

        }

        $("#city_id_search").change(function (e) {
            e.preventDefault();

            let city_id = $("#city_id_search option:selected").val();

            if (city_id == "") {
                Swal.fire({
                    icon: 'error',
                    title: lang["Failed"],
                    text: "Please select the a city",
                }).then(() => {
                    $("#town_id").html('');
                    return;
                });
                return;

            }
            $.ajax({
                url: "/get_towns_by_city",
                type: "POST",
                async: false,
                data: {
                    city_id: city_id,
                },
                success: function (data) {
                    let result = data;
                    if (result.status == true) {
                        data = result.result;
                        $("#town_id_search").html('');
                        if (data.length > 0) {
                            $("#town_id_search").append(` <option value="">---Please select---</option>`)
                            for (let i = 0; i < data.length; i++) {
                                let appendData = "";
                                appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                                $("#town_id_search").append(appendData);
                            }

                        } else {
                            $("#town_id_search").html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: lang["Failed"],
                            text: lang["Something went wrong, please try again!"],
                        }).then(() => {

                        })
                        $("#town_id_search").html('');
                    }
                }
            });
        });
        $("#city_id").change(function (e) {
            e.preventDefault();

            let city_id = $("#city_id option:selected").val();

            if (city_id == "") {
                Swal.fire({
                    icon: 'error',
                    title: lang["Failed"],
                    text: "Please select the a city",
                }).then(() => {
                    $("#town_id").html('');
                    return;
                });
                return;

            }
            $.ajax({
                url: "/get_towns_by_city",
                type: "POST",
                async: false,
                data: {
                    city_id: city_id,
                },
                success: function (data) {
                    let result = data;
                    if (result.status == true) {
                        data = result.result;
                        $("#town_id").html('');
                        if (data.length > 0) {
                            $("#town_id").append(` <option value="">---Please select---</option>`)
                            for (let i = 0; i < data.length; i++) {
                                let appendData = "";
                                appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                                $("#town_id").append(appendData);
                            }

                        } else {
                            $("#town_id").html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: lang["Failed"],
                            text: lang["Something went wrong, please try again!"],
                        }).then(() => {

                        })
                        $("#town_id").html('');
                    }
                }
            });
        });

        $("#edit_city_id").change(function (e) {
            e.preventDefault();

            let city_id = $("#edit_city_id option:selected").val();

            if (city_id == "") {
                Swal.fire({
                    icon: 'error',
                    title: lang["Failed"],
                    text: "Please select the a city",
                }).then(() => {
                    $("#edit_town_id").html('');
                    return;
                });
                return;

            }
            $.ajax({
                url: "/get_towns_by_city",
                type: "POST",
                async: false,
                data: {
                    city_id: city_id,
                },
                success: function (data) {
                    let result = data;
                    if (result.status == true) {
                        data = result.result;
                        $("#edit_town_id").html('');
                        if (data.length > 0) {
                            $("#edit_town_id").append(` <option value="">---{{__('admin.Please select')}}---</option>`)
                            for (let i = 0; i < data.length; i++) {
                                let appendData = "";
                                appendData += `<option value="${data[i].id}">${data[i].title}</option>`;
                                $("#edit_town_id").append(appendData);
                            }

                            $("#edit_town_id").val(selected_town_id);
                            console.log("selected_town_id"+selected_town_id)
                        } else {
                            $("#edit_town_id").html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: lang["Failed"],
                            text: lang["Something went wrong, please try again!"],
                        }).then(() => {

                        });
                        $("#edit_town_id").html('');
                    }
                }
            });
        });

    </script>

@endsection
