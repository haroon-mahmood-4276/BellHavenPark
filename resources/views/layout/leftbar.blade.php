<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="{{ route('dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo">

            </span>
            <span class="app-brand-text demo menu-text fw-bold text-primary">{{ settings('app_name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            {{-- <i class="ti ti-chevrons-left  d-none d-xl-block ti-sm align-middle"></i> --}}
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-chevrons-right d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ request()->routeIs('dashboard.index') ? 'active' : null }}">
            <a href="{{ route('dashboard.index') }}" class="menu-link">
                <i class="fa-solid fa-home menu-icon"></i>
                <div>Dashboard</div>
            </a>
        </li>

        @if (Auth::user()->can('permissions.index') || Auth::user()->can('roles.index'))
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Administration</span>
            </li>
        @endif

        {{-- Roles & Permissions --}}
        @canany(['permissions.index', 'roles.index'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['roles.index', 'permissions.index'])? 'open active': null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-lock menu-icon"></i>
                    <div>Roles & Permissions</div>
                    {{-- <div class="badge bg-label-primary rounded-pill ms-auto">3</div> --}}
                </a>
                <ul class="menu-sub">

                    @can('roles.index')
                        <li class="menu-item {{ request()->routeIs('roles.index') ? 'active' : null }}">
                            <a href="{{ route('roles.index') }}" class="menu-link">
                                <div>Roles</div>
                            </a>
                        </li>
                    @endcan

                    @can('permissions.index')
                        <li class="menu-item {{ request()->routeIs('permissions.index') ? 'active' : null }}">
                            <a href="{{ route('permissions.index') }}" class="menu-link">
                                <div>Permissions</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        <li class="menu-item {{ request()->routeIs('settings.index') ? 'active' : null }}">
            <a href="{{ route('settings.index', ['tab' => 'general']) }}" class="menu-link">
                <i class="fa-solid fa-gears menu-icon"></i>
                <div>Settings</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Booking & Customers</span>
        </li>

        @canany(['booking-taxes.index', 'booking-taxes.create', 'booking-sources.index', 'booking-sources.create', 'bookings.index', 'bookings.create', 'bookings.checkin.index', 'bookings.checkout.index', 'bookings.calender.index'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['booking-taxes.index', 'booking-taxes.create', 'booking-sources.index', 'booking-sources.create', 'bookings.index', 'bookings.create', 'bookings.checkin.index', 'bookings.checkout.index', 'bookings.calender.index'])? 'open active': null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-bolt menu-icon"></i>
                    <div>Bookings</div>
                </a>
                <ul class="menu-sub">

                    @can('bookings.index')
                        <li class="menu-item {{ request()->routeIs('bookings.index') ? 'active' : null }}">
                            <a href="{{ route('bookings.index') }}" class="menu-link">
                                <div>View All</div>
                            </a>
                        </li>
                    @endcan

                    @can('bookings.create')
                        <li class="menu-item {{ request()->routeIs('bookings.create') ? 'active' : null }}">
                            <a href="{{ route('bookings.create') }}" class="menu-link">
                                <div>Add New</div>
                            </a>
                        </li>
                    @endcan

                    @can('bookings.checkin.index')
                        <li class="menu-item {{ request()->routeIs('bookings.checkin.index') ? 'active' : null }}">
                            <a href="{{ route('bookings.checkin.index') }}" class="menu-link">
                                <div>Check In</div>
                            </a>
                        </li>
                    @endcan

                    @can('bookings.checkout.index')
                        <li class="menu-item {{ request()->routeIs('bookings.checkout.index') ? 'active' : null }}">
                            <a href="{{ route('bookings.checkout.index') }}" class="menu-link">
                                <div><i class="menu-icon fa-solid fa-arrow-right-from-bracket"></i>Check Out</div>
                            </a>
                        </li>
                    @endcan

                    @can('bookings.calender.index')
                        <li class="menu-item {{ request()->routeIs('bookings.calender.index') ? 'active' : null }}">
                            <a href="{{ route('bookings.calender.index') }}" class="menu-link">
                                <div><i class="menu-icon fa-regular fa-calender"></i>Calender</div>
                            </a>
                        </li>
                    @endcan

                    @canany(['booking-sources.index', 'booking-sources.create'])
                        <li
                            class="menu-item {{ in_array(request()->route()->getName(),['booking-sources.index', 'booking-sources.create'])? 'open active': null }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="fa-solid fa-bolt menu-icon"></i>
                                <div>Booking Sources</div>
                            </a>
                            <ul class="menu-sub">

                                @can('booking-sources.index')
                                    <li class="menu-item {{ request()->routeIs('booking-sources.index') ? 'active' : null }}">
                                        <a href="{{ route('booking-sources.index') }}" class="menu-link">
                                            <div>View All</div>
                                        </a>
                                    </li>
                                @endcan

                                @can('booking-sources.create')
                                    <li class="menu-item {{ request()->routeIs('booking-sources.create') ? 'active' : null }}">
                                        <a href="{{ route('booking-sources.create') }}" class="menu-link">
                                            <div>Add New</div>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['booking-taxes.index', 'booking-taxes.create'])
                        <li
                            class="menu-item {{ in_array(request()->route()->getName(),['booking-taxes.index', 'booking-taxes.create'])? 'open active': null }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="fa-solid fa-bolt menu-icon"></i>
                                <div>Booking Taxes</div>
                            </a>
                            <ul class="menu-sub">

                                @can('booking-taxes.index')
                                    <li class="menu-item {{ request()->routeIs('booking-taxes.index') ? 'active' : null }}">
                                        <a href="{{ route('booking-taxes.index') }}" class="menu-link">
                                            <div>View All</div>
                                        </a>
                                    </li>
                                @endcan

                                @can('booking-taxes.create')
                                    <li class="menu-item {{ request()->routeIs('booking-taxes.create') ? 'active' : null }}">
                                        <a href="{{ route('booking-taxes.create') }}" class="menu-link">
                                            <div>Add New</div>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

        @canany(['customers.index', 'customers.create'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['customers.index', 'customers.create'])? 'open active': null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-user menu-icon"></i>
                    <div>Customers</div>
                </a>
                <ul class="menu-sub">

                    @can('customers.index')
                        <li class="menu-item {{ request()->routeIs('customers.index') ? 'active' : null }}">
                            <a href="{{ route('customers.index') }}" class="menu-link">
                                <div>View All</div>
                            </a>
                        </li>
                    @endcan

                    @can('customers.create')
                        <li class="menu-item {{ request()->routeIs('customers.create') ? 'active' : null }}">
                            <a href="{{ route('customers.create') }}" class="menu-link">
                                <div>Add New</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Others</span>
        </li>

        @canany(['payment-methods.index', 'payment-methods.create'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['payment-methods.index', 'payment-methods.create'])? 'open active': null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-dollar-sign menu-icon"></i>
                    <div>Payment Methods</div>
                </a>
                <ul class="menu-sub">

                    @can('payment-methods.index')
                        <li class="menu-item {{ request()->routeIs('payment-methods.index') ? 'active' : null }}">
                            <a href="{{ route('payment-methods.index') }}" class="menu-link">
                                <div>View All</div>
                            </a>
                        </li>
                    @endcan

                    @can('payment-methods.create')
                        <li class="menu-item {{ request()->routeIs('payment-methods.create') ? 'active' : null }}">
                            <a href="{{ route('payment-methods.create') }}" class="menu-link">
                                <div>Add New</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['international-ids.index', 'international-ids.create'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['international-ids.index', 'international-ids.create'])? 'open active': null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-id-card menu-icon"></i>
                    <div>International Ids</div>
                </a>
                <ul class="menu-sub">

                    @can('international-ids.index')
                        <li class="menu-item {{ request()->routeIs('international-ids.index') ? 'active' : null }}">
                            <a href="{{ route('international-ids.index') }}" class="menu-link">
                                <div>View All</div>
                            </a>
                        </li>
                    @endcan

                    @can('international-ids.create')
                        <li class="menu-item {{ request()->routeIs('international-ids.create') ? 'active' : null }}">
                            <a href="{{ route('international-ids.create') }}" class="menu-link">
                                <div>Add New</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(['cabins.index', 'cabins.create', 'cabin-types.index', 'cabin-types.create'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['cabins.index', 'cabins.create', 'cabin-types.index', 'cabin-types.create'])? 'open active': null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-door-open menu-icon"></i>
                    <div>Cabins</div>
                </a>
                <ul class="menu-sub">

                    @can('cabins.index')
                        <li class="menu-item {{ request()->routeIs('cabins.index') ? 'active' : null }}">
                            <a href="{{ route('cabins.index') }}" class="menu-link">
                                <div>View All</div>
                            </a>
                        </li>
                    @endcan

                    @can('cabins.create')
                        <li class="menu-item {{ request()->routeIs('cabins.create') ? 'active' : null }}">
                            <a href="{{ route('cabins.create') }}" class="menu-link">
                                <div>Add New</div>
                            </a>
                        </li>
                    @endcan

                    @canany(['cabin-types.index', 'cabin-types.create'])
                        <li
                            class="menu-item {{ in_array(request()->route()->getName(),['cabin-types.index', 'cabin-types.create'])? 'open active': null }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="fa-solid fa-dollar-sign menu-icon"></i>
                                <div>Cabin Types</div>
                            </a>
                            <ul class="menu-sub">

                                @can('cabin-types.index')
                                    <li class="menu-item {{ request()->routeIs('cabin-types.index') ? 'active' : null }}">
                                        <a href="{{ route('cabin-types.index') }}" class="menu-link">
                                            <div>View All</div>
                                        </a>
                                    </li>
                                @endcan

                                @can('cabin-types.create')
                                    <li class="menu-item {{ request()->routeIs('cabin-types.create') ? 'active' : null }}">
                                        <a href="{{ route('cabin-types.create') }}" class="menu-link">
                                            <div>Add New</div>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                </ul>
            </li>
        @endcanany

    </ul>
</aside>
