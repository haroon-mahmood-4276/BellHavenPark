@extends('layout.layout')

@section('title', 'Cabins List')

@section('PageCSS')

@endsection

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Cabins List</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Cabins List</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')

    <div class="content-body">
        <div class="card">
            <div class="card-header d-block">
                <form action="javascript:void(0);" method="GET">
                    <div class="row">
                        <div class="col-xl-9 col-lg-9 col-md-9">
                            <label class="form-label" style="font-size: 15px" for="booking_date_range">Booking Dates
                            </label>
                            <input type="text" id="booking_date_range" name="booking_date_range" class="form-control"
                                placeholder="YYYY-MM-DD" />
                        </div>
                        <div class="colxlg-3 col-lg-3 col-md-3">
                            <div class="row h-100">
                                <div class="col-6  d-flex justify-content-center align-items-end">
                                    <button class="btn w-100 btn-relief-outline-primary" id="apply_filter" type="button">
                                        <span>See Availablities</span>
                                    </button>
                                </div>
                                <div class="col-6 d-flex justify-content-center align-items-end">
                                    <a class="btn w-100 btn-relief-outline-danger" href="{{ route('bookings.create') }}">
                                        <span>Reset Availablity</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive-md">
                    <section class="section-blockui">
                        <table class="table table-hover table-hover-animation text-center">
                            <thead class="table-light">
                                <tr>
                                    <th style="vertical-align: middle;" scope="col">#</th>
                                    <th style="vertical-align: middle;" scope="col">Name</th>
                                    <th style="vertical-align: middle;" scope="col">Cabin Status</th>
                                    <th style="vertical-align: middle;" scope="col">Cabin Type</th>
                                    <th style="vertical-align: middle;" scope="col">Long Term</th>
                                    <th style="vertical-align: middle;" scope="col">Electric Meter</th>
                                    <th style="vertical-align: middle; width: 200px;" class="text-center" scope="col">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="section-block">
                                <form action="{{ route('cabins.destroy', ['cabin' => 'empty']) }}"
                                    id="delete-selected-form" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    @forelse ($cabins as $cabin)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $loop->index + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $cabin->name }}</td>
                                            <td style="vertical-align: middle;">{{ $cabin->cabin_status_name }}</td>
                                            <td style="vertical-align: middle;">{{ $cabin->cabin_type_name }}</td>
                                            <td style="vertical-align: middle;">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="form-check form-switch form-check-primary ">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="long_term_{{ $loop->index }}" disabled
                                                            name="long_term_{{ $loop->index }}" value="1"
                                                            {{ $cabin->long_term == '1' ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="long_term">
                                                            <span class="switch-icon-left"><i
                                                                    data-feather="check"></i></span>
                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="d-flex align-items-center justify-content-center">

                                                    <div class="form-check form-switch form-check-primary">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="electric_meter_{{ $loop->index }}" disabled
                                                            name="electric_meter_{{ $loop->index }}" value="1"
                                                            {{ $cabin->electric_meter == '1' ? 'checked' : '' }} />
                                                        <label class="form-check-label" for="electric_meter">
                                                            <span class="switch-icon-left"><i
                                                                    data-feather="check"></i></span>
                                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <button class="btn btn-relief-outline-primary"
                                                    onclick="addBooking({{ $cabin->id }});" type="button"
                                                    id="add_booking_{{ $cabin->id }}"
                                                    class="add_booking_{{ $cabin->id }}">

                                                    <span class="ms-25 align-middle"
                                                        id="add_booking_{{ $cabin->id }}_label">Add Booking</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="20" style="text-align: center">Data not found.</td>
                                        </tr>
                                    @endforelse

                                </form>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>

        <div id="modalPlace"></div>
    </div>

@endsection

@section('PageJS')
    {{-- <script src="{{ asset('public_assets/admin') }}/js/scripts/extensions/ext-component-blockui.js"></script> --}}
    <script>
        if ($('#apply_filter').length && $('#section-block').length) {
            $('#apply_filter').on('click', function() {
                showBlockUI();

                var booking_date_range = $('#booking_date_range').val();

                window.location.replace("{{ route('bookings.create', ['booking_date_range' => ':date_range']) }}".replace('%3Adate_range', booking_date_range));
            });
        }

        $('#reset_filter').on('click', function() {
            hideBlockUI();
        });

        $('#booking_date_range').flatpickr({
            mode: "range",
            weekNumbers: true,
            minDate: '{{ now() }}',
            defaultDate: ['{{ $booking_from }}', '{{ $booking_to }}']
        })

        function addBooking(id) {
            showBlockUI();

            var booking_date_range = $('#booking_date_range').val().split(' ');

            let date_from = '',
                date_to = '';

            if (booking_date_range[0]) {
                date_from = booking_date_range[0];
            }

            if (booking_date_range[2]) {
                date_to = booking_date_range[2];
            }

            const data = {
                'date_from': date_from,
                'date_to': date_to,
                'prevModal': '',
            };

            $('#add_booking_' + id).prop('disabled', true);


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('bookings.create.modal', ['cabin_id' => ':id']) }}".replace(':id', id),
                data: data,
                type: 'GET',
                cache: false,
                success: function(data) {
                    if (data.status) {
                        $('#add_booking_' + id).prop('disabled', false);

                        $('#' + data.prevModal).modal('hide');
                        $('#' + data.modalPlace).html(data.modal);
                        $('#' + data.currentModal).modal('show');
                        hideBlockUI();
                    }
                },
                error: function(jqXhr, json, errorThrown) {
                    $('#add_booking_' + id).prop('disabled', false);

                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';

                    $.each(errors['errors'], function(index, value) {
                        errorsHtml += "<span class='badge rounded-pill bg-danger p-3 m-3'>" + index +
                            " -> " + value + "</span>";
                    });
                    hideBlockUI();
                }
            });

        }
    </script>
@endsection

{{-- .selected
.startRange
.inRange
.endRange --}}
