@extends('admin.layouts.master')
@section('pageTitle', __('admin.Towns'))
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Towns')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Towns')}}</h3>
                            <button class="btn btn-dark " type="button" onclick="addtownmodal()" >{{__('admin.Add New Town')}}</button>
                        </div>
                        <form class="" action="{{route('towns')}}" method="POST">
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
                                <div class="col-md-3">
                                    <button class="btn btn-dark " type="submit" >{{__('admin.Search')}}</button>
                                    <a class="btn btn-dark " href="{{route('towns')}}" >{{__('admin.Reset')}}</a>
                                </div>
                            </div>
                        </form>
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Title')}}</th>
                                <th scope="col">{{__('admin.City')}}</th>
                                <th scope="col">{{__('admin.Status')}}</th>
                                <th scope="col">{{__('admin.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($towns as $district)
                                <tr>
                                    <td>{{$district->id}}</td>
                                    <td>{{$district->title}}</td>
                                    <td>{{$district->city_date->title ?? ''}}</td>
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
                                                <li><button class="dropdown-item" id="city_edit_btn{{$district->id}}" onclick="EditTown(`{{$district->id}}`,`{{$district->title}}` ,`{{$district->city_id}}`,`{{$district->town_id}}`)" title="{{__('admin.Edit')}}"><i class="fa fa-edit"></i> {{__('admin.Edit')}}</button></li>
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

    <div class="modal fade" id="addtownmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New Town')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="town_submit">
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
                                <label for="title" class="form-label">{{__('admin.Town Name')}}</label>
                                <input type="text" id="title" class="form-control"  required>
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
    <div class="modal fade" id="edittownmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit Town')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">

                        <form class="row g-3" id="edit_town">
                            <input type="hidden" id="town_id">
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
                                <label for="edit_title" class="form-label">{{__('admin.Town Name')}}</label>
                                <input type="text" id="edit_title" class="form-control"  required>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="edit_town_btn" type="submit">{{__('admin.Update')}}</button>
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
            $("#townsli").addClass("nav-active");
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
            // var table= $('#example').DataTable({
            //     ajax: "{{ route('towns') }}", // Ajax route
            //     serverSide: true,
            //     processing: true,
            //     columns: [
            //         // Define your data columns here
            //         { data: "id", name: "id" },
            //         { data: "title", name: "title" },
            //         { data: "city", name: "city" },
            //         { data: "status", name: "status" },
            //         { data: "action", name: "action" },
            //     ],

            //     "responsive": true, "lengthChange": true, "autoWidth": false,
            //     // dom: 'lBfrtip',
            //     // buttons: [
            //     //     'csv'
            //     // ],

            // });
        });

        function addtownmodal(){
            $("#addtownmodal").modal('show');
        }
        function EditTown(id,title,city){

            $('#town_id').val(id);
            $('#edit_title').val(title);
            $('#edit_city_id').val(city);
            $("#edittownmodal").modal('show')

        }//deletePackage

    </script>

@endsection
