<div class="modal fade text-start" id="default" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Add Payments - {{ $cabin->name }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="payment_store">

                    @csrf

                    <div class="row mb-1">

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">

                            <input type="hidden" name="payment[booking_id]" value="{{ $booking->id }}">

                            <label class="form-label" style="font-size: 15px" for="booking_id">Booking ID</label>
                            <input type="text" id="booking_id" class="form-control form-control-lg"
                                placeholder="Booking ID" aria-label="Booking ID" disabled value="{{ $booking->id }}" />
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

                            <input type="hidden" name="payment[customer_id]" value="{{ $customer->id }}">

                            <label class="form-label" style="font-size: 15px" for="customer">Customer</label>
                            <input type="text" id="customer" class="form-control form-control-lg"
                                placeholder="Customer" aria-label="Customer" disabled
                                value="{{ $customer->full_name }}" />
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="booking_date">Booking
                                Date</label>
                            <input type="text" id="booking_date" name="payment[booking_date]"
                                class="form-control form-control-lg" placeholder="Booking Date"
                                aria-label="Booking Date" readonly
                                value="{{ date('d/m/Y', strtotime($booking->created_at)) }}" />
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="payment_from">Payment From <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="payment_from" class="form-control form-control-lg"
                                placeholder="Payment From" aria-label="Payment From" value=""
                                name="payment[payment_from]" />
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="payment_to">Payment To <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="payment_to" class="form-control form-control-lg"
                                placeholder="Payment To" aria-label="Payment To" value=""
                                name="payment[payment_to]" />
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="days_count">Days Count</label>
                            <input type="number" id="days_count" class="form-control form-control-lg"
                                placeholder="Days Count" value="1" readonly name="payment[days_count]" />
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="advance_booking_payment">Advance
                                Payment</label>
                            <input type="text" id="advance_booking_payment" name="payment[advance_payment]"
                                class="form-control form-control-lg" placeholder="Advance Payment"
                                aria-label="Advance Payment " readonly value="{{ $advanced_payment }}.00" />
                        </div>
                    </div>

                    <div class="row my-1">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Type</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Rate</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Less Booking</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Total</p>
                        </div>
                    </div>

                    <div class="row mb-1 g-1">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rate_type" id="rate_daily"
                                        value="daily_rate" checked />
                                    <label class="form-check-label" style="font-size: 15px; font-weight: bold;"
                                        for="rate_daily">Daily Rate</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control form-control-lg" id="txt_daily_rate"
                                    name="txt_daily_rate" placeholder="Daily Rate"
                                    value="{{ $booking->daily_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group input-group-lg">

                                @php
                                    $percentage = $booking->daily_less_booking_percentage ?? 0;

                                    $daily_less_booking = ($booking->daily_rate * $percentage) / 100;
                                @endphp

                                <span
                                    class="input-group-text">{{ Str::of($booking->daily_less_booking_percentage ?? 0)->padLeft(2, '0') }}
                                    %</span>
                                <input type="text" id="txt_daily_less_booking_percentage"
                                    class="form-control form-control-lg" placeholder="Less Booking"
                                    value="{{ $daily_less_booking }}" readonly />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control form-control-lg" id="txt_daily_total"
                                    name="txt_daily_total" placeholder="Daily Rate"
                                    value="{{ $booking->daily_rate + $daily_less_booking ?? 0 }}" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1 g-1">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rate_type" id="rate_weekly"
                                        value="weekly_rate" />
                                    <label class="form-check-label" style="font-size: 15px; font-weight: bold;"
                                        for="rate_weekly">Weekly Rate</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control form-control-lg" id="txt_weekly_rate"
                                    name="txt_weekly_rate" placeholder="Weekly Rate"
                                    value="{{ $booking->weekly_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group input-group-lg">

                                @php
                                    $percentage = $booking->weekly_rate_less_booking_percentage ?? 0;

                                    $weekly_less_booking = ($booking->weekly_rate * $percentage) / 100;
                                @endphp

                                <span
                                    class="input-group-text">{{ Str::of($booking->weekly_rate_less_booking_percentage ?? 0)->padLeft(2, '0') }}
                                    %</span>
                                <input type="text" id="txt_weekly_less_booking_percentage"
                                    class="form-control form-control-lg" placeholder="Less Booking"
                                    value="{{ $weekly_less_booking }}" readonly />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control form-control-lg" id="txt_weekly_total"
                                    name="txt_weekly_total" placeholder="Weekly Rate"
                                    value="{{ $booking->weekly_rate + $weekly_less_booking ?? 0 }}" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1 g-1">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="rate_type"
                                        id="rate_four_weekly" value="four_weekly_rate" />
                                    <label class="form-check-label" style="font-size: 15px; font-weight: bold;"
                                        for="rate_four_weekly">Four Weekly Rate</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control form-control-lg" id="txt_four_weekly_rate"
                                    name="txt_four_weekly_rate" placeholder="four_Weekly Rate"
                                    value="{{ $booking->four_weekly_rate ?? 0 }}" disabled />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group input-group-lg">

                                @php
                                    $percentage = $booking->four_weekly_less_booking_percentage ?? 0;

                                    $four_weekly_less_booking = ($booking->four_weekly_rate * $percentage) / 100;
                                @endphp

                                <span
                                    class="input-group-text">{{ Str::of($booking->four_weekly_less_booking_percentage ?? 0)->padLeft(2, '0') }}
                                    %</span>
                                <input type="text" id="txt_four_weekly_less_booking_percentage"
                                    class="form-control form-control-lg" placeholder="Less Booking"
                                    value="{{ $four_weekly_less_booking }}" readonly />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control form-control-lg" id="txt_four_weekly_total"
                                    name="txt_four_weekly_total" placeholder="four_Weekly Rate"
                                    value="{{ $booking->four_weekly_rate + $four_weekly_less_booking ?? 0 }}"
                                    readonly />
                            </div>
                        </div>
                    </div>

                    <div class="px-5">
                        <hr>
                    </div>

                    <div class="row mb-1">
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
                                            <th style="vertical-align: middle;" colspan="5">Tax (
                                                {{ $booking->tax_percentage }} % )</th>
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
                                            <th style="vertical-align: middle;" colspan="5">Total Payable</th>
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

                    <div class="row mb-1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="payment_methods">Payment
                                Methods</label>
                            <select class="select2InModal select2-size-lg form-select" id="payment_methods"
                                name="payment_methods">
                                @foreach ($payment_methods as $payment_method)
                                    <option value="{{ $payment_method->id }}">
                                        {{ $loop->index + 1 }}) {{ $payment_method->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="comments">Comments</label>
                            <textarea id="comments" name="comments" class="form-control form-control-lg" placeholder="Comments"
                                aria-label="comments" rows="5"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="d-none" id="submitForm">
                    </button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="reset" class="btn btn-relief-outline-danger me-1">
                    <span>Reset</span>
                </button>
                <button type="button" class="btn btn-relief-outline-primary" onclick="formSubmit();">
                    <span>Save</span>
                </button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('public_assets/admin') }}/vendors/js/forms/validation/jquery.validate.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/forms/validation/additional-methods.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/extensions/moment.min.js"></script>
