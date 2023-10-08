@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'bookings.create') }}
@endsection

@section('page-title', 'Cabins List')

@section('page-vendor')
    {{ view('layout.libs.datatables.css') }}
@endsection

@section('page-css')
    {{-- <script src="{{ asset('assets') }}/vendor/libs/formvalidation/dist/css/formValidation.min.css"></script> --}}
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Cabins List</h2>
        {{ Breadcrumbs::render('bookings.create') }}
    </div>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="javascript:void(0);" method="GET">
                        <div class="row g-3">
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <label class="form-label" style="font-size: 15px" for="booking_date_range">Booking Dates
                                </label>
                                <input type="text" id="booking_date_range" name="booking_date_range" class="form-control"
                                    value="{{ $booking_from->format('F j, Y') }} - {{ $booking_to->format('F j, Y') }}"
                                    placeholder="Month Date, Year - Month Date, Year" />
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="row h-100">
                                    <div class="col-6 d-flex justify-content-center align-items-end">
                                        <button class="btn btn-primary text-nowrap" id="apply_filter" type="button">
                                            <span>See Availablity</span>
                                        </button>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center align-items-end">
                                        <a class="btn btn-danger text-nowrap" href="{{ route('bookings.create') }}">
                                            <span>Reset Availablity</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($showTable)
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <form action="{{ route('bookings.destroy') }}" id="bookings-table-form" method="get"> --}}
                        <form action="#" id="bookings-table-form" method="get">
                            {{ $dataTable->table() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <div id="modalPlace"></div>
@endsection

@section('vendor-js')
    {{ view('layout.libs.datatables.js') }}
@endsection

@section('page-js')
    <script src="{{ asset('assets') }}/vendor/libs/feligx/datedropper/datedropper.min.js"></script>
    {{-- <script src="{{ asset('assets') }}/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script> --}}
    {{-- <script src="{{ asset('assets') }}/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script> --}}
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
        var pageState = {
            booking_date_range: '',
            cabin_id: '',
            booking_from: '',
            booking_to: '',
            prevModal: 'modalPlace',
        };

        ['popstate', 'hashchange', 'load'].forEach(function(e) {
            window.addEventListener(e, function(event) {

                let params = new URLSearchParams(window.location.search);

                if (params.get('cabin_id') !== null && params.get('booking_from') !== null && params.get(
                        'booking_to') !== null) {

                    if (parseInt(params.get('cabin_id')) > 0 && params.get('booking_from') >=
                        {{ now()->startOfDay()->timestamp }} &&
                        params.get('booking_to') >= {{ now()->startOfDay()->timestamp }}) {

                        addBooking(params.get('cabin_id'), params.get('booking_from'), params.get(
                            'booking_to'));

                    }
                } else {
                    $('#basicModal').modal('hide');
                }
            });
        });

        new dateDropper({
            // overlay: true,
            // expandable: true,
            // expandedDefault: true,
            // doubleView: true,
            expandedOnly: true,
            selector: '#booking_date_range',
            format: 'MM dd, y',
            startFromMonday: true,
            minDate: '{{ now()->subDays(1)->toDateString() }}',
            defaultDate: '{{ now()->toDateString() }}',
            range: true,
            onRangeSet: function(range) {
                $('#booking_date_range').val(range.a.string + ' - ' + range.b.string);
            },
        });

        $('#apply_filter').on('click', function() {
            showBlockUI();
            var booking_date_range = $('#booking_date_range').val();

            window.location.replace("{{ route('bookings.create', ['booking_date_range' => ':date_range']) }}"
                .replace('%3Adate_range', booking_date_range));
        });

        $('#reset_filter').on('click', function() {
            hideBlockUI();
        });

        function callBookingModal(cabin_id) {
            let booking_date_range = $('#booking_date_range').val().split('-');

            let booking_from = '',
                booking_to = '';

            if (booking_date_range[0]) {
                booking_from = moment(booking_date_range[0].trim()).add(5, 'hours').unix();
            }

            if (booking_date_range[1]) {
                booking_to = moment(booking_date_range[1].trim()).add(5, 'hours').unix();
            }

            addBooking(cabin_id, booking_from, booking_to);
        }

        function addBooking(cabin_id, booking_from, booking_to) {
            showBlockUI();

            pageState = {
                booking_date_range: (moment.unix(booking_from).format('LL') + ' - ' + moment.unix(booking_to).format(
                    'LL')).replaceAll(' ', '%20'),
                cabin_id: cabin_id,
                booking_from: booking_from,
                booking_to: booking_to,
                prevModal: 'modalPlace',
            };

            history.pushState(pageState, "", '?booking_date_range=' + pageState.booking_date_range + '&cabin_id=' +
                pageState.cabin_id + '&booking_from=' + pageState.booking_from + '&booking_to=' + pageState.booking_to);

            $('#add_booking_' + cabin_id).prop('disabled', true);

            pageState.return_url = window.location.href;

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('bookings.create.modal') }}",
                data: pageState,
                type: 'GET',
                cache: false,
                success: function(response) {

                    if (response.status) {
                        $('#add_booking_' + cabin_id).prop('disabled', false);

                        $('#' + response.modalPlace).html(response.modal);
                        $('#' + response.currentModal).modal('show');
                        hideBlockUI();
                    }
                },
                error: function(jqXhr, json, errorThrown) {
                    hideBlockUI();

                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';

                    $.each(errors['errors'], function(index, value) {
                        errorsHtml += "<span class='badge rounded-pill bg-danger p-3 m-3'>" + index +
                            " -> " + value + "</span>";
                    });
                    $('#add_booking_' + id).prop('disabled', false);
                }
            });

        }
    </script>
@endsection
