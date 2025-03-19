
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item  ">
            <a class="nav-link collapsed" id="indexli" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>{{__('admin.Dashboard')}}</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" id="fbrokers_link" data-bs-target="#fbrokers" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-journal-text"></i><span>{{__('admin.Brokers')}}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="fbrokers" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a id="newagentsli" href="{{ route('new_agents') }}">
                        <i class="fa fa-user"></i>
                        <span>{{__('admin.New Agents')}}</span>
                    </a>
                </li>
                <li>
                    <a id="agentsli" href="{{ route('agents') }}">
                        <i class="fa fa-user"></i>
                        <span>{{__('admin.Agents')}}</span>
                    </a>
                </li>
                {{--                <li>--}}
                    {{--                    <a id="broker_officesli" href="{{ route('broker_offices') }}">--}}
                        {{--                        <i class="fa fa-home"></i>--}}
                        {{--                        <span>{{__('admin.Broker Offices')}}</span>--}}
                    {{--                    </a>--}}
                {{--                </li>--}}
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed active" id="property_settings_link" data-bs-target="#property_settings" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-journal-text"></i><span>{{__('admin.Property Settings')}}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="property_settings" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a id="propertiesli" href="{{ route('properties_admin') }}">
                        <i class="bi bi-card-list"></i>
                        <span>{{__('admin.Properties')}}</span>
                    </a>
                </li>

                <li>
                    <a id="property_typesli" href="{{ route('property_types') }}">
                        <i class="bi bi-card-list"></i>
                        <span>{{__('admin.Property Types')}}</span>
                    </a>
                </li>
                <li>
                    <a id="features_categoryli" href="{{ route('features_category') }}">
                        <i class="fa fa-location-arrow"></i>
                        <span>{{__('admin.Features Category')}}</span>
                    </a>
                </li>
                <li>
                    <a id="featuresli" href="{{ route('features') }}">
                        <i class="fa fa-location-arrow"></i>
                        <span>{{__('admin.Property Features')}}</span>
                    </a>
                </li>
                <li >
                    <a id="locationsli" href="{{ route('locations') }}">
                        <i class="fa fa-location-arrow"></i>
                        <span>{{__('admin.Property Locations')}}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" id="property_location_link" data-bs-target="#property_location" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-menu-button-wide"></i><span>{{__('admin.Locations')}}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="property_location" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">

                <li>
                    <a  id="citiesli" href="{{ route('cities') }}">
                        <i class="fa fa-list"></i>
                        <span>{{__('admin.Cities')}}</span>
                    </a>
                </li>
                <li>
                    <a  id="townsli" href="{{ route('towns') }}">
                        <i class="fa fa-flag"></i>
                        <span>{{__('admin.Towns')}}</span>
                    </a>
                </li>
                <li>
                    <a id="districtsli" href="{{ route('districts') }}">
                        <i class="fa fa-list"></i>
                        <span>{{__('admin.Districts')}}</span>
                    </a>
                </li>


            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" id="property_discount_link" data-bs-target="#property_discount" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-menu-button-wide"></i><span>{{__('admin.Credits')}}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="property_discount" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a  id="packagesli" href="{{ route('packages') }}">
                        <i class="fa fa-flag"></i>
                        <span>{{__('admin.Credit Packages')}}</span>
                    </a>
                </li>
                {{--                <li>--}}
                    {{--                    <a  id="discountsli" href="{{ route('discounts') }}">--}}
                        {{--                        <i class="fa fa-list"></i>--}}
                        {{--                        <span>{{__('admin.Credit Discounts')}}</span>--}}
                    {{--                    </a>--}}
                {{--                </li>--}}
                <li>
                    <a  id="credits_overviewli" href="{{ route('credits_overview') }}">
                        <i class="fa fa-list"></i>
                        <span>{{__('admin.Credits Overview')}}</span>
                    </a>
                </li>


            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" id="property_settings_nev_link" data-bs-target="#property_settings_nev" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-menu-button-wide"></i><span>{{__('admin.Settings')}}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="property_settings_nev" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li>
                    <a id="currencyli" href="{{ route('currency') }}">
                        <i class="fa fa-dollar"></i>
                        <span>{{__('admin.Currencies')}}</span>
                    </a>
                </li>
                <li>
                    <a id="languageli" href="{{ route('languages') }}">
                        <i class="fa fa-language"></i>
                        <span>{{__('Languages')}}</span>
                    </a>
                </li>
                <li>
                    <a id="settingsli" href="{{ route('settings') }}">
                        <i class="bi bi-gear"></i>
                        <span>{{__('admin.Settings')}}</span>
                    </a>
                </li>
                <li>
                    <a id="description_templateli" href="{{ route('description_template') }}">
                        <i class="bi bi-gear"></i>
                        <span>{{__('admin.Description Template')}}</span>
                    </a>
                </li>
                <li>
                    <a id="category_inputsli" href="{{ route('inputs') }}">
                        <i class="fa fa-plus"></i>
                        <span>{{__('admin.Form Builder')}}</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" id="currencyli" href="{{ route('analytics') }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>{{__('Visitor')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" id="messagesli" href="{{ route('admin_messages') }}">
                <i class="fa fa-comment"></i>
                <span>{{__('admin.Contact Form Messages')}}</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link collapsed" id="messagesli" href="{{ route('agent_messages') }}">
                <i class="fa fa-comment"></i>
                <span>{{__('Messages')}}</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link collapsed position-relative" href="{{ url('agent_messages') }}" id="message_li">
                <i class="fa fa-comment mr15"></i>
                <span>{{ __('Messages') }}</span>

                @php
                $unreadCount = \App\Models\Message::where('agent_id', auth()->id())
                ->where('is_read', false)
                ->count();
                @endphp

                @if($unreadCount > 0)
                <span class="btn btn-danger position-absolute" style="top: -5px; right: -10px; font-size: 12px; padding: 5px 8px; border-radius: 50%;">
                    {{ $unreadCount }}
                </span>
                @endif
            </a>
        </li>
        {{--        <li class="nav-item">--}}
            {{--            <a class="nav-link collapsed" id="subscribersli" href="{{ route('subscribers') }}">--}}
                {{--                <i class="fa fa-certificate"></i>--}}
                {{--                <span>{{__('admin.Newsletter List')}}</span>--}}
            {{--            </a>--}}
        {{--        </li>--}}

        {{--        <li class="nav-item">--}}
            {{--            <a class="nav-link collapsed" id="add-blogli" href="{{ route('add_blog') }}">--}}
                {{--                <i class="fa fa-plus"></i>--}}
                {{--                <span>Add Blog</span>--}}
            {{--            </a>--}}
        {{--        </li>--}}
        {{--        <li class="nav-item">--}}
            {{--            <a class="nav-link collapsed" id="blogsli" href="{{ route('admin_blogs') }}">--}}
                {{--                <i class="fa fa-list"></i>--}}
                {{--                <span>Blogs</span>--}}
            {{--            </a>--}}
        {{--        </li>--}}
    </ul>
</aside><!-- End Sidebar-->
