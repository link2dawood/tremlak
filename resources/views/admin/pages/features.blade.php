@extends('admin.layouts.master')
@section('pageTitle', __('admin.Property Feature'))
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Property Feature')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Property Feature')}}</h3>
                            <button class="btn btn-dark " type="button" onclick="addfeaturemodal()" >{{__('admin.Add New Feature')}}</button>
                        </div>
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Property Type')}}</th>
                                <th scope="col">{{__('admin.Category')}}</th>
                                <th scope="col">{{__('admin.Title')}}</th>
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

    <div class="modal fade" id="addfeaturemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New Feature')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="feature_submit">

                            <div class="box-group" id="accordion">
                                <div class="col-12">
                                    <label for="edit_city" class="form-label">{{__('admin.Select Feature Category')}}</label>
                                    <select class="form-select" id="feature_category_id">
                                        <option value="">---{{__('admin.Please select')}}---</option>
                                        @foreach($categories as $type)
                                            <option value="{{$type->id}}">{{$type->features_category_details[0]->title ?? ''}} - {{$type->propertyType->property_type_details[0]->title ?? ''}} </option>
                                        @endforeach
                                    </select>
                                </div>
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

                                                <div class="col-12">
                                                    <label for="title" class="form-label">{{__('admin.Feature Name')}}</label>
                                                    <input type="text"
                                                           name="title[]"
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
    <div class="modal fade" id="editfeaturemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit Feature')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="edit_feature">
                            <input type="hidden" id="feature_id">
                            <div class="col-12">
                                <label for="edit_city" class="form-label">{{__('admin.Select Feature Category')}}</label>
                                <select class="form-select" id="edit_feature_category_id">
                                    <option value="">---{{__('admin.Please select')}}---</option>
                                    @foreach($categories as $type)
                                        <option value="{{$type->id}}">{{$type->features_category_details[0]->title}} - {{$type->propertyType->property_type_details[0]->title ?? ''}} </option>
                                    @endforeach
                                </select>
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

                                                <div class="col-12">
                                                    <label for="title" class="form-label">{{__('admin.Feature Name')}}</label>
                                                    <input type="text"
                                                           name="edit_title[]"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="edit_feature_btn" type="submit">{{__('admin.Update')}}</button>
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
            $("#featuresli").addClass("nav-active");
            $("#property_settings").addClass("active");
            $("#property_settings").removeClass("collapse");
            $("#property_settings_link").removeClass("collapsed");
            $("#property_settings_link").addClass("active");

            var table= $('#example').DataTable({
                ajax: "{{ route('features') }}", // Ajax route
                serverSide: true,
                processing: true,
                columns: [
                    // Define your data columns here
                    { data: "id", name: "id" },
                    { data: "property_type", name: "property_type" },
                    { data: "category", name: "category" },
                    { data: "title", name: "title" },
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

        function addfeaturemodal(){
            $("#addfeaturemodal").modal('show');
        }
        function EditFeature(id,title,category_id){

            $('#feature_id').val(id);
            $('#edit_feature_category_id').val(category_id);
            var ajax_data = new FormData();
            ajax_data.append('feature_id',id );

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "get_feature_details",
                type: "POST",
                processData: false,
                contentType: false,
                data: ajax_data,
                success: function (data) {
                    let result = data;
                    if (result.status == true) {
                        titles = result.result;


                        $("input[name='edit_title[]']").each(function(index) {
                            // Check if the index is within the bounds of the 'titles' array
                            if (index < titles.length) {

                                $(this).val(titles[index]);
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
            $("#editfeaturemodal").modal('show')
        }
    </script>

@endsection
