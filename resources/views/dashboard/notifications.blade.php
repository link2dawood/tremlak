@extends('dashboard.layouts.master')
@section('pageTitle',__('user.notifications'))
@section('content')
<div class="dashboard__content property-page bgc-f7">
    <div class="row align-items-center pb40">
        <div class="col-xxl-3">
            <div class="dashboard_title_area">
                <h2>{{__('user.notifications')}}</h2>
                <p class="text">{{__('agent.We are glad to see you again!')}}</p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                @if($notifications->count() > 0)
                <div class="packages_table table-responsive">
                    <table class="table-style3 table at-savesearch">
                        <thead class="t-head">
                            <tr>
                                <th scope="col">{{__('user.Subject')}}</th>
                                <th scope="col">{{__('user.Message')}}</th>
                                <th scope="col">{{__('user.Date')}}</th>
                                <th scope="col">{{__('Action')}}</th>
                            </tr>
                        </thead>
                                <!-- <tbody class="t-body">
                                @foreach($notifications as $notification)
                                    <tr>
                                        <td class="vam">{{$notification->subject}}</td>
                                        <td class="">{{$notification->message}}</td>
                                        <td scope="col">{{ date('d-m-Y',strtotime($notification->create_date)) }}</td>

                                    </tr>
                                @endforeach
                            </tbody> -->
                            <tbody class="t-body">
                                @foreach($notifications as $notification)
                                <tr class="{{ $notification->is_read ? '' : 'font-weight-bold' }}" id="notification-{{ $notification->id }}">
                                    <td class="vam">{{$notification->subject}}</td>
                                    <td class="">{{$notification->message}}</td>
                                    <td>{{ date('d-m-Y',strtotime($notification->create_date)) }}</td>
                                    <td>
                                        @if(!$notification->is_read)
                                        <button class="btn btn-primary btn-sm mark-as-read text-white" data-id="{{ $notification->id }}">
                                            Mark as Read
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <div class="mbp_pagination text-center mt30">

                            {{$notifications->links()}}
                            {{--                                <p class="mt10 pagination_page_count text-center">{{ $notifications->firstItem() }} – {{ $notifications->lastItem() }} {{__('user.of')}} {{ $notifications->total() }}--}}
                                {{--                                    {{__('user.notifications')}} {{__('user.available')}}--}}
                            {{--                                </p>--}}
                        </div>

                    </div>
                    @else
                    <div class="text-center">
                        <p class="h4 fw-bold">{{__('agent.No Notifications Yet')}}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
    <script>
        $(document).ready(function() {
            $("#notification_li").addClass('-is-active');
            $(document).on('click', '.mark-as-read', function () {
                let notificationId = $(this).data('id');
                let button = $(this);

                $.ajax({
                    url: "{{ route('markNotificationAsRead', '') }}/" + notificationId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.success) {
                            $("#notification-" + notificationId).removeClass('font-weight-bold');
                            button.remove();
                        }
                    }
                });
            });

        });
    </script>
    @endsection
