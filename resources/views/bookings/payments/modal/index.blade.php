<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="basicModalLabel1">Add Payments - {{ $booking->cabin->name }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="basicModal-close"></button>
            </div>

            <div class="modal-body mb-0">
                <form action="{{ route('bookings.payments.store', ['booking' => $booking->id]) }}" method="POST"
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
                            <input type="hidden" name="customer_id" value="{{ $booking->customer->id }}">
                            <label class="form-label" style="font-size: 15px" for="customer_id">Customer</label>
                            <input type="text" id="customer_id" class="form-control" placeholder="Customer"
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

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                            <label class="form-label" style="font-size: 15px" for="payment_from">Payment From
                                <span class="text-danger">*</span></label>
                            <input type="text" id="payment_from" class="payment_dates form-control"
                                placeholder="Payment From" readonly aria-label="Payment From"
                                value="{{ Carbon\Carbon::parse($last_payment_date)->format('F j, Y') }}"
                                name="payment_from" />
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                            <label class="form-label" style="font-size: 15px" for="payment_to">Payment To
                                <span class="text-danger">*</span></label>
                            <input type="text" id="payment_to" class="payment_dates form-control"
                                placeholder="Payment To" aria-label="Payment To"
                                value="{{ Carbon\Carbon::parse($last_payment_date)->addDay()->format('F j, Y') }}"
                                name="payment_to" />
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                            <label class="form-label" style="font-size: 15px" for="text_days_count">Days
                                Count</label>
                            <input type="number" id="text_days_count" name="text_days_count" class="form-control"
                                placeholder="Days Count" value="1" min="1"
                                max="{{ $booking->booking_to->diffInDays($booking->booking_from) }}" />
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="credit_account">Credit
                                Account</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" id="credit_account" class="form-control"
                                    placeholder="Credit Account" readonly value="{{ $credit_account }}"
                                    name="credit_account" />
                            </div>
                        </div>

                    </div>

                    <div class="px-5">
                        <hr>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">
                            <label class="form-label" style="font-size: 15px" for="payment_methods">Payment
                                Methods</label>
                            <select class="select2InModal select2-size-lg form-select" id="payment_methods"
                                name="payment_methods">
                                @foreach ($payment_methods as $payment_method)
                                    <option data-icon="fa-solid fa-angle-right"
                                        data-linked-account='{{ $payment_method->linked_account }}'
                                        value="{{ $payment_method->id }}">
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

                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive-xl">
                                <table class="table table-hover table-hover-animation rounded overflow-hidden border">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="vertical-align: middle; width: 20%;" scope="col">Type</th>
                                            <th style="vertical-align: middle;" scope="col">Rate</th>
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
                                            <input type="hidden" name="tax_flat"
                                                value="{{ $booking_tax->is_flat ? 'true' : 'false' }}">
                                            <th style="vertical-align: middle;" colspan="4">Tax (
                                                {{ $booking_tax->amount }}% )</th>
                                            <td style="vertical-align: middle;">
                                                <p class="m-0" id="table_tax_amount">
                                                    0
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th style="vertical-align: middle;" id="table_sub_total_text"
                                                colspan="4">Total</th>
                                            <td style="vertical-align: middle;">
                                                <p class="m-0" id="table_sub_total_value">
                                                    0
                                                </p>
                                            </td>
                                        </tr>

                                        <tr id="tr_credit_account" style="display: none;">
                                            <th style="vertical-align: middle;" colspan="4">Account Credit</th>
                                            <td style="vertical-align: middle;">
                                                <p class="m-0" id="table_account_credit">$
                                                    {{ number_format($credit_account, 2, '.', '') }}</p>
                                            </td>
                                        </tr>

                                        <tr id="tr_total_amount" class="table-light" style="display: none;">
                                            <th style="vertical-align: middle;" colspan="4"
                                                id="table_remaining_credit_amount">Remaining Credit Account</th>
                                            <th style="vertical-align: middle;">
                                                <input type="hidden" id="remaining_credit_amount"
                                                    name="remaining_credit_amount" value="0">
                                                <p class="m-0" id="txt_remaining_credit_amount">
                                                    0
                                                </p>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="comments">Comments</label>
                            <textarea id="comments" name="comments" class="form-control" placeholder="Comments" aria-label="comments"
                                rows="5"></textarea>
                        </div>
                    </div>

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
        }).on("change", function() {
            $('#tr_credit_account, #tr_total_amount').hide();
            if ($("#payment_methods").find(':selected').data('linked-account') == 'credit_account') {
                $('#tr_credit_account, #tr_total_amount').show();
            }
            $('input[id^="rate_"]:checked').trigger('change');
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

            $('#text_days_count').val(diffInDays);

            $('input[id^="rate_"]:checked').trigger('change');
        },
    });

    $('#text_days_count').on('change', function() {

        let paymentDate = moment($('#payment_from').val()).add(parseInt($('#text_days_count').val()) + 1,
            'days');

        $('#payment_to').val(paymentDate.format('MMMM DD, YYYY'));

        document.querySelector('#payment_to').datedropper('set', {
            defaultDate: paymentDate.format('YYYY/MM/DD')
        });

        $('input[id^="rate_"]:checked').trigger('change');
    });

    function ucFirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    $('input[id^="rate_"]').on('change', function(e) {
        // console.log(e.target.id);
        if ($(this).is(':checked')) {

            let table_rate_type = ucFirst($(this).val()).replaceAll('_', ' ');
            let table_rate_amount = '';
            let table_sub_total = '';
            let table_daysCount = parseInt($('#text_days_count').val());

            switch ($(this).attr('id')) {
                case 'rate_daily':
                    table_rate_amount = parseFloat($('#txt_daily_rate').val());
                    table_sub_total = parseInt($('#txt_daily_total').val());
                    break;

                case 'rate_weekly':
                    table_rate_amount = parseFloat($('#txt_weekly_rate').val());
                    table_sub_total = parseInt($('#txt_weekly_total').val());
                    break;

                case 'rate_monthly':
                    table_rate_amount = parseFloat($('#txt_four_weekly_rate').val());
                    table_sub_total = parseInt($('#txt_four_weekly_total').val());
                    break;

                default:
                    break;
            }

            let table_total = table_sub_total * table_daysCount;

            $('#table_rate_type').text(table_rate_type);
            $('#table_rate_amount').text('$ ' + table_rate_amount.toFixed(2));
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

            let totalReceivables = table_total + taxAmount;
            $('#table_sub_total_value').text('$ ' + totalReceivables.toFixed(2));

            let creditAmount = parseFloat('{{ $credit_account }}');

            if ($("#payment_methods").find(':selected').data('linked-account') == 'credit_account') {
                totalReceivables = creditAmount - totalReceivables;
                $('#remaining_credit_amount').val(totalReceivables);
                $('#txt_remaining_credit_amount').text('$ ' + (totalReceivables.toFixed(2) < 0 ? '(' + Math.abs(
                    totalReceivables).toFixed(2) + ')' : totalReceivables.toFixed(2)));
            }
        }

    });

    function formReset() {
        $('#form_booking_store')[0].reset();
    }

    function formSubmit() {
        $('#submitForm').trigger('click');
    }
</script>
