<div class="bg-light py-1 text-end px-3 px-md-3 px-lg-5">
    <div class="d-flex align-items-center justify-content-end gap-3 py-2">
{{--        <select class="language shadow px-3" id="languageDropdown">--}}
{{--            @foreach($language_global as $language)--}}
{{--                <option value="{{$language->short_name}}">{{strtoupper($language->short_name)}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}

{{--        <select class="currency shadow px-3" id="currencyDropdown">--}}
{{--            @foreach($currency_global as $currency)--}}
{{--                <option value="{{$currency->code}}">{{$currency->symbol}} {{$currency->code}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}

        <div class="language">
            <a onclick="showLanguages()" class="lang-drpdwn-btn">
                <img id="selectedFlagLang" style="width: 30px;height: 30px" class="pe-2" src="{{asset('flags/gl.svg')}}" alt="">
                <span id="selectedLang">Lang</span>
            </a>
            <div class="dropdown-language" onclick="event.stopPropagation();">
                @foreach($language_global as $language)
                <a href="#" class="d-flex align-items-center"  onclick="changeLanguage(`{{$language->short_name}}`, `{{asset($language->flags)}}`, `{{$language->short_name}}`)">
                    <img class="pe-2" style="width: 30px;height: 30px" src="{{ $language->flags != '' ? asset($language->flags) : asset('flags/gl.svg') }}" alt="">{{$language->name}}
                </a>
                @endforeach

            </div>
        </div>

        <div class="currency">
            <a onclick="showCurrencies()" class="currency-drpdwn-btn">
                <img id="selectedFlagCurrency" style="width: 30px;height: 30px" class="pe-2" src="https://websiteprojecttest.com/flags/currency.svg" alt="">
                <span id="selectedCurrency">Currency</span>
            </a>
            <div class="dropdown-currency" onclick="event.stopPropagation();">
                @foreach($currency_global as $currency)
                <a href="#" class="d-flex align-items-center" onclick="changeCurrency(`{{$currency->code}}`, `{{asset($currency->flags)}}`, `{{$currency->code}}`)">
                    <img class="pe-2" style="width: 30px;height: 30px" src="{{ $currency->flags !='' ? asset($currency->flags) : 'https://websiteprojecttest.com/flags/currency.svg' }}" alt="">{{$currency->code}}
                </a>
                @endforeach
                <!-- Add more currency options as needed -->
            </div>
        </div>


    </div>
</div>
<header class="header-nav nav-innerpage-style bdrb1 style2 main-menu py-0">
    <!-- Ace Responsive Menu -->
    <nav class="posr">
        <div class="container posr menu_bdrt1">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto">
                    <a class="header-logo" href="/"><img src="{{asset('agent/images/header-logo2.svg')}}"
                                                         alt="Header Logo"></a>
                </div>
                <div class="col-auto">
                    <!-- Responsive Menu Structure-->
                    <ul id="respMenu" class="ace-responsive-menu" data-menu-style="horizontal">
                        <li class="visible_list"><a class="list-item" href="{{route('/')}}"><span
                                    class="title">{{__('user.home')}}</span></a></li>
                        <li class="visible_list"><a class="list-item" href="{{route('properties')}}"><span
                                    class="title">{{__('user.properties')}}</span></a></li>
                        <li class="visible_list"><a class="list-item" href="{{route('about')}}"><span
                                    class="title">{{__('user.about')}}</span></a></li>
{{--                        <li class="visible_list"><a class="list-item" href="{{route('contact')}}">--}}
{{--                                <span class="title">{{__('user.contact')}}</span></a></li>--}}
                        <li class="visible_list"><a class="list-item" href="{{route('favorite')}}">
                                <span class="title">{{__('user.Favourites')}}</span></a></li>

{{--                        <li class="visible_list"><a class="list-item" href="{{route('view_agents')}}"><span--}}
{{--                                    class="title">{{__('user.agents')}}</span></a></li>--}}
                        @if(Auth::user())
                            <li class="visible_list"><a class="list-item" href="#"><span
                                        class="title">{{__('user.dashboard')}}</span></a>
                                <ul class="sub-menu">
                                    @if(Auth::user()->user_type == 1)
                                        <li><a href="{{route('dashboard')}}">{{__('user.admin dashboard')}}</a></li>
                                    @endif
                                    <li><a href="{{route('agent_dashboard')}}">{{__('user.dashboard')}}</a></li>
                                    <li><a href="{{route('add_property')}}">{{__('user.add new property')}}</a></li>
{{--                                    <li><a href="{{route('messages')}}">{{__('user.messages')}}</a></li>--}}
                                    <li><a href="{{route('notifications')}}">{{__('user.notifications')}}</a></li>
                                    <li><a href="{{route('my_properties')}}">{{__('user.my properties')}}</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-4">
                        @if(Auth::user())
                            <ul class="mb0 d-flex justify-content-center justify-content-sm-end p-0">
                                <li class=" user_setting">
                                    <div class="dropdown">
                                        <a class="btn mt-2" href="#" data-bs-toggle="dropdown">
                                            <img class=""
     style="width: 70px; height: 50px; object-fit: cover; border-radius: 10px; background: #e0e0e0;"
     src="{{ Auth::user()->image_path !='' ? asset(Auth::user()->image_path) : asset('agent/images/placeholder.png') }}"
     alt="">


                                        </a>
                                        <div class="dropdown-menu mobile_dropdown p-2">
                                            <div class="user_setting_content">
                                                <a class="dropdown-item mb-1"
                                                   href="{{url('profile')}}">{{__('user.My Profile')}}</a>
                                                <a class="dropdown-item" href="{{route('logout')}}"
                                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('user.Logout')}}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <div class="d-flex align-items-center gap-3">
                                <a class="login-info d-flex align-items-center ud-btn btn-thm py-2" href="{{route('login')}}"
                                   role="button"><span class="d-none d-xl-block">{{__('user.Login')}}</span></a>

                                <a class="login-info d-flex align-items-center py-2 ud-btn btn-transparent" href="{{route('register')}}"
                                   role="button"><span class="d-none d-xl-block">{{__('user.Register')}}</span></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
