@extends('admin.layouts.master')
@section('pageTitle', __('admin.Property Locations'))
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Property Locations')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Property Locations')}}</h3>
                            <button class="btn btn-dark " type="button" onclick="addlocationmodal()" >{{__('admin.Add New Location')}}</button>
                        </div>
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Title')}}</th>
                                <th scope="col">{{__('admin.Options')}}</th>
                                <th scope="col">{{__('admin.Mandatory')}}</th>
                                <th scope="col">{{__('admin.Status')}}</th>
                                <th scope="col">{{__('admin.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($locations as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->location_details[0]->title ?? '' }}</td>
                                    <td>{{ $val->location_details[0]->answer ?? '' }}</td>
                                    <td>{{ $val->mandatory ?? '' }}</td>
                                    <td>
                                        @if ($val->status == 0)
                                            <span class="rounded-pill badge bg-info" title="{{ __('admin.Blocked') }}">{{ __('admin.Blocked') }}</span>
                                        @else
                                            <span class="rounded-pill badge bg-success" title="{{ __('admin.Active') }}">{{ __('admin.Active') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" id="dropdownMenuButton{{ $val->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('admin.Actions') }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $val->id }}">
                                                <li>
                                                    <a class="dropdown-item" id="location_edit_btn{{ $val->id }}" 
                                                        onclick="EditLocation(`{{ $val->id }}`, `{{ $val->location_details[0]->title ?? '' }}`, `{{ $val->mandatory }}`, `{{ $val->show_in_filters }}`)" 
                                                        title="{{ __('admin.Edit') }}">
                                                        <i class="fa fa-edit"></i> {{ __('admin.Edit') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item update-status" 
                                                       data-id="{{ $val->id }}" data-status="{{ $val->status == 0 ? 1 : 0 }}"
                                                       title="{{ $val->status == 0 ? __('admin.Activate') : __('admin.Block') }}">
                                                        <i class="fa {{ $val->status == 0 ? 'fa-check' : 'fa-ban' }}"></i>
                                                        {{ $val->status == 0 ? __('admin.Activate') : __('admin.Block') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('admin/delete_location', $val->id)}}" class="dropdown-item" id="location_delete_btn{{ $val->id }}"  
                                                        title="{{ __('admin.Delete') }}">
                                                        <i class="fa fa-trash"></i> {{ __('admin.Delete') }}
                                                    </a>
                                                </li>
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

    <div class="modal fade" id="addlocationmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Add New Location')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="location_submit">
                            <input type="hidden" id="location_id" name="location_id">
                            <div class="col-12">
                                <label for="mandatory" class="form-label d-flex gap-2">
                                    <input name="mandatory" id="mandatory" type="checkbox"
                                           class="form-check">
                                    {{__('admin.Want to make it mandatory?')}}</label>
                            </div>
                            <div class="col-12">
                                <label for="show_in_filters" class="form-label d-flex gap-2">
                                    <input name="show_in_filters" id="show_in_filters" type="checkbox"
                                           class="form-check">
                                    {{__('admin.Want to show in filters?')}}</label>
                            </div>
                            <p class="fw-bold">{{__('admin.Enter answers with "-" seperated values.')}}</p>
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
                                                    <label for="title" class="form-label">{{__('admin.Location Name')}}</label>
                                                    <input name="title[]" type="text"
                                                           class="form-control">

                                                </div>
                                                <div class="col-12 my-1">
                                                    <label for="title" class="form-label">{{__('admin.Location Answers')}}</label>
                                                    <input name="answer[]" type="text"
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
    <div class="modal fade" id="editlocationmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Edit Location')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="edit_location">
                            <input type="hidden" id="location_id">
                            <div class="col-12">
                                <label for="edit_mandatory" class="form-label d-flex gap-2">
                                    <input name="edit_mandatory" id="edit_mandatory" type="checkbox"
                                           class="form-check">
                                    {{__('admin.Want to make it mandatory?')}}</label>

                            </div>
                            <div class="col-12">
                                <label for="edit_show_in_filters" class="form-label d-flex gap-2">
                                    <input name="edit_show_in_filters" id="edit_show_in_filters" type="checkbox"
                                           class="form-check">
                                    {{__('admin.Want to show in filters?')}}</label>
                            </div>
                            <p class="fw-bold">{{__('admin.Enter answers with "-" seperated values.')}}</p>
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
                                                    <label for="title" class="form-label">{{__('admin.Location Name')}}</label>
                                                    <input type="text"
                                                           name="edit_title[]"
                                                           class="form-control">
                                                </div>
                                                <div class="col-12 my-1">
                                                    <label for="title" class="form-label">{{__('admin.Location Answers')}}</label>
                                                    <input name="edit_answer[]" type="text"
                                                           class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12">
                                <button class="btn btn-dark w-100" id="edit_location_btn" type="submit">{{__('admin.Update')}}</button>
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
$(document).on('click', '.update-status', function () {
    let locationId = $(this).data('id');
    let newStatus = $(this).data('status');

    $.ajax({
        url: "{{ route('update_location_status') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            id: locationId,
            status: newStatus
        },
        success: function (response) {
            if (response.status === 'true') {
                // alert(response.message);
                location.reload();
            } else {
                alert(response.message);
            }
        },
        error: function () {
            alert("Error updating status");
        }
    });
});
</script>
    <script>
        $(document).ready(function() {
            $("#locationsli").addClass("nav-active");
            $("#property_settings").addClass("active");
            $("#property_settings").removeClass("collapse");
            $("#property_settings_link").removeClass("collapsed");
            $("#property_settings_link").addClass("active");

            // var table= $('#example').DataTable({
            //     ajax: "{{ route('locations') }}", // Ajax route
            //     serverSide: true,
            //     processing: true,
            //     columns: [
            //         // Define your data columns here
            //         { data: "id", name: "id" },
            //         { data: "title", name: "title" },
            //         { data: "values", name: "values" },
            //         { data: "mandatory", name: "mandatory" },
            //         { data: "show_in_filters", name: "show_in_filters" },
            //         { data: "status", name: "status" },
            //         { data: "action", name: "action" },
            //     ],

            //     "responsive": true, "lengthChange": true, "autoWidth": false,
            //     // dom: 'lBfrtip',
            //     // buttons: [
            //     //     'csv'
            //     // ],

            // });
            var table= $('#datatable').DataTable({
                "responsive": true, "lengthChange": true, "autoWidth": false,
                // dom: 'lBfrtip',
                // buttons: [
                //     'csv'
                // ],

            });



            table.draw();

        });

        function addlocationmodal(){
            $("#addlocationmodal").modal('show');
        }
        function EditLocation(id, title, mandatory, show_in_filters) {
    console.log("Edit Location called with ID:", id); // Debug line
    
    // Make sure to set the location_id value in the hidden field
    $('#location_id').val(id);
    
    $("#edit_mandatory").prop("checked", mandatory === 1 || mandatory === true);
    $("#edit_show_in_filters").prop("checked", show_in_filters === 1 || show_in_filters === true);
    
    var ajax_data = new FormData();
    ajax_data.append('location_id', id);
    ajax_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
    
    $.ajax({
        url: "get_location_details",
        type: "POST",
        processData: false,
        contentType: false,
        data: ajax_data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.status) {
                $("input[name='edit_title[]']").each(function (index) {
                    $(this).val(data.titles[index] || '');
                });
                $("input[name='edit_answer[]']").each(function (index) {
                    $(this).val(data.answers[index] || '');
                });
                
                // Verify the location_id has been set
                console.log("Location ID after setting:", $('#location_id').val());
                
                $("#editlocationmodal").modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: data.message || "Something went wrong, please try again!"
                });
            }
        },
        error: function (xhr) {
            console.error("Error:", xhr);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "Unable to fetch location details."
            });
        }
    });
}

