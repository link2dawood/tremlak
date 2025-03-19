@extends('dashboard.layouts.master')
@section('pageTitle', __('admin.Messages'))
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="row pt-4">
            <div class="card table-overflow">
                <div class="card-body">
                    <div class=" my-3 d-flex justify-content-between">
                        <h3 class="">{{__('admin.Messages')}}</h3>
                    </div>
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th scope="col">{{__('#')}}</th>
                                <th scope="col">{{__('Contact Method')}}</th>
                                <th scope="col">{{__('Contact')}}</th>
                                <th scope="col">{{__('Language')}}</th>
                                <th scope="col">{{__('Question')}}</th>
                                <th scope="col">{{__('Date')}}</th>
                                <th scope="col">{{__('Property')}}</th>
                                <th scope="col">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="t-body">
                            @foreach($messages as $key => $notification)
                            <tr>
                                <td class="vam">{{$key++}}</td>
                                <td class="vam">{{$notification->contact_method}}</td>
                                <td class="vam">{{$notification->contact}}</td>
                                <td class="vam">{{$notification->language}}</td>
                                <td class="vam">{{$notification->inquiry}}</td>
                                <td class="vam">{{$notification->created_at}}</td>
                                <td class="vam">
                                     <a href="{{url('property_details', @$notification->property->slug)}}" target="_blank">{{ @$notification->property->slug }}</a>
                                </td>

                                <td class="vam">
                                    @if($notification->is_read != '1')
                                    <form action="{{route('messages.markAsRead')}}" method="post">
                                        @csrf()
                                        <input type="hidden" name="id" value="{{ $notification->id }}">
                                        <button class="btn btn-primary btn-sm" type="submit" style="color:white;">
                                            Mark as Read
                                        </button>
                                    </form>
                                    @else
                                    <span class="btn btn-info btn-sm">Read</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    <script>
    $(document).ready(function () {
        $("#notification_li").addClass('-is-active');

        // AJAX Request to Mark as Read
        $(".mark-as-read").on("click", function () {
            let messageId = $(this).data("id");
            let button = $(this);

            $.ajax({
                url: "{{ route('messages.markAsRead') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: messageId
                },
                success: function (response) {
                    if (response.success) {
                        button.replaceWith('<span class="badge badge-secondary">Read</span>');
                    }
                }
            });
        });
    });
</script>
</script>
@endsection
