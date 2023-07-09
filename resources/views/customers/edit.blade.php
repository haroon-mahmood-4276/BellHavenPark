@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'customers.edit', $customer->id) }}
@endsection

@section('page-title', 'Edit Customer')

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Edit Customer</h2>
        {{ Breadcrumbs::render('customers.edit', $customer->id) }}
    </div>
@endsection

@section('content')
    <form class="form form-vertical create-customer-form"
        action="{{ route('customers.update', ['id' => $customer->id]) }}" method="POST"
        enctype="multipart/form-data">

        <div class="row g-3">
            <div class="col-lg-9 col-md-9 col-sm-12 position-relative">

                @csrf
                @method('PUT')
                @include('customers.form-fields')

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 position-relative">
                <div class="sticky-md-top top-lg-100px top-md-100px top-sm-0px" style="z-index: auto;">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success w-100  buttonToBlockUI me-1">
                                        <i class="fa-solid fa-floppy-disk icon mx-2"></i>
                                        Update Customer
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('customers.index') }}" class="btn btn-danger w-100 ">
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
    <script src="{{ asset('assets') }}/vendor/libs/feligx/datedropper/datedropper.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {

            new dateDropper({
                selector: '#dob',
                format: "MM dd, y",
                showArrowsOnHover: true,
                expandable: true,
                startFromMonday: true,
                defaultDate: '{{ now()->subYears(1)->format('m/d/Y') }}',
                maxDate: '{{ now()->subYears(1)->format('m/d/Y') }}',
            });

            international_id = $("#international_id");
            international_id.wrap('<div class="position-relative"></div>');
            international_id.select2({
                dropdownAutoWidth: !0,
                dropdownParent: international_id.parent(),
                width: "100%",
                containerCssClass: "select-lg",
                templateResult: c,
                templateSelection: c,
                escapeMarkup: function(international_id) {
                    return international_id
                }
            });


            $(".create-customer-form").repeater({
                show: function() {
                    $(this).slideDown();
                    InitializeDateDropper();
                },
                hide: function(e) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        customClass: {
                            confirmButton: 'btn btn-danger me-1',
                            cancelButton: 'btn btn-success me-1'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).slideUp(e);
                        }
                    });
                }
            });
        });

        function c(e) {
            return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
        }
        InitializeDateDropper();

        function InitializeDateDropper() {

            new dateDropper({
                selector: "[name^='tenants['][name$='][tenant_dob]']",
                format: "MM dd, y",
                showArrowsOnHover: true,
                expandable: true,
                startFromMonday: true,
                maxDate: '{{ now()->subYears(1)->format('m/d/Y') }}',
            });
        }
    </script>
@endsection
