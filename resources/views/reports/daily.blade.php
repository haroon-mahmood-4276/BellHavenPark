@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'reports.daily') }}
@endsection

@section('page-title', 'Daily Report')

@section('page-vendor')
    @include('layout.libs.datatables.css')
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
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('reports.daily') }}" method="GET" id="report_form">
                <div class="row mb-3">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <label class="form-label" style="font-size: 15px" for="report_date_range">Date Range
                        </label>
                        <input type="text" id="report_date_range" name="report_date_range" class="form-control"
                            value="{{ now()->format('F d, Y') }} ~ {{ now()->format('F d, Y') }}"
                            placeholder="Month Date, Year - Month Date, Year" />
                    </div>

                    {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <label class="form-label" style="font-size: 15px" for="customer">Customer</label>
                        <select class="select2-size-lg form-select" id="customer" name="customer"></select>
                    </div> --}}
                </div>

                <div class="row mb-3">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="form-check form-check-inline mt-3">
                            <input type="hidden" name="group_payment_method" value="0">
                            <input class="form-check-input" type="checkbox" name="group_payment_method"id="group_payment_method" value="1">
                            <label class="form-check-label" for="group_payment_method">Payment Method Wise</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="d-flex justify-content-end align-items-center w-100 h-100">
                            <button class="btn btn-primary text-nowrap" id="apply_filter" type="submit">
                                <span>Generate Report</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @if ($showDataTable)
        <div class="card">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    @endif

    <div id="modalPlace"></div>
@endsection

@section('vendor-js')
    @include('layout.libs.datatables.js')
    <script src="{{ asset('assets') }}/vendor/libs/feligx/datedropper/datedropper.min.js"></script>
@endsection

@section('page-js')
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
        new dateDropper({
            doubleView: true,
            expandedOnly: true,
            selector: '#report_date_range',
            format: 'MM dd, y',
            startFromMonday: true,
            defaultDate: '{{ now()->toDateString() }}',
            range: true,
            onRangeSet: function(range) {
                $('#report_date_range').val(range.a.string + ' ~ ' + range.b.string);
            },
        });

        customer = $("#customer").wrap('<div class="position-relative"></div>');
        customer.select2({
            ajax: {
                url: "{{ route('ajax.customers.index') }}",
                dataType: 'json',
                delay: 500,
                data: function(params) {
                    return {
                        q: params.term,
                        type: "query",
                        page: params.page,
                        per_page: 15,
                    };
                },
                processResults: function(response, params) {
                    return {
                        results: response.data.data,
                        pagination: {
                            more: response.data.next_page_url !== null
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for Customers...',
            dropdownAutoWidth: !0,
            minimumInputLength: 2,
            dropdownParent: customer.parent(),
            width: "100%",
            containerCssClass: "select-lg",
            templateResult: function(row) {

                if (row.loading) {
                    return row.text;
                }

                var $container = $(
                    "<div class='d-flex flex-column'>" +
                    "<div class='d-flex flex-row align-content-center gap-2'>" +
                    "<div class='fw-bold fs-5'>" + row.name + "</div>" +
                    "<div class='fw-bold fs-5 dot-divider mx-0'></div>" +
                    "<div class='fw-bold fs-5' id='read-only-ratings_" + row.id + "'>&#9733; " + row
                    .average_rating + "</div>" +
                    "</div>" +
                    "<div>Email: " + (row.email || "N/A") + "</div>" +
                    "<div>Phone: " + (row.phone || "N/A") + "</div>" +
                    "<div>Address: " + (row.address || "N/A") + "</div>" +
                    "</div>"
                );

                return $container;
            },
            templateSelection: function(row) {
                if (row.id == '') {
                    return row.text;
                }
                var $container = $(
                    "<div class='d-flex flex-column'>" +
                    "<div class='d-flex flex-row align-content-center gap-2'>" +
                    "<div class='fw-bold'>" + (row.name || "") + "</div>" +
                    "<div class='dot-divider mx-0'>-</div>" +
                    "<div class='fw-bold' id='read-only-ratings_" + row.id + "'>&#9733; " + (row
                        .average_rating || "0") + "</div>" +
                    "</div>" +
                    "</div>"
                );

                return $container;
            },
        });
    </script>
@endsection
