@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'meter-readings.create') }}
@endsection

@section('page-title', 'Add Meter Reading')

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Add Meter Reading</h2>
        {{ Breadcrumbs::render('meter-readings.create') }}
    </div>
@endsection

@section('content')
    <form class="form form-vertical create-meter-readings-form" action="{{ route('meter-readings.store') }}" method="POST"
        enctype="multipart/form-data">

        <div class="row g-3">
            <div class="col-lg-9 col-md-9 col-sm-12 position-relative">

                @csrf
                @include('meter-readings.form-fields')

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 position-relative">
                <div class="sticky-md-top top-lg-100px top-md-100px top-sm-0px" style="z-index: auto;">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-check form-check-primary">
                                        <input type="hidden" name="add_another_reading" value="0" />
                                        <input type="checkbox" name="add_another_reading" id="check_add_another_reading"
                                            class="form-check-input" value="1" />
                                        <label class="form-check-label" for="check_add_another_reading">Add another
                                            reading</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success w-100  buttonToBlockUI me-1">
                                        <i class="fa-solid fa-floppy-disk icon mx-2"></i>
                                        Save Meter Reading
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ isset($return_url) ? $return_url : route('meter-readings.index') }}"
                                        class="btn btn-danger w-100 ">
                                        <i class="fa-solid fa-xmark icon mx-2"></i>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <h4 class="alert-heading"><i data-feather="info" class="me-50"></i>Information!</h4>
                                <div class="alert-body">

                                    <span class="text-danger">*</span> means required field. <br>
                                    <span class="text-danger">**</span> means required field and must be unique.
                                </div>
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
@endsection

@section('custom-js')
    @include('meter-readings.form-fields-js', ['from' => 'create'])
@endsection
