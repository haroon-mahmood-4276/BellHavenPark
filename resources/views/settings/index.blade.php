@extends('layout.layout')

@section('title', 'App Settings')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">App Settings</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">App Settings</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                <li class="nav-item"><a class="nav-link {{ $tab == 'general' ? 'active' : null }}"
                        href="{{ route('settings.index', ['tab' => 'general']) }}"><i
                            class="ti ti-lock ti-xs me-1"></i>General</a></li>
                {{-- <li class="nav-item"><a class="nav-link {{ $tab == 'security' ? 'active' : null }}"
                        href="{{ route('settings.index', ['tab' => 'security']) }}"><i
                            class="ti ti-lock ti-xs me-1"></i>Security</a></li> --}}
            </ul>
        </div>
    </div>

    @yield('settings-content')
@endsection
