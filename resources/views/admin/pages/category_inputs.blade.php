@extends('admin.layouts.master')
@section('pageTitle', __('admin.Form Builder'))
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Form Builder')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                {{__('admin.Select Property Type')}}
                            </div>

                            <form action="search_category_inputs" method="post">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">{{__('admin.Property Type')}}</label>
                                    <select id="search_property_type" name="search_property_type" class="form-select">
                                        <option value="">---{{__('admin.Please select')}}---</option>

                                        @foreach ($property_types as $property)
                                            <option {{ $property_type == $property->id ? 'selected' :'' }} value="{{$property->id}}">{{$property->property_type_details[0]->title}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-dark btn-sm">{{__('admin.Load Form')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if($property_type !="")
                    <div class="col-md-8">
                        <div class="card table-overflow">
                            <div class="card-body">
                                <div class="text-end m-2">
                                    <a data-bs-toggle="modal" data-bs-target="#categoryModal" class="btn btn-dark "
                                       type="button">{{__('admin.Add New')}} </a>
                                </div>
                                <h5 class="card-title">{{__('admin.All Inputs')}}</h5>
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{__('admin.Property Type')}}</th>
                                        <th scope="col">{{__('admin.Label')}}</th>
                                        <th scope="col">{{__('admin.Type')}}</th>
                                        <th scope="col">{{__('admin.Placeholder')}}</th>
                                        <th scope="col">{{__('admin.Position')}}</th>
                                        <th scope="col">{{__('admin.Actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($categories_inputs as $input)
                                        <tr>
                                            <td>{{ $input->property_type_data->property_type_details[0]->title ?? '' }}</td>
                                            <td>{{ $input['label'] }}</td>
                                            <td>{{ $input['type'] }}</td>
                                            <td>{{ $input['placeholder'] }}</td>
                                            <td>{{ $input['position'] }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-light my-1 " type="button"
                                                   onclick="editInput(`{{$input['id']}}`,`{{$input['property_type_id']}}`,`{{$input['label']}}`,`{{$input['type']}}`,`{{$input['placeholder']}}`,`{{$input['position']}}`)"
                                                   title="Edit Input"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-light my-1 "
                                                   onclick="deleteInput(`{{$input['id']}}`)" title="Delete Input"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main><!-- End #main -->
    <!--modal for add inputs-->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">{{__('admin.Property Type Inputs')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="create_form">
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">{{__('admin.Property Type')}}</label>
                                <select id="property_type" class="form-select">
                                    <option value="">---{{__('admin.Please select')}}---</option>

                                    @foreach ($property_types as $property)
                                        <option value="{{$property->id}}">{{$property->property_type_details[0]->title}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label class="form-label">{{__('admin.Note')}}:</label>
                                <p class="p-0 m-0">{{__('admin.note text')}} </p>
                                <p class="p-0 m-0">{{__('admin.note text2')}}</p>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">{{__('admin.Input Label')}}</label>
                                <input type="text" name="input_label[]" required class="form-control">
                            </div>
                            <div class="col-lg-2 mb-3">
                                <label class="form-label">{{__('admin.Input Type')}}</label>
                                <select name="input_type[]" class="form-select">
                                    {{--                                    <option value="text" selected>{{__('admin.text')}}</option>--}}
                                    {{--                                    <option value="checkbox">{{__('admin.checkbox')}}</option>--}}
                                    <option value="select">select</option>
                                    {{--                                    <option value="multi-select">multi-select</option>--}}
                                    {{--                                    <option value="date">{{__('admin.date')}}</option>--}}
                                    {{--                                    <option value="time">{{__('admin.time')}}</option>--}}
                                    {{--                                    <option value="number">{{__('admin.number')}}</option>--}}
                                    {{--                                    <option value="email">{{__('admin.email')}}</option>--}}
                                    {{--                                    <option value="file">file</option>--}}

                                </select>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">{{__('admin.Input Placeholder')}}</label>
                                <input type="text" required name="placeholder[]"  class="form-control">

                            </div>
                            <div class="col-lg-2 mb-3">
                                <label class="form-label">{{__('admin.Position')}}</label>
                                <input type="number" required name="position[]" class="form-control">

                            </div>
                            <div class="col-lg-2 mb-3">
                                <label class="form-label"></label>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a id="add-input-row" class="btn-dark btn-sm btn text-decoration-none"><i
                                            class="bi bi-plus-square"></i></a>
                                    <!-- <a id="remove-input-row" class="btn-dark btn-sm btn" class="text-decoration-none"><i class="bi bi-trash-fill"></i></a> -->
                                </div>
                            </div>
                        </div>
                        <div id="append-input-row">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" id="create_form_btn" class="btn btn-dark">{{__('admin.Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--modal for edit inputs-->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">{{__('admin.Edit Input')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="edit_dynamic_input">
                    <input type="hidden" id="form_id" value="">
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-3">
                                <label class="form-label">{{__('admin.Property Type')}}</label>
                                <select id="edit_property_type" class="form-select">
                                    <option value="">---{{__('admin.Please select')}}---</option>
                                    @foreach ($property_types as $property)
                                        <option value="{{$property->id}}">{{$property->property_type_details[0]->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <label class="form-label">{{__('admin.Note')}}:</label>
                                <p class="p-0 m-0">{{__('admin.note text')}} </p>
                                <p class="p-0 m-0">{{__('admin.note text2')}}</p>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">{{__('admin.Input Label')}}</label>
                                <input type="text" id="edit_input_label" required class="form-control">
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">{{('admin.Input Type')}}</label>
                                <select id="edit_input_type" class="form-select">
                                    {{--                                    <option value="text" selected>{{__('admin.text')}}</option>--}}
                                    {{--                                    <option value="checkbox">{{__('admin.checkbox')}}</option>--}}
                                    <option value="select">select</option>
                                    {{--                                    <option value="multi-select">multi-select</option>--}}
                                    {{--                                    <option value="date">{{__('admin.date')}}</option>--}}
                                    {{--                                    <option value="time">{{__('admin.time')}}</option>--}}
                                    {{--                                    <option value="number">{{__('admin.number')}}</option>--}}
                                    {{--                                    <option value="email">{{__('admin.email')}}</option>--}}
                                    {{--                                    <option value="file">file</option>--}}

                                </select>
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">{{__('admin.Input Placeholder')}}</label>
                                <input type="text" id="edit_input_placeholder" required class="form-control">

                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label">{{__('admin.Position')}}</label>
                                <input type="number" required id="edit_position" class="form-control">

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" id="edit_form_btn" class="btn btn-dark">{{__('admin.Update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {


            $("#category_inputsli").addClass("nav-active");
            $("#property_settings_nev").addClass("active");
            $("#property_settings_nev").removeClass("collapse");
            $("#property_settings_nev_link").removeClass("collapsed");
            $("#property_settings_nev_link").addClass("active");

            $("#remove-input-row").hide();

            $("#add-input-row").click(function (e) {
                $("#remove-input-row").fadeIn("1500");
                // $("#append-input-row").append("<div class='next-referral row align-items-center'><div class='col-lg-3 mb-3'><label class='form-label'>Input Label</label><input type='text' name='input_label[]' required class='form-control'></div><div class='col-lg-2 mb-3'><label class='form-label'>Input Type</label><select name='input_type[]' class='form-select'><option selected value='text'>{{__('admin.text')}}</option><option value='checkbox'>{{__('admin.checkbox')}}</option><option value='select'>select</option><option value='multi-select'>multi-select</option><option value='date'>{{__('admin.date')}}</option><option value='time'>{{__('admin.time')}}</option><option value='number'>{{__('admin.number')}}</option><option value='email'>{{__('admin.email')}}</option><option value='file'>file</option></select></div><div class='col-lg-3 mb-3'><label class='form-label'>{{__('admin.Input Placeholder')}}</label><input name='placeholder[]' type='text' required class='form-control'></div><div class='col-lg-2 mb-3'><label class='form-label'>{{__('admin.Position')}}</label><input type='number' required name='position[]'  class='form-control'></div><div class='col-lg-2 mb-3'><label class='form-label'></label><div class='d-flex align-items-center justify-content-between'><a id='append-delete-row' class='btn-dark btn-sm btn' class='text-decoration-none'><i class='bi bi-trash-fill'></i></a></div></div></div>");
                $("#append-input-row").append("<div class='next-referral row align-items-center'><div class='col-lg-3 mb-3'><label class='form-label'>Input Label</label><input type='text' name='input_label[]' required class='form-control'></div><div class='col-lg-2 mb-3'><label class='form-label'>{{__('admin.Input Type')}}</label><select name='input_type[]' class='form-select'><option value='select'>{{__('admin.select')}}</option></select></div><div class='col-lg-3 mb-3'><label class='form-label'>{{__('admin.Input Placeholder')}}</label><input name='placeholder[]' type='text' required class='form-control'></div><div class='col-lg-2 mb-3'><label class='form-label'>{{__('admin.Position')}}</label><input type='number' required name='position[]'  class='form-control'></div><div class='col-lg-2 mb-3'><label class='form-label'></label><div class='d-flex align-items-center justify-content-between'><a id='append-delete-row' class='btn-dark btn-sm btn' class='text-decoration-none'><i class='bi bi-trash-fill'></i></a></div></div></div>");
            });
            $("body").on("click", "#append-delete-row", function (e) {
                $(".next-referral").last().remove();
            });
        });

        function editInput(id, property_type,label, type, placeholder, position) {

            $("#edit_property_type").val(property_type);
            $("#edit_property_type").trigger('change');
            $("#form_id").val(id)
            $("#edit_input_placeholder").val(placeholder)
            $("#edit_input_label").val(label);
            $("#edit_input_type").val(type);
            $("#edit_position").val(position);
            $("#EditModal").modal('show');

        }

    </script>
@endsection
