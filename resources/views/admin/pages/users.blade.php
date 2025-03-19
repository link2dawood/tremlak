@extends('admin.layouts.master')
@section('pageTitle', __('admin.Agents'))
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>{{__('admin.Dashboard')}}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('/')}}">{{__('admin.Home')}}</a></li>
                <li class="breadcrumb-item active">{{__('admin.Agents')}}</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="card table-overflow">
                <div class="card-body">
                    <div class=" my-3 d-flex justify-content-between">
                        <h3 class="">{{__('admin.Agents')}}</h3>
                    </div>
                    <!-- Assign Credits Form -->
                    <form action="{{ route('assignCredits') }}" method="POST">
                        @csrf
                        <div class="d-flex mb-3">
                            <input type="number" class="form-control me-2" name="credits" id="credits" placeholder="Enter Credits" required min="1">
                            <button type="submit" class="btn btn-success">Assign Credits</button>
                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th scope="col">{{__('admin.Profile Image')}}</th>
                                    <th scope="col">{{__('admin.City')}}</th>
                                    <th scope="col">{{__('admin.First name')}}</th>
                                    <th scope="col">{{__('admin.Last name')}}</th>
                                    <th scope="col">{{__('admin.Email')}}</th>
                                    <th scope="col">{{__('admin.Phone')}}</th>
                                    <th scope="col">{{__('Balance')}}</th>
                                    <th scope="col">{{__('admin.Profile approved')}}</th>
                                    <th scope="col">{{__('admin.Status')}}</th>
                                    <th scope="col">#{{__('admin.Active Properties')}}</th>
                                    <th scope="col">#{{__('admin.Warnings')}}</th>
                                    <th scope="col">{{__('admin.Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                <?php
                                $no_notifi = $user->notifications()->count();
                                $bg = '';
                                if ($no_notifi == 1) {
                                    $bg = 'badge bg-warning';
                                } else if ($no_notifi == 2) {
                                    $bg = 'badge bg-primary';
                                } else if ($no_notifi >= 3) {
                                    $bg = 'badge bg-danger';
                                } else {
                                    $bg = '';
                                }
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="agent-checkbox" name="agent_ids[]" value="{{ $user->id }}">
                                    </td>
                                    <td>
                                        <div class="avatar">
                                           <a href="{{route('properties',['agent_id'=>$user->id])}}"> <img class="rounded-circle w-100 h-100" src="{{ $user->image_path != '' ? asset($user->image_path) : asset('admin/assets/img/avatar.png') }}"></a>
                                       </div>
                                   </td>
                                   <td>{{ optional(optional($user->broker_office)->city_date)->title ?? 'N/A' }}</td>
                                   <td>{{ $user['fname'] }}</td>
                                   <td>{{ $user['lname'] }}</td>
                                   <td>{{ $user['email'] }}</td>
                                   <td>{{ $user['phone'] }}</td>
                                   <td>{{ $user['balance'] }}</td>
                                   <td>
                                    @if($user['approve_profile'] == 1)
                                    <span class="bg-success rounded-pill badge">{{__('admin.Yes')}}</span>
                                    @else
                                    <span class="bg-danger rounded-pill badge">{{__('admin.No')}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user['status'] == 1)
                                    <span class="bg-success rounded-pill badge">{{__('admin.Active')}}</span>
                                    @else
                                    <span class="bg-danger rounded-pill badge">{{__('admin.Blocked')}}</span>
                                    @endif
                                </td>
                                <td>{{ $user->activeproperties() ?? 0 }}</td>
                                <td class="text-center">
                                    <span class="d-block {{ $bg }}">{{ $no_notifi }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuButton{{ $user['id'] }}" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $user['id'] }}">
                                            @if($user['status'] == 1)
                                            <li>
                                                <a href="{{ route('agent-balance-view', $user['id']) }}" class="dropdown-item" title="{{ __('Credits') }}">
                                                    <i class="fa fa-dollar"></i> {{ __('Credits') }}
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item" onclick="UpdateUserStatus(`{{ $user['id'] }}`,0)" id="update_status{{ $user['id'] }}" title="{{__('admin.Block Agent')}}"><i class="fa fa-ban"></i>
                                                {{__('admin.Block')}}</a>
                                            </li>
                                            @else
                                            <li><a class="dropdown-item" onclick="UpdateUserStatus(`{{ $user['id'] }}`,1)" id="update_status{{ $user['id'] }}" title="{{__('admin.Activate Agent')}}"><i class="fa fa-check"></i>
                                            {{__('admin.Activate')}}</a></li>
                                            @endif
                                            <li><a class="dropdown-item" onclick="deleteUser(`{{ $user['id'] }}`)" title="{{__('admin.Delete Agent')}}" id="delete_user{{ $user['id'] }}"><i class="fa fa-trash"></i>
                                            {{__('admin.Delete')}} </a></li>
                                            <li><a class="dropdown-item" onclick="sendNotification(`{{ $user['id'] }}`)" title="{{__('admin.Give warning')}}"><i class="fa fa-bell"></i>
                                            {{__('admin.Give warning')}}</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
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
    $(document).ready(function () {
        $("#agentsli").addClass("nav-active");

        // Select/Deselect all checkboxes
        $('#select-all').on('change', function () {
            $('.agent-checkbox').prop('checked', this.checked);
        });

        // Assign credit to a single agent
        function assignCreditToAgent(agentId) {
            let credits = prompt("Enter credits to assign:");
            if (credits && !isNaN(credits) && credits > 0) {
                $.ajax({
                    url: "{{ route('assignCredits') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        agent_ids: [agentId],
                        credits: credits
                    },
                    success: function (response) {
                        alert('Credits assigned successfully!');
                        location.reload();
                    },
                    error: function () {
                        alert('Failed to assign credits.');
                    }
                });
            } else {
                alert('Please enter a valid credit amount.');
            }
        }
    });
</script>
<script>
    function getAgentBalance(userId) {
        fetch(`{{ url('/agent-balances') }}/${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("Agent not found!");
            } else {
                alert(`Agent ID: ${data.id}\nCredits: ${data.balance}`);
            }
        })
        .catch(error => console.error("Error fetching balance:", error));
    }
</script>

<script>
    $(document).ready(function() {
        $("#agentsli").addClass("nav-active");
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
