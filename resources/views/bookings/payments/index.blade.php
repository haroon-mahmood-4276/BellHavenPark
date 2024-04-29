@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'bookings.payments.index') }}
@endsection

@section('page-title', 'Booking Payments')

@section('page-vendor')
    @include('layout.libs.datatables.css')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Booking Payments</h2>
        {{ Breadcrumbs::render('bookings.payments.index') }}
    </div>
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Statistics</h5>
                    {{-- <small class="text-muted">Updated 1 month ago</small> --}}
                </div>
                <div class="card-body pt-2">
                    <div class="row gy-3">
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-success me-3 p-3"><i
                                        class="fa-solid fa-dollar-sign fs-4"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">
                                        ${{ $credit_account > 0 ? number_format($credit_account) : '(' . number_format(abs($credit_account)) . ')' }}
                                    </h5>
                                    <small>Credit Account</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-3"><i
                                        class="fa-solid fa-plug-circle-bolt fs-4"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">
                                        @if ($electricity_account['enabled'])
                                            ${{ $electricity_account['amount'] > 0 ? number_format($electricity_account['amount']) : '(' . number_format(abs($electricity_account['amount'])) . ')' }}
                                        @else
                                            N/A
                                        @endif
                                    </h5>
                                    <small>Utility - Electricity Account</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-3"><i
                                        class="fa-solid fa-fire-flame-simple fs-4"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">
                                        @if ($gas_account['enabled'])
                                            ${{ $gas_account['amount'] > 0 ? number_format($gas_account['amount']) : '(' . number_format(abs($gas_account['amount'])) . ')' }}
                                        @else
                                            N/A
                                        @endif
                                    </h5>
                                    <small>Utility - Gas Account</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-3"><i
                                        class="fa-solid fa-droplet fs-4"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">
                                        @if ($water_account['enabled'])
                                            ${{ $water_account['amount'] > 0 ? number_format($water_account['amount']) : '(' . number_format(abs($water_account['amount'])) . ')' }}
                                        @else
                                            N/A
                                        @endif
                                    </h5>
                                    <small>Utility - Water Account</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="#" id="bookings-table-form" method="get">
                        {{-- <form action="{{ route('bookings.destroy') }}" id="bookings-table-form" method="get"> --}}
                        {{ $dataTable->table() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="modalPlace"></div>
@endsection

@section('vendor-js')
    @include('layout.libs.datatables.js')
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
                    text: '{{ __('lang.commons.are_you_sure_you_want_to_delete_the_selected_items') }}',
                    showCancelButton: true,
                    cancelButtonText: '{{ __('lang.commons.no_cancel') }}',
                    confirmButtonText: '{{ __('lang.commons.yes_delete') }}',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-relief-outline-danger waves-effect waves-float waves-light me-1',
                        cancelButton: 'btn btn-relief-outline-success waves-effect waves-float waves-light me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bookings-payment-table-form').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-relief-outline-primary waves-effect waves-float waves-light me-1',
                    },
                    text: '{{ __('lang.commons.please_select_at_least_one_item') }}',
                });
            }
        }

        function addNew(payment_type) {

            const data = {
                'prevModal': '',
                'payment_type': payment_type
            };

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('bookings.payments.create', ['booking' => ':id']) }}".replace(':id',
                    '{{ $booking_id }}'),
                data: data,
                type: 'GET',
                cache: false,
                beforeSend: function() {
                    showBlockUI();
                },
                success: function(data) {
                    if (data.status) {
                        $('#' + data.prevModal).modal('hide');
                        $('.modal-backdrop').remove();
                        $('#' + data.modalPlace).html(data.modal);
                        $('#' + data.currentModal).modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Danger',
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-danger waves-effect waves-float waves-light me-1',
                            },
                            text: data.message.error,
                        });
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
                },
                complete: function() {
                    hideBlockUI();
                },
            });

        }
    </script>
@endsection
