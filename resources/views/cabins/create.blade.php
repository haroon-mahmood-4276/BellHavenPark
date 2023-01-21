@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'cabins.create') }}
@endsection

@section('page-title', 'Create Cabins')

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Create Cabins</h2>
        {{ Breadcrumbs::render('cabins.create') }}
    </div>
@endsection

@section('content')
    <form class="form form-vertical" action="{{ route('cabins.store') }}" method="POST" enctype="multipart/form-data">

        <div class="row g-3">
            <div class="col-lg-9 col-md-9 col-sm-12 position-relative">

                @csrf
                {{ view('cabins.form-fields', ['cabin_types' => $cabin_types, 'cabin_statuses' => $cabin_statuses]) }}

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 position-relative">
                <div class="sticky-md-top top-lg-100px top-md-100px top-sm-0px" style="z-index: auto;">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success w-100  buttonToBlockUI me-1">
                                        <i class="fa-solid fa-floppy-disk icon mx-2"></i>
                                        Save Cabin
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('cabins.index') }}" class="btn btn-danger w-100 ">
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
<script>
    $(document).ready(function() {
        cabin_type = $("#cabin_type");
        cabin_type.wrap('<div class="position-relative"></div>');
        cabin_type.select2({
            dropdownAutoWidth: !0,
            dropdownParent: cabin_type.parent(),
            width: "100%",
            containerCssClass: "select-lg",
            templateResult: c,
            templateSelection: c,
            escapeMarkup: function(cabin_type) {
                return cabin_type
            }
        });

        cabin_status = $("#cabin_status");
        cabin_status.wrap('<div class="position-relative"></div>');
        cabin_status.select2({
            dropdownAutoWidth: !0,
            dropdownParent: cabin_status.parent(),
            width: "100%",
            containerCssClass: "select-lg",
            templateResult: c,
            templateSelection: c,
            escapeMarkup: function(cabin_status) {
                return cabin_status
            }
        });
    });

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }
</script>
@endsection
