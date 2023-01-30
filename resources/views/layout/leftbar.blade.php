<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold text-primary">{{ env('APP_NAME') }}</span>
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

                    @can('permissions.index1')
                        <li class="menu-item {{ request()->routeIs('permissions.index') ? 'active' : null }}">
                            <a href="{{ route('permissions.index') }}" class="menu-link">
                                <div>Permissions</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Booking & Customers</span>
        </li>

        @canany(['bookings.index', 'bookings.create'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['bookings.index', 'bookings.create'])? 'open active': null }}">
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
                </ul>
            </li>
        @endcanany

        @canany(['bookings.checkin.index'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['bookings.checkin.index'])? 'open active': null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-bolt menu-icon"></i>
                    <div>Check In</div>
                </a>
            </li>
        @endcanany

        @canany(['bookings.checkout.index'])
            <li
                class="menu-item {{ in_array(request()->route()->getName(),['bookings.checkout.index'])? 'open active': null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-bolt menu-icon"></i>
                    <div>Check Out</div>
                </a>
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
