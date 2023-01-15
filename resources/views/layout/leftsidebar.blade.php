<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                    <h2 class="brand-text text-break">{{ getSettings('site_name') }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('dashboard.index') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span>
                </a>
            </li>

            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">Bookings & Customers</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item mb-1">
                <a class="d-flex align-items-center" href="javascript:void(0);">
                    <i data-feather='layers'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Bookings</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('bookings.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">View All</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('bookings.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('bookings.create') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Preview">Add New</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('bookings.calenderView') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('bookings.calenderView') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Preview">Calender</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="d-flex align-items-center" href="javascript:void(0);">
                            <i data-feather='layers'></i>
                            <span class="menu-title text-truncate" data-i18n="Invoice">Booking Source</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('booking_sources.index') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('booking_sources.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">View All</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('booking_sources.create') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('booking_sources.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Preview">Add New</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('bookings.checkin.index') ? 'active' : '' }} nav-item mb-1">
                <a class="d-flex align-items-center" href="{{ route('bookings.checkin.index') }}">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="App Settings">Check In</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('bookings.checkout.index') ? 'active' : '' }} nav-item mb-1">
                <a class="d-flex align-items-center" href="{{ route('bookings.checkout.index') }}">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="App Settings">Check Out</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="d-flex align-items-center" href="javascript:void(0);">
                    <i data-feather='layers'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Customers</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('customers.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('customers.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">View All</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('customers.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('customers.create') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Preview">Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Administration --}}
            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">Administration</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class="{{ request()->routeIs('settings.index') ? 'active' : '' }} nav-item">
                <a class="d-flex align-items-center" href="{{ route('settings.index') }}">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="App Settings">App Settings</span>
                </a>
            </li>

            {{-- Others --}}
            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">Others</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item mb-1">
                <a class="d-flex align-items-center" href="javascript:void(0);">
                    <i data-feather='layers'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Cabins</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('cabins.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cabins.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">View All</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('cabins.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('cabins.create') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Preview">Add New</span>
                        </a>
                    </li>

                    <li class="">
                        <a class="d-flex align-items-center" href="javascript:void(0);">
                            <i data-feather='layers'></i>
                            <span class="menu-title text-truncate" data-i18n="Invoice">Cabin Type</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('cabin_types.index') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cabin_types.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">View All</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('cabin_types.create') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cabin_types.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Preview">Add New</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="">
                        <a class="d-flex align-items-center" href="javascript:void(0);">
                            <i data-feather='layers'></i>
                            <span class="menu-title text-truncate" data-i18n="Invoice">Cabin Status</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('cabin_statuses.index') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cabin_statuses.index') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">View All</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('cabin_statuses.create') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cabin_statuses.create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Preview">Add New</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                </ul>
            </li>

            <li class="nav-item mb-1">
                <a class="d-flex align-items-center" href="javascript:void(0);">
                    <i data-feather='layers'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">International ID's</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('internationalids.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('internationalids.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">View All</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('internationalids.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('internationalids.create') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Preview">Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item mb-1">
                <a class="d-flex align-items-center" href="javascript:void(0);">
                    <i data-feather='dollar-sign'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Payment Methods</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('payment_methods.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('payment_methods.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="List">View All</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('payment_methods.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('payment_methods.create') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Preview">Add New</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
