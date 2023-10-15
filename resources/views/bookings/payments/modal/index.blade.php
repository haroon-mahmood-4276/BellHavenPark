<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="basicModalLabel1">Add Payments - {{ $booking->cabin->name }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="basicModal-close"></button>
            </div>

            <div class="modal-body mb-0">
                <form action="{{ route('bookings.payments.store', ['id' => $booking->id]) }}" method="POST"
                    id="form_booking_store">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                            <label class="form-label" style="font-size: 15px" for="booking_id">Booking ID</label>
                            <input type="text" class="form-control" id="booking_id"
                                value="{{ $booking->booking_number }}" placeholder="Booking ID" readonly />
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="customer">Customer</label>
                            <input type="text" id="customer" class="form-control" placeholder="Customer"
                                aria-label="Customer" readonly value="{{ $booking->customer->name }}" />
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="booking_date">Booking
                                Date</label>
                            <input type="text" id="booking_date" name="booking_date" class="form-control"
                                placeholder="Booking Date" aria-label="Booking Date" readonly
                                value="{{ date('F j, Y', strtotime($booking->created_at)) }}" />
                        </div>

                    </div>

                    <div class="row mb-3 text-center">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Type</p>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Rate</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Total</p>
                        </div>

                        {{-- <div class="col-xl-3 col-lg-3 col-md-3">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Less Booking</p>
                        </div> --}}
                    </div>

                    {{-- Daily Rate --}}
                    <div class="row mb-3">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="d-flex align-items-center h-100">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rate_type" id="rate_daily"
                                        value="daily_rate" checked />
                                    <label class="form-check-label" style="font-size: 15px; font-weight: bold;"
                                        for="rate_daily">Daily Rate</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="input-group ">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="txt_daily_rate" name="txt_daily_rate"
                                    placeholder="Daily Rate" value="{{ $booking->daily_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group ">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="txt_daily_total" name="txt_daily_total"
                                    placeholder="Daily Rate" value="{{ $booking->daily_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        {{-- <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group ">

                                @php
                                    $percentage = $booking->daily_less_booking_percentage ?? 0;

                                    $daily_less_booking = ($booking->daily_rate * $percentage) / 100;
                                @endphp

                                <span
                                    class="input-group-text">{{ Str::of($booking->daily_less_booking_percentage ?? 0)->padLeft(2, '0') }}
                                    %</span>
                                <input type="text" id="txt_daily_less_booking_percentage" class="form-control"
                                    placeholder="Less Booking" value="{{ $daily_less_booking }}" readonly />
                            </div>
                        </div> --}}
                    </div>

                    {{-- Weekly Rate --}}
                    <div class="row mb-3">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="d-flex align-items-center h-100">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rate_type" id="rate_weekly"
                                        value="weekly_rate" />
                                    <label class="form-check-label" style="font-size: 15px; font-weight: bold;"
                                        for="rate_weekly">Weekly Rate</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="input-group ">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="txt_weekly_rate"
                                    name="txt_weekly_rate" placeholder="Weekly Rate"
                                    value="{{ $booking->weekly_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group ">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="txt_weekly_total"
                                    name="txt_weekly_total" placeholder="Weekly Rate"
                                    value="{{ $booking->weekly_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        {{-- <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group ">

                                @php
                                    $percentage = $booking->weekly_rate_less_booking_percentage ?? 0;

                                    $weekly_less_booking = ($booking->weekly_rate * $percentage) / 100;
                                @endphp

                                <span
                                    class="input-group-text">{{ Str::of($booking->weekly_rate_less_booking_percentage ?? 0)->padLeft(2, '0') }}
                                    %</span>
                                <input type="text" id="txt_weekly_less_booking_percentage" class="form-control"
                                    placeholder="Less Booking" value="{{ $weekly_less_booking }}" readonly />
                            </div>
                        </div> --}}
                    </div>

                    {{-- Four Weekly Rate --}}
                    <div class="row mb-3">
                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="d-flex align-items-center h-100">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rate_type"
                                        id="rate_monthly" value="four_weekly_rate" />
                                    <label class="form-check-label" style="font-size: 15px; font-weight: bold;"
                                        for="rate_monthly">Monthly Rate</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="input-group ">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="txt_four_weekly_rate"
                                    name="txt_four_weekly_rate" placeholder="monthly Rate"
                                    value="{{ $booking->four_weekly_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group ">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="txt_four_weekly_total"
                                    name="txt_four_weekly_total" placeholder="monthly Rate"
                                    value="{{ $booking->four_weekly_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        {{-- <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group ">

                                @php
                                    $percentage = $booking->four_weekly_less_booking_percentage ?? 0;

                                    $four_weekly_less_booking = ($booking->four_weekly_rate * $percentage) / 100;
                                @endphp

                                <span
                                    class="input-group-text">{{ Str::of($booking->four_weekly_less_booking_percentage ?? 0)->padLeft(2, '0') }}
                                    %</span>
                                <input type="text" id="txt_four_weekly_less_booking_percentage" class="form-control"
                                    placeholder="Less Booking" value="{{ $four_weekly_less_booking }}" readonly />
                            </div>
                        </div> --}}
                    </div>

                    {{-- Date Range --}}
                    <div class="row mb-3">

                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" style="font-size: 15px" for="payment_from">Payment From
                                        <span class="text-danger">*</span></label>
                                    <input type="text" id="payment_from" class="payment_dates form-control"
                                        placeholder="Payment From" readonly aria-label="Payment From"
                                        value="{{ Carbon\Carbon::parse($last_payment_date)->format('F j, Y') }}"
                                        name="payment_from" />
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                                    <label class="form-label" style="font-size: 15px" for="payment_to">Payment To
                                        <span class="text-danger">*</span></label>
                                    <input type="text" id="payment_to" class="payment_dates form-control"
                                        placeholder="Payment To" aria-label="Payment To"
                                        value="{{ Carbon\Carbon::parse($last_payment_date)->addDay()->format('F j, Y') }}"
                                        name="payment_to" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input type="hidden" id="days_count" value="1" name="days_count" />
                                    <p class="m-0" style="font-size: 15px">Days count: <span id="text_days_count"
                                            class="text-primary">1</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="advance_booking_payment">Advance
                                Payment</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" id="advance_booking_payment" name="advance_payment"
                                    class="form-control" placeholder="Advance Payment" aria-label="Advance Payment "
                                    readonly value="{{ number_format($advanced_payment, 2) }}" />
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row mb-3">

                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" style="font-size: 15px" for="payment_from">Payment From
                                        <span class="text-danger">*</span></label>
                                    <input type="text" id="payment_from" class="payment_dates form-control"
                                        placeholder="Payment From" readonly aria-label="Payment From"
                                        value="{{ Carbon\Carbon::parse($last_payment_date)->format('F j, Y') }}" name="payment_from" />
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                                    <label class="form-label" style="font-size: 15px" for="payment_to">Payment To <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="payment_to" class="payment_dates form-control"
                                        placeholder="Payment To" aria-label="Payment To"
                                        value="{{ Carbon\Carbon::parse($last_payment_date)->addDay()->format('F j, Y') }}" name="payment_to" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <input type="hidden" id="days_count" value="1" name="days_count" />
                                    <p class="m-0" style="font-size: 15px">Days count: <span id="text_days_count"
                                            class="text-primary">1</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="advance_booking_payment">Advance
                                Payment</label>
                            <div class="input-group ">
                                <span class="input-group-text">$</span>
                                <input type="text" id="advance_booking_payment" name="advance_payment"
                                    class="form-control" placeholder="Advance Payment" aria-label="Advance Payment "
                                    readonly value="{{ number_format($advanced_payment, 2) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="px-5">
                        <hr>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive-xl">
                                <table class="table table-hover table-hover-animation">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="vertical-align: middle; width: 20%;" scope="col">Type</th>
                                            <th style="vertical-align: middle;" scope="col">Rate</th>
                                            <th style="vertical-align: middle;" scope="col">Less Booking</th>
                                            <th style="vertical-align: middle;" scope="col">Sub Total</th>
                                            <th style="vertical-align: middle;" scope="col">Days</th>
                                            <th style="vertical-align: middle;" scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-nowrap" style="vertical-align: middle;">
                                                <p class="m-0" id="table_rate_type">
                                                    Daily Rate
                                                </p>
                                            </th>
                                            <td class="text-nowrap" style="vertical-align: middle;">
                                                <p class="m-0" id="table_rate_amount">
                                                    0
                                                </p>
                                            </td>
                                            <td class="text-nowrap" style="vertical-align: middle;">
                                                <p class="m-0" id="table_less_booking_amount">
                                                    0
                                                </p>
                                            </td>
                                            <td class="text-nowrap" style="vertical-align: middle;">
                                                <p class="m-0" id="table_sub_total">
                                                    0
                                                </p>
                                            </td>
                                            <td class="text-nowrap" style="vertical-align: middle;">
                                                <p class="m-0" id="table_days_count">
                                                    1 Day(s)
                                                </p>
                                            </td>
                                            <td class="text-nowrap" style="vertical-align: middle;">
                                                <p class="m-0" id="table_total">
                                                    0
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <input type="hidden" name="tax" value="{{ $booking_tax->amount }}">
                                            <input type="hidden" name="tax_flat" value="{{ $booking_tax->is_flat ? 'true' : 'false' }}">
                                            <th style="vertical-align: middle;" colspan="5">Tax ( {{ $booking_tax->amount }}% )</th>
                                            <td style="vertical-align: middle;">
                                                <p class="m-0" id="table_tax_amount">
                                                    0
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th style="vertical-align: middle;" colspan="5">Sub Total</th>
                                            <td style="vertical-align: middle;">
                                                <p class="m-0" id="table_gross_total">
                                                    0
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th style="vertical-align: middle;" colspan="5">Advance
                                                Payment</th>
                                            <td style="vertical-align: middle;">
                                                <p class="m-0" id="table_advanced_payment">
                                                    $ {{ $advanced_payment }}.00
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th style="vertical-align: middle;" colspan="5"
                                                id="table_text_total_receivables">Total Receivable</th>
                                            <th style="vertical-align: middle;">
                                                <p class="m-0" id="table_total_receivables">
                                                    0
                                                </p>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">
                            <label class="form-label" style="font-size: 15px" for="payment_methods">Payment
                                Methods</label>
                            <select class="select2InModal select2-size-lg form-select" id="payment_methods"
                                name="payment_methods">
                                @foreach ($payment_methods as $payment_method)
                                    <option data-icon="fa-solid fa-angle-right" value="{{ $payment_method->id }}">
                                        {{ $payment_method->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                            <div class="d-flex align-items-end justify-content-center w-100 h-100">
                                <a href="{{ route('payment-methods.create') }}" class="btn w-100 btn-primary me-1">
                                    <span><i class="fa-solid fa-plus"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="comments">Comments</label>
                            <textarea id="comments" name="comments" class="form-control" placeholder="Comments" aria-label="comments"
                                rows="5"></textarea>
                        </div>
                    </div> --}}

                    <button type="submit" class="d-none" id="submitForm">
                    </button>
                </form>

            </div>
            <div class="modal-footer pb-1">
                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal" aria-label="Close">
                    <span>Close</span>
                </button>
                <button type="button" class="btn btn-primary" onclick="formSubmit();">
                    <span>Save</span>
                </button>

            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets') }}/vendor/libs/feligx/datedropper/datedropper.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[id^="rate_"]:checked').trigger('change');

        booking_source = $("#payment_methods");
        booking_source.wrap('<div class="position-relative"></div>');
        booking_source.select2({
            dropdownAutoWidth: !0,
            dropdownParent: booking_source.parent(),
            width: "100%",
            containerCssClass: "select-lg",
            templateResult: c,
            templateSelection: c,
            escapeMarkup: function(booking_source) {
                return booking_source
            }
        });
    });

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }

    new dateDropper({
        // overlay: true,
        // expandedDefault: true,
        expandable: true,
        selector: '#payment_to',
        format: 'MM dd, y',
        startFromMonday: true,
        minDate: '{{ Carbon\Carbon::parse($last_payment_date)->toDateString() }}',
        defaultDate: '{{ Carbon\Carbon::parse($last_payment_date)->addDay()->toDateString() }}',
        maxDate: '{{ $booking->booking_to->toDateString() }}',
        onChange: function(res) {
            $('#payment_to').val(res.output.string);

            let date1 = moment($('#payment_from').val());
            let date2 = moment($('#payment_to').val());

            let diffInDays = date2.diff(date1, 'days');

            $('#text_days_count').html(diffInDays);
            $('#days_count').val(diffInDays);

            $('input[id^="rate_"]:checked').trigger('change');
        },
    });

    function ucFirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    $('input[id^="rate_"]').on('change', function(e) {
        // console.log(e.target.id);
        if ($(this).is(':checked')) {

            let table_rate_type = ucFirst($(this).val()).replaceAll('_', ' ');
            let table_rate_amount = '';
            let table_less_booking_amount = '';
            let table_sub_total = '';
            let table_daysCount = parseInt($('#days_count').val());

            switch ($(this).attr('id')) {
                case 'rate_daily':
                    table_rate_amount = parseInt($('#txt_daily_rate').val());
                    table_less_booking_amount = parseInt($('#txt_daily_less_booking_percentage').val());
                    table_sub_total = parseInt($('#txt_daily_total').val());
                    break;

                case 'rate_weekly':
                    table_rate_amount = parseInt($('#txt_weekly_rate').val());
                    table_less_booking_amount = parseInt($('#txt_weekly_less_booking_percentage').val());
                    table_sub_total = parseInt($('#txt_weekly_total').val());
                    break;

                case 'rate_monthly':
                    table_rate_amount = parseInt($('#txt_four_weekly_rate').val());
                    table_less_booking_amount = parseInt($('#txt_four_weekly_less_booking_percentage').val());
                    table_sub_total = parseInt($('#txt_four_weekly_total').val());
                    break;

                default:
                    break;
            }

            let table_total = table_sub_total * table_daysCount;

            $('#table_rate_type').text(table_rate_type);
            $('#table_rate_amount').text('$ ' + table_rate_amount.toFixed(2));
            $('#table_less_booking_amount').text('$ ' + table_less_booking_amount.toFixed(2));
            $('#table_sub_total').text('$ ' + table_sub_total.toFixed(2));
            $('#table_days_count').text(table_daysCount + ' Day(s)');
            $('#table_total').text('$ ' + table_total.toFixed(2));


            let taxPercentage = parseFloat('{{ $booking_tax->amount }}');
            let taxIsFlat = '{{ $booking_tax->is_flat }}' === 'true';

            let taxAmount = 0;
            if (taxIsFlat) {
                taxAmount = taxPercentage;
            } else {
                taxAmount = (table_total * taxPercentage) / 100;
            }
            $('#table_tax_amount').text('$ ' + taxAmount.toFixed(2));

            let table_gross_total = table_total + taxAmount;
            $('#table_gross_total').text('$ ' + table_gross_total.toFixed(2));

            let advancePayment = parseFloat('{{ $advanced_payment }}');
            let totalReceivables = table_gross_total - advancePayment;

            $('#table_text_total_receivables').html((totalReceivables.toFixed(2) < 0 ? 'Total Payable' :
                'Total Receivable'));
            $('#table_total_receivables').text('$ ' + (totalReceivables.toFixed(2) < 0 ? '(' + Math.abs(
                totalReceivables).toFixed(2) + ')' : totalReceivables.toFixed(2)));
        }

    });

    function formReset() {
        $('#form_booking_store')[0].reset();
    }

    // $('#form_booking_store').validate({
    //     rules: {
    //         txt_daily_rate: {
    //             required: true
    //         },

    //     },
    //     validClass: "is-valid",
    //     errorClass: 'is-invalid',
    //     errorElement: "span",
    //     // wrapper: "div",
    //     // do other things for a valid form
    //     submitHandler: function(form) {
    //         // Swal.fire('asdasdasdasd');
    //         form.submit();
    //     }
    // });

    function formSubmit() {
        $('#submitForm').trigger('click');
    }
</script>
