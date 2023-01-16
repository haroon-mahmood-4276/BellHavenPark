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
                <span class="menu-header-text">{{ __('lang.leftbar.administration') }}</span>
            </li>
        @endif

        {{-- Roles & Permissions --}}
        @canany(['permissions.index', 'roles.index'])
            <li class="menu-item {{ in_array(request()->route()->getName(), ['roles.index', 'permissions.index']) ? 'open active' : null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-lock menu-icon"></i>
                    <div>{{ __('lang.leftbar.roles_and_permissions') }}</div>
                    {{-- <div class="badge bg-label-primary rounded-pill ms-auto">3</div> --}}
                </a>
                <ul class="menu-sub">

                    @can('roles.index')
                        <li class="menu-item {{ request()->routeIs('roles.index') ? 'active' : null }}">
                            <a href="{{ route('roles.index') }}" class="menu-link">
                                <div>{{ __('lang.leftbar.roles') }}</div>
                            </a>
                        </li>
                    @endcan

                    @can('permissions.index')
                        <li class="menu-item {{ request()->routeIs('permissions.index') ? 'active' : null }}">
                            <a href="{{ route('permissions.index') }}" class="menu-link">
                                <div>{{ __('lang.leftbar.permissions') }}</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Others</span>
        </li>

        @can('sites.configurations.configView')
            <li
                class="menu-item {{ request()->routeIs('sites.configurations.configView', ['id' => encryptParams($site_id)]) ? 'active' : null }}">
                <a href="{{ route('sites.configurations.configView', ['id' => encryptParams($site_id)]) }}"
                    class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div>Site Configurations</div>
                </a>
            </li>
        @endcan

        @canany(['subscriptions.index', 'subscriptions.create'])

            <li class="menu-item {{ in_array(request()->route()->getName(), ['subscriptions.index', 'subscriptions.create']) ? 'open active' : null }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="fa-solid fa-bolt menu-icon"></i>
                    <div>Subscriptions</div>
                </a>
                <ul class="menu-sub">

                    @can('subscriptions.index')
                        <li class="menu-item {{ request()->routeIs('subscriptions.index') ? 'active' : null }}">
                            <a href="{{ route('subscriptions.index') }}" class="menu-link">
                                <div>View All</div>
                            </a>
                        </li>
                    @endcan

                    @can('subscriptions.create')
                        <li class="menu-item {{ request()->routeIs('subscriptions.create') ? 'active' : null }}">
                            <a href="{{ route('subscriptions.create') }}" class="menu-link">
                                <div>Add New</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany
    </ul>
</aside>
