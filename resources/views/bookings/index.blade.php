@extends('layout.layout')

@section('title', 'Bookings')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Bookings</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Bookings</a>
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
        <!-- table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('bookings.create') }}" class="btn btn-relief-outline-primary" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" title="Add Booking">
                    <i data-feather="plus"></i>
                    <span class="ms-25">Add Booking</span>
                </a>
                @if (!is_null($bookings) && !empty($bookings))
                    {{ $bookings->onEachSide(2)->links('layout.pagination') }}
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive-xl">
                    <table class="table table-hover table-hover-animation text-center">
                        <thead class="table-light">
                            <tr>
                                <th style="vertical-align: middle;" scope="col">#</th>
                                <th style="vertical-align: middle;" scope="col">Name</th>
                                <th style="vertical-align: middle;" scope="col">Cabin</th>
                                <th style="vertical-align: middle;" scope="col">Booking From</th>
                                <th style="vertical-align: middle;" scope="col">Booking To</th>
                                <th style="vertical-align: middle;" scope="col">Check In</th>
                                <th style="vertical-align: middle;" scope="col">Check Out</th>
                                <th style="vertical-align: middle;" scope="col">Booking Source</th>
                                <th style="vertical-align: middle;" scope="col">Time / Date</th>
                                <th style="vertical-align: middle; width: 150px;" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('bookings.destroy', ['booking' => 'empty']) }}"
                                id="delete-selected-form" method="POST">
                                @csrf
                                @method('DELETE')
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td style="vertical-align: middle;">{{ $booking->id }}</td>
                                        <td style="vertical-align: middle;">
                                            {{ $booking->customer_first_name . ' ' . $booking->customer_last_name ?? '...' }}
                                        </td>
                                        <td style="vertical-align: middle;">{{ $booking->cabin_name ?? '...' }}</td>
                                        <td style="vertical-align: middle;">
                                            {{ !is_null($booking->booking_from) && !empty($booking->booking_from) ? date('d/m/Y', strtotime($booking->booking_from)) : '...' }}
                                        <td style="vertical-align: middle;">
                                            {{ !is_null($booking->booking_to) && !empty($booking->booking_to) ? date('d/m/Y', strtotime($booking->booking_to)) : '...' }}
                                        <td style="vertical-align: middle;">
                                            @if (!is_null($booking->check_in_date) && !empty($booking->check_in_date))
                                                {{ date('H:i:s', strtotime($booking->check_in_date)) }} <br>
                                                <span
                                                    class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($booking->check_in_date)) }}</span>
                                            @else
                                                <strong>...</strong>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            @if (!is_null($booking->check_out_date) && !empty($booking->check_out_date))
                                                {{ date('H:i:s', strtotime($booking->check_out_date)) }} <br>
                                                <span
                                                    class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($booking->check_out_date)) }}</span>
                                            @else
                                                <strong>...</strong>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">{{ $booking->booking_source_name ?? '...' }}
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {{ date('H:i:s', strtotime($booking->created_at)) }} <br>
                                            <span
                                                class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($booking->created_at)) }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-relief-outline-primary me-1" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Edit Booking"
                                                    href="{{ route('bookings.edit', ['booking' => encryptParams($booking->id)]) }}">
                                                    <i data-feather="edit-2" class=""></i>
                                                    {{-- <span>Edit</span> --}}
                                                </a>
                                                <a class="btn btn-relief-outline-primary" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Booking Payments"
                                                    href="{{ route('bookings.payments.index', ['booking' => encryptParams($booking->id)]) }}">
                                                    <i data-feather='dollar-sign' class=""></i>
                                                    {{-- <span>Payments</span> --}}
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" style="text-align: center">Data not found.</td>
                                    </tr>
                                @endforelse
                            </form>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('bookings.create') }}" class="btn btn-relief-outline-primary" data-bs-toggle="tooltip"
                    data-bs-placement="bottom" title="Add Booking">
                    <i data-feather="plus"></i>
                    <span class="ms-25">Add Booking</span>
                </a>
                @if (!is_null($bookings) && !empty($bookings))
                    {{ $bookings->onEachSide(2)->links('layout.pagination') }}
                @endif
            </div>
        </div>
        <!-- table -->
    </div>

@endsection




























@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'bookings.index') }}
@endsection

@section('page-title', 'Bookings')

@section('page-vendor')
    {{ view('layout.datatables.css') }}
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Cabin Types</h2>
        {{ Breadcrumbs::render('bookings.index') }}
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bookings.destroy') }}" id="cabin-types-table-form" method="get">
                        {{ $dataTable->table() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    {{ view('layout.datatables.js') }}
@endsection

@section('page-js')
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
        function deleteSelected() {
            var selectedCheckboxes = $('.dt-checkboxes:checked').length;
            if (selectedCheckboxes > 0) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Are you sure you want to delete the selected items?',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-1',
                        cancelButton: 'btn btn-success me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#cabin-types-table-form').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please select at least one item!',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-1',
                        cancelButton: 'btn btn-success me-1'
                    },
                });
            }
        }

        function addNew() {
            location.href = "{{ route('bookings.create') }}";
        }
    </script>
@endsection
