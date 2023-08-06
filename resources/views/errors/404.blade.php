@extends('errors::layout')

@section('page-title', __('Not Found'))

@section('content')
    <div class="container-xxl">
        <div class="misc-wrapper">
            <h2 class="mb-1 mt-4">Page Not Found :(</h2>
            <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary mb-4">Back to dashboard</a>
            <div class="mt-4">
                <img src="{{ asset('assets') }}/img/illustrations/page-misc-error.png" alt="page-misc-error" width="225"
                    class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container-fluid misc-bg-wrapper">
        <img src="{{ asset('assets') }}/img/illustrations/bg-shape-image-light.png" alt="page-misc-error"
            data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.html">
    </div>
@endsection
