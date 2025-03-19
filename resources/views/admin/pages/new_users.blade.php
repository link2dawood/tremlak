@extends('admin.layouts.master')
@section('pageTitle', __('admin.New Agents'))
@section('content')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{__('admin.Dashboard')}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">{{__('admin.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{__('admin.New Agents')}}</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="card table-overflow">
                    <div class="card-body">
                        <div class=" my-3 d-flex justify-content-between">
                            <h3 class="">{{__('admin.New Agents')}}</h3>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">{{__('admin.Profile Image')}}</th>
                                <th scope="col">{{__('admin.Agency')}}</th>
                                <th scope="col">{{__('admin.City')}}</th>
                                <th scope="col">{{__('admin.First name')}}</th>
                                <th scope="col">{{__('admin.Last name')}}</th>
                                <th scope="col">{{__('admin.Email')}}</th>
                                <th scope="col">{{__('admin.Phone')}}</th>
                                <th scope="col">{{__('admin.City')}}</th>
                                <th scope="col">{{__('admin.Agency')}}</th>
                                <th scope="col">{{__('admin.Actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="avatar">
                                            <img class="rounded-circle w-100 h-100" src="{{ $user->image_path !='' ? asset($user->image_path) : asset('admin/assets/img/avatar.png') }}">
                                        </div>
                                    </td>
                                    <td>
{{--                                        <form action="{{route('view_agents')}}" method="POST">--}}
{{--                                            @csrf--}}
{{--                                            <input type="hidden" value="{{$user->broker_office_id}}" name="broker_office_search">--}}
{{--                                            <button class="h5 btn btn-link text-decoration-none title mb-0">{{$user->broker_office->title ?? ''}}</button>--}}
{{--                                        </form>--}}
                                        {{$user->broker_office->title ?? ''}}
                                    </td>
                                    <td>{{$user->broker_office->city_date->title ?? ''}}</td>
                                    <td>{{ $user['fname'] }}</td>
                                    <td>{{ $user['lname'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['phone'] }}</td>
                                    <td>{{ $user->broker_office->city_date->title ?? ''}}</td>
                                    <td>{{ $user->broker_office->title ?? '' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuButton{{ $user['id'] }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $user['id'] }}">
                                                <li><a class="dropdown-item" onclick="approveProfile(`{{ $user['id'] }}`)" title="{{__('admin.Approve Profile')}}"><i class="fa fa-check"></i>
                                                    {{__('admin.Approve Profile')}}</a></li>
                                                <li><a class="dropdown-item" onclick="deleteUser(`{{ $user['id'] }}`)" title="{{__('admin.Delete Agent')}}" id="delete_user{{ $user['id'] }}"><i class="fa fa-trash"></i> {{__('admin.Delete')}}</a></li>
                                                <li><a class="dropdown-item" onclick="sendNotification(`{{ $user['id'] }}`)" title="{{__('admin.Give warning')}}"><i class="fa fa-bell"></i> {{__('admin.Give warning')}}</a></li>
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
    </main>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Give warning')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <form class="row g-3" id="send_notification">
                            <input type="hidden" id="user_id">

                            <div class="col-md-6">
                                <label for="subject" class="form-label">{{__('admin.Subject')}}</label>
                                <input type="text" id="subject" class="form-control"  required>
                            </div>
                            <div class="col-md-12">
                                <label for="message" class="form-label">{{__('admin.Message')}}</label>
                                <textarea class="form-control" rows="6" id="message"> </textarea>
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
@endsection
@section('script')

    <script>
        $(document).ready(function() {
            $("#newagentsli").addClass("nav-active");
            $("#fbrokers").addClass("active");
            $("#fbrokers").removeClass("collapse");
            $("#fbrokers_link").removeClass("collapsed");
            $("#fbrokers_link").addClass("active");
        });

        function sendNotification(id){
            $("#user_id").val(id)
            $("#addUserModal").modal('show');
        }
    </script>
@endsection