// Now, let's add the form submission handler for the update
$(document).ready(function() {
    $("#edit_location").on('submit', function(e) {
        e.preventDefault();
        
        // Show loading indicator
        $("#edit_location_btn").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');
        $("#edit_location_btn").prop('disabled', true);
        
        // Get location ID - make sure this is correctly set when opening the modal
        var locationId = $('#location_id').val();
        console.log("Location ID being submitted:", locationId); // Debug line
        
        if (!locationId) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "Location ID is missing. Please try again."
            });
            $("#edit_location_btn").html('Update');
            $("#edit_location_btn").prop('disabled', false);
            return;
        }
        
        // Collect form data
        var formData = new FormData();
        formData.append('location_id', locationId);
        formData.append('mandatory', $("#edit_mandatory").is(':checked') ? 1 : 0);
        formData.append('show_in_filters', $("#edit_show_in_filters").is(':checked') ? 1 : 0);
        
        // Collect all title and answer fields
        var titles = [];
        var answers = [];
        
        $("input[name='edit_title[]']").each(function() {
            titles.push($(this).val());
        });
        
        $("input[name='edit_answer[]']").each(function() {
            answers.push($(this).val());
        });
        
        formData.append('titles', JSON.stringify(titles));
        formData.append('answers', JSON.stringify(answers));
        
        // Send AJAX request to update
        $.ajax({
            url: "update_location",  // Your update endpoint
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Reset button state
                $("#edit_location_btn").html('Update');
                $("#edit_location_btn").prop('disabled', false);
                
                if (response.status) {
                    // Close modal
                    $("#editlocationmodal").modal('hide');
                    
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message || 'Location updated successfully!'
                    }).then(() => {
                        // Reload the page to show updated data
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: response.message || "Update failed. Please try again!"
                    });
                }
            },
            error: function(xhr) {
                // Reset button state
                $("#edit_location_btn").html('Update');
                $("#edit_location_btn").prop('disabled', false);
                
                console.error("Error:", xhr.responseJSON);
                
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON?.message || "An error occurred while updating. Please try again later."
                });
            }
        });
    });
});
    </script>

@endsection
