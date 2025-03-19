@extends('admin.layouts.master')
@section('pageTitle', __('Languages'))
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{__('admin.Dashboard')}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                <li class="breadcrumb-item active">{{__('Languages')}}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row pt-4">
            <div class="card table-overflow">
                <div class="card-body">
                    <div class=" my-3 d-flex justify-content-between">
                        <h3 class="">{{__('Languages')}}</h3>
                        <button class="btn btn-dark " type="button" onclick="addcurrencymodal()" >{{__('Add New Language')}}</button>
                    </div>
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Flag')}}</th>
                                <th scope="col">{{__('Name')}}</th>
                                <th scope="col">{{__('Short Name')}}</th>
                                <th scope="col">{{__('Order')}}</th>
                                <th scope="col">{{__('admin.Status')}}</th>
                                <th scope="col">{{__('admin.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Languages as $key => $val)
                            <tr>
                                <td>{{ $val->id }}</td>
                                <td>
                                    @if($val->flags)
                                    <img src="{{ asset('/' . $val->flags) }}" alt="Flag" width="40">
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->short_name }}</td>
                                <td>{{ $val->odr }}</td>
                                <td>
                                    @if($val->status == 1)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" data-id="{{ $val->id }}" class="btn btn-primary btn-sm edit-language-btn">Edit</a>
                                    <a href="#" data-id="{{ $val->id }}" class="btn btn-danger btn-sm delete-language-btn">Delete</a>
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

<div class="modal fade" id="addLanguageModal" tabindex="-1" aria-labelledby="addLanguageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLanguageModalLabel">{{ __('Add New Language') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <form class="row g-3" action="{{route('save_language')}}" method="POST" id="language_submit" enctype="multipart/form-data">
                        @csrf()
                        <div class="col-12">
                            <label for="name" class="form-label">{{ __('admin.Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label for="short_name" class="form-label">{{ __('Short Name') }}</label>
                            <input type="text" id="short_name" name="short_name" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <label for="flags" class="form-label">{{ __('admin.Flag') }}</label>
                            <input type="file" id="flags" name="flags" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="odr" class="form-label">{{__('Order')}}</label>
                            <input type="number" id="edit_language_odr" name="odr" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label for="status" class="form-label">{{ __('admin.Status') }}</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="1">{{ __('Active') }}</option>
                                <option value="0">{{ __('Inactive') }}</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-dark w-100" id="submit_btn" type="submit">{{ __('admin.Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Language Modal -->
<!-- Edit Language Modal -->
<div class="modal fade" id="editLanguageModal" tabindex="-1" aria-labelledby="editLanguageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLanguageLabel">{{ __('Edit Language') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <form id="edit_language_form" class="row g-3" method="POST" enctype="multipart/form-data">
                        @csrf()
                        <!-- Hidden Input for ID -->
                        <input type="hidden" id="language_id" name="id" value="{{@$row->id}}">
                        <!-- Language Name -->
                        <div class="col-12">
                            <label for="edit_language_name" class="form-label">{{ __('Language Name') }}</label>
                            <input type="text" id="edit_language_name" name="name" class="form-control" required value="{{@$row->name}}">
                        </div>

                        <!-- Language Code -->
                        <div class="col-12">
                            <label for="edit_language_code" class="form-label">{{ __('Language Code') }}</label>
                            <input type="text" id="edit_language_code" name="short_name" class="form-control" required value="{{@$row->short_name}}">
                        </div>

                        <!-- Flag -->
                        <div class="col-12">
                            <label for="edit_language_flag" class="form-label">{{ __('Flag') }}</label>
                            <input type="file" id="edit_language_flag" name="flags" class="form-control">
                            <img id="current_flag" src="{{ asset(@$row->flags) }}" alt="Current Flag" class="mt-2" width="50">

                        </div>
                        <div class="col-12">
                            <label for="edit_language_odr" class="form-label">{{__('Order')}}</label>
                            <input type="number" id="edit_language_odr" name="odr" class="form-control" required value="{{@$row->odr}}">
                        </div>
                        <!-- Submit Button -->
                        <div class="col-12">
                            <button class="btn btn-dark w-100" id="update_language_btn" type="submit">
                                {{ __('Update') }}
                            </button>
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
    $('.edit-language-btn').click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            url: `/admin/languages/edit/${id}`,
            type: 'GET',
            success: function(response) {
                $('#language_id').val(response.id);
                $('#edit_language_name').val(response.name);
                $('#edit_language_code').val(response.short_name);
                $('#edit_language_odr').val(response.odr);
                $('#current_flag').attr('src', `/${response.flags}`);
                $('#editLanguageModal').modal('show');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    $('#edit_language_form').submit(function(e) {
        e.preventDefault();
        let id = $('#language_id').val();
        let formData = new FormData(this);
        formData.append('_method', 'PUT');

        $.ajax({
            url: `/admin/languages/update/${id}`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    $(document).on('click', '.delete-language-btn', function(e) {
        e.preventDefault();
        let id = $(this).data('id');

        if (confirm('Are you sure you want to delete this language?')) {
            $.ajax({
                url: `/admin/language/delete/${id}`,
                type: 'POST',
            data: { _method: 'DELETE', _token: '{{ csrf_token() }}' }, // CSRF Token
            success: function(response) {
                // alert(response.msg);
                location.reload(); // Reload page after deletion
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
        }
    });

});


   function addcurrencymodal(){
    $("#addLanguageModal").modal('show');
}
function updateCurrencyRate(id,rate){

    $('#rate_currency_id').val(id);
    $('#edit_title').val(title);
    $('#edit_position').val(position);
    $("#editcurrencymodal").modal('show')

        }//
        function EditCurrency(id,title,symbol,code,rate){

            $('#currency_id').val(id);
            $('#edit_title').val(title);
            $('#edit_symbol').val(symbol);
            $('#edit_code').val(code);
            $('#edit_rate').val(rate);
            $("#editcurrencymodal").modal('show')

        }//

    </script>

    @endsection
