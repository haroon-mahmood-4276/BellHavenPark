@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills flex-column gap-3 flex-md-row mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ $tab == 'general' ? 'active' : null }}"
                        href="{{ route('settings.index', ['tab' => 'general']) }}">
                        <i class="fa-solid fa-house-medical me-2"></i>General
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab == 'utilities' ? 'active' : null }}"
                        href="{{ route('settings.index', ['tab' => 'utilities']) }}">
                        <i class="fa-solid fa-bolt me-2"></i>Utilities
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection
