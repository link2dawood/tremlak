@extends('admin.layouts.master')
@section('pageTitle', __('admin.Messages'))
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Messages')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Messages')}}</h3>
                        </div>
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.ID')}}#</th>
                                <th scope="col">{{__('admin.Name')}}</th>
                                <th scope="col">{{__('admin.Email')}}</th>
                                <th scope="col">{{__('admin.Subject')}}</th>
                                <th scope="col">{{__('admin.Message')}}</th>
                                <th scope="col">{{__('admin.Create Date')}}</th>
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
    <div class="modal fade" id="editbrandmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Message')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <p class="p-3" id="message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $("#messagesli").addClass("nav-active");
            var table= $('#example').DataTable({
                ajax: "{{ route('admin_messages') }}", // Ajax route
                serverSide: true,
                processing: true,
                columns: [
                    // Define your data columns here
                    { data: "id", name: "id" },
                    { data: "name", name: "name" },
                    { data: "email", name: "email" },
                    { data: "subject", name: "subject" },
                    { data: "message", name: "message" },
                    { data: "create_date", name: "create_date" },
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

        function ViewMessage(message){

            $('#message').text('');
            $('#message').text(""+message);
            $("#editbrandmodal").modal('show')

        }//deletePackage

    </script>

@endsection