<script>
    $(document).ready(function() {
        $('input[id^="rate_"]:checked').trigger('change');
    });

    $(".select2-size-lg").each(function() {
        var e = $(this);
        e.wrap('<div class="position-relative"></div>');
        e.select2({
            // dropdownAutoWidth: !0,
            // dropdownParent: e.parent(),
            dropdownParent: '#default',
            // width: "100%",
            containerCssClass: "select-lg"
        });
    });

    $('#payment_from').flatpickr({
        mode: "range",
        weekNumbers: true,
        minDate: '{{ $booking->booking_from }}',
        maxDate: '{{ $booking->booking_to }}',
        onChange: function(selectedDates, dateStr, instance) {

            let date1 = moment(selectedDates[0]);
            let date2 = moment(selectedDates[1]);

            let diffInDays = date2.diff(date1, 'days');

            $('#days_count').val(diffInDays + 1);

            $('input[id^="rate_"]:checked').trigger('change');
        },
        defaultDate: ['{{ now() }}', '{{ now() }}'],
        "plugins": [new rangePlugin({
            input: "#payment_to"
        })]
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

                case 'rate_four_weekly':
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


            let taxPercentage = parseInt('{{ $booking->tax_percentage }}');
            let taxAmount = (table_total * taxPercentage) / 100;
            $('#table_tax_amount').text('$ ' + taxAmount.toFixed(2));

            let table_gross_total = table_total + taxAmount;
            $('#table_gross_total').text('$ ' + table_gross_total.toFixed(2));

            let advancePayment = parseFloat('{{ $advanced_payment }}');
            let totalReceivables = table_gross_total - advancePayment;
            $('#table_total_receivables').text('$ ' + totalReceivables.toFixed(2));
        }

    });

    function formReset() {
        $('#booking_store')[0].reset();
    }

    $('#booking_store').validate({
        rules: {
            txt_daily_rate: {
                required: true
            },

        },
        validClass: "is-valid",
        errorClass: 'is-invalid',
        errorElement: "span",
        // wrapper: "div",
        // do other things for a valid form
        submitHandler: function(form) {
            // Swal.fire('asdasdasdasd');
            form.submit();
        }
    });

    function formSubmit() {
        $('#submitForm').trigger('click');
    }
</script>
