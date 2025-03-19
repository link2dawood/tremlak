@extends('admin.layouts.master')
@section('pageTitle', __('admin.Subscribers'))
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.Subscribers')}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row pt-4">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.Subscribers')}}</h3>
                        </div>
                        <table id="subscribers_table" class="table table-striped nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>{{__('admin.ID')}}</th>
                                <th>{{__('admin.Email')}}</th>
                                <th>{{__('admin.Create Date')}}</th>
                                <th>{{__('admin.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($subscribers as $user)

                                <tr>
                                    <td>{{$user['id'] }}</td>
                                    <td>{{$user['email'] }}</td>
                                    <td>{{$user['create_date'] }}</td>
                                    <td>
                                        <a onclick="deleteSubscriber(`{{$user['id']}}`);" class="btn btn-light"><i class="fa fa-trash"></i></a>
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

@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $("#subscribersli").addClass("nav-active");
        });;

        $('#subscribers_table').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "order": [[0, 'desc']],

            // dom: 'Bfrtip',
            // buttons: [
            //     {
            //         extend: 'csvHtml5',
            //         text: 'Export',
            //         exportOptions: {
            //             columns: [1, 2] // Specify the column indices you want to export (0-based)
            //         }
            //     }
            //
            // ]
        });

    </script>

@endsection
