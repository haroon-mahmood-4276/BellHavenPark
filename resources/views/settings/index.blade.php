@extends('layout.layout')

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
@endsection
