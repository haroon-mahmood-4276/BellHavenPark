@extends('layout.layout')

@section('title', 'Bookings (Check Out)')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Bookings (Check Out)</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Bookings (Check Out)</a>
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
                {{-- <a href="{{ route('bookings.create') }}" class="btn btn-relief-outline-primary">
                    <i data-feather="plus" class="me-25"></i>
                    <span>Add</span>
                </a> --}}
                @if (!is_null($checkoutList) && !empty($checkoutList))
                    {{ $checkoutList->onEachSide(2)->links('layout.pagination') }}
                @endif
                {{-- <button class="btn btn-relief-outline-danger btn-delete-selected" id="btn-delete-selected">
                    <i data-feather="trash" class="me-25"></i>
                    <span>Delete Selected</span>
                </button> --}}
            </div>

            <div class="card-body">
                <div class="table-responsive-xl">
                    <table class="table table-hover table-hover-animation text-center">
                        <thead class="table-light">
                            <tr>
                                <th style="vertical-align: middle;" scope="col">Booking ID</th>
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
                                @forelse ($checkoutList as $booking)
                                    <tr>
                                        <td style="vertical-align: middle;">{{ $booking->id }}</td>
                                        <td style="vertical-align: middle;">
                                            {{ $booking->customer_first_name . ' ' . $booking->customer_last_name ?? '...' }}
                                        </td>
                                        <td style="vertical-align: middle;">{{ $booking->cabin_name ?? '...' }}</td>
                                        <td style="vertical-align: middle;">
                                            {{ !is_null($booking->booking_from) && !empty($booking->booking_from)? date('d/m/Y', strtotime($booking->booking_from)): '...' }}
                                        <td style="vertical-align: middle;">
                                            {{ !is_null($booking->booking_to) && !empty($booking->booking_to)? date('d/m/Y', strtotime($booking->booking_to)): '...' }}
                                        <td style="vertical-align: middle;">
                                            {{ date('H:i:s', strtotime($booking->check_in_date)) }} <br>
                                            <span
                                                class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($booking->check_in_date)) }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">

                                            <strong>...</strong>
                                        </td>
                                        <td style="vertical-align: middle;">{{ $booking->booking_source_name ?? '...' }}
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {{ date('H:i:s', strtotime($booking->created_at)) }} <br>
                                            <span
                                                class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($booking->created_at)) }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <a class="btn btn-relief-outline-primary"
                                                href="{{ route('bookings.checkout.store', ['booking' => $booking->id]) }}"
                                                id="check_out_{{ $booking->id }}"
                                                class="check_out_{{ $booking->id }}">
                                                <span class="spinner-grow spinner-grow-sm visually-hidden"
                                                    id="check_out_{{ $booking->id }}_loading" role="status"
                                                    aria-hidden="true"></span>
                                                <span class="ms-25 align-middle"
                                                    id="check_out_{{ $booking->id }}_label">Check Out</span>
                                                <span class="ms-25 align-middle visually-hidden"
                                                    id="check_out_{{ $booking->id }}_labelLoading">Loading...</span>
                                            </a>
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
                {{-- <a href="{{ route('bookings.create') }}" class="btn btn-relief-outline-primary">
                    <i data-feather="plus" class="me-25"></i>
                    <span>Add</span>
                </a> --}}
                @if (!is_null($checkoutList) && !empty($checkoutList))
                    {{ $checkoutList->onEachSide(2)->links('layout.pagination') }}
                @endif
                {{-- <button class="btn btn-relief-outline-danger btn-delete-selected" id="btn-delete-selected">
                    <i data-feather="trash" class="me-25"></i>
                    <span>Delete Selected</span>
                </button> --}}
            </div>
        </div>
        <!-- table -->
    </div>

@endsection
