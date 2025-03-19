<style type="text/css">
    #message_li .badge-danger {
        position: absolute;
        top: -5px;
        right: -10px;
        font-size: 12px;
        padding: 5px 8px;
        border-radius: 50%;
        background-color: red;
        color: white;
    }

</style>
<div class="dashboard__sidebar d-none d-lg-block pt-4 mt-2">
    <div class="dashboard_sidebar_list">
        <div class="sidebar_list_item">
            <a href="{{route('agent_dashboard')}}" class="items-center " id="dashboard_li"><i class="flaticon-discovery mr15"></i>{{__('user.dashboard')}}</a>
        </div>
        <p class="fz15 fw400 ff-heading mt-2">{{__('agent.MANAGE LISTINGS')}}</p>
        <div class="sidebar_list_item ">
            <a href="{{asset('add_property')}}" class="items-center" id="add_property_li"><i class="flaticon-new-tab mr15"></i>{{__('user.add new property')}}</a>
        </div>
        <div class="sidebar_list_item ">
            <a href="{{route('my_properties')}}" class="items-center" id="my_property_li"><i class="fas fa-buildings mr15"></i>{{__('user.my properties')}}</a>
        </div>
        {{--        <div class="sidebar_list_item ">--}}
            {{--            <a href="{{route('messages')}}" class="items-center" id="messages_li"><i class="flaticon-chat-1 mr15"></i>{{__('user.messages')}}</a>--}}
        {{--        </div>--}}
        <!-- <div class="sidebar_list_item ">
            <a href="{{route('notifications')}}"><i class="flaticon-bell mr15"></i>{{__('user.notifications')}}</a>
        </div> -->
        <div class="sidebar_list_item">
            <a href="{{ route('notifications') }}" class="items-center position-relative" id="messages_li">
                <i class="flaticon-bell mr15"></i>{{__('user.notifications')}}
                @php
                $unreadCount = \App\Models\Notifications::where('user_id', auth()->id())
                ->where('is_read', '0')
                ->count();
                @endphp
                @if($unreadCount > 0)
                <span class="badge badge-danger position-absolute" style="top: -5px; right: -10px; font-size: 12px; padding: 5px 8px; border-radius: 50%; background-color: red;">
                    {{ $unreadCount }}
                </span>
                @endif
            </a>
        </div>

        <!-- <li class="sidebar_list_item">
            <a class="items-center" href="{{ url('agent_messages') }}" id="message_li">
                <i class="fa fa-comment mr15"></i>
                <span>{{__(' Messages')}}</span>
            </a>
        </li> -->
        <li class="sidebar_list_item">
            <a class="items-center position-relative" href="{{ url('agent_messages') }}" id="message_li">
                <i class="fa fa-comment mr15"></i>
                <span>{{ __('Messages') }}</span>

                @php
                $unreadCount = \App\Models\Message::where('agent_id', auth()->id())
                ->where('is_read', false)
                ->count();
                @endphp

                @if($unreadCount > 0)
                <span class="badge badge-danger position-absolute" style="top: -5px; right: -10px; font-size: 12px; padding: 5px 8px; border-radius: 50%;">
                    {{ $unreadCount }}
                </span>
                @endif
            </a>
        </li>


        <p class="fz15 fw400 ff-heading mt30">{{__('agent.MANAGE ACCOUNT')}}</p>
        <div class="sidebar_list_item ">
            <a href="{{route('credits')}}" class="items-center" id="credits_li"><i class="fas fa-hand-holding-dollar mr15"></i>{{__('agent.Credits')}}</a>
        </div>
        <div class="sidebar_list_item ">
            <a href="{{url('profile')}}" class="items-center" id="profile_li"><i class="flaticon-user mr15"></i>{{__('user.My Profile')}}</a>
        </div>
        <div class="sidebar_list_item ">

            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="items-center"><i class="flaticon-logout mr15"></i>{{__('user.Logout')}}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>
<script>
    function checkMessages() {
        $.ajax({
            url: "{{ route('messages.unread.count') }}",
            method: "GET",
            success: function(response) {
                let badge = $("#message_li .badge");
                if(response.count > 0) {
                    if(badge.length) {
                        badge.text(response.count);
                    } else {
                        $("#message_li").append('<span class="badge badge-danger position-absolute top-0 start-100 translate-middle">'+response.count+'</span>');
                    }
                } else {
                    badge.remove();
                }
            }
        });
    }

    setInterval(checkMessages, 5000); // Check every 5 seconds
</script>

