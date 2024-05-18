@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'reports.daily') }}
@endsection

@section('page-title', 'Daily Report')

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Daily Report</h2>
        {{ Breadcrumbs::render('reports.daily') }}
    </div>
@endsection

@section('content')
    <div class="row">
        
    </div>

    <div id="modalPlace"></div>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
@endsection

@section('custom-js')
@endsection
