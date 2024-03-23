<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="basicModalLabel1">Add Payments - {{ $booking->cabin->name }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="basicModal-close"></button>
            </div>

            <div class="modal-body mb-0">
                <form action="{{ route('bookings.payments.store', ['booking' => $booking->id]) }}" method="POST"
                    id="form_payments_store">
                    @csrf
                    <input type="hidden" name="payment_type" value="electricity_payment" />

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
                                value="{{ date('F j, Y', $booking->created_at) }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="credit_account">Credit
                                Account</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" id="credit_account" class="form-control"
                                    placeholder="Credit Account" readonly
                                    value="{{ $credit_account >= 0 ? number_format($credit_account) : '-' . number_format(abs($credit_account)) }}" />
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="amount">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="amount" autofocus class="form-control" placeholder="Amount"
                                    value="0" min="1" name="amount" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive-xl">
                                <table class="table table-hover table-hover-animation rounded overflow-hidden border">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="vertical-align: middle;" scope="col">Type</th>
                                            <th class="text-end" style="vertical-align: middle;" scope="col">
                                                Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-nowrap" style="vertical-align: middle;">
                                                <p class="m-0">
                                                    Amount {{ $electricity_account > 0 ? '' : '(Receivable)' }}
                                                </p>
                                            </th>
                                            <td class="text-nowrap text-end" style="vertical-align: middle;">
                                                <p class="m-0">
                                                    ${{ number_format(abs($electricity_account), 2) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="text-nowrap" style="vertical-align: middle;">
                                                <p class="m-0">
                                                    Amount (Received)
                                                </p>
                                            </th>
                                            <td class="text-nowrap text-end" style="vertical-align: middle;">
                                                <p class="m-0" id="table_amount_received">
                                                    {{ number_format(0) }}
                                                </p>
                                            </td>
                                        </tr>

                                        <tr id="tr_sub_total_amount" class="table-light">
                                            <th style="vertical-align: middle;" id="table_sub_total_text">Total</th>
                                            <td class="text-nowrap text-end" style="vertical-align: middle;">
                                                <p class="m-0" id="table_sub_total_value">
                                                    0
                                                </p>
                                            </td>
                                        </tr>

                                        <tr id="tr_credit_account" style="display: none;">
                                            <th style="vertical-align: middle;">Account Credit</th>
                                            <td class="text-nowrap text-end" style="vertical-align: middle;">
                                                <p class="m-0" id="table_account_credit">
                                                    ${{ number_format($credit_account, 2) }}</p>
                                            </td>
                                        </tr>

                                        <tr id="tr_total_amount" class="table-light" style="display: none;">
                                            <th style="vertical-align: middle;" id="table_remaining_credit_amount">
                                                Remaining Credit Account</th>
                                            <th class="text-nowrap text-end" style="vertical-align: middle;">
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


        $('#amount').on('change', function() {
            $('#table_amount_received').html(currencyFormatter.format(Math.abs(parseFloat($(this)
            .val()))));
            calculateUtilityValue();
        });

        payment_methods = $("#payment_methods");
        payment_methods.wrap('<div class="position-relative"></div>');
        payment_methods.select2({
            dropdownAutoWidth: !0,
            dropdownParent: payment_methods.parent(),
            width: "100%",
            containerCssClass: "select-lg",
            templateResult: c,
            templateSelection: c,
            escapeMarkup: function(payment_methods) {
                return payment_methods
            }
        }).on("change", function() {
            // $('#tr_credit_account, #tr_total_amount').hide();
            // $('#tr_sub_total_amount').addClass('table-light');
            // if ($("#payment_methods").find(':selected').data('linked-account') == 'credit_account') {
            //     $('#tr_credit_account, #tr_total_amount').show();
            //     $('#tr_sub_total_amount').removeClass('table-light');
            // }
        });
    });

    function calculateUtilityValue() {
        let amount_previous = parseFloat('{{ $electricity_account }}');
        let amount_next = parseFloat($('#amount').val());

        let totalReceivables = amount_next + amount_previous;
        $('#table_sub_total_value').html(currencyFormatter.format(Math.abs(totalReceivables)));

        // if ($("#payment_methods").find(':selected').data('linked-account') == 'credit_account') {
        //     totalReceivables = creditAmount - totalReceivables;
        //     $('#remaining_credit_amount').val(totalReceivables);
        //     $('#txt_remaining_credit_amount').text('$ ' + (totalReceivables.toFixed(2) < 0 ? '(' + Math.abs(
        //         totalReceivables).toFixed(2) + ')' : totalReceivables.toFixed(2)));
        // }
    }

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }

    function formReset() {
        $('#form_payments_store')[0].reset();
    }

    function formSubmit() {
        if ($("#payment_methods").find(':selected').data('linked-account') == 'credit_account') {
            let creditAmount = parseFloat('{{ $credit_account }}');
            if (creditAmount - parseFloat($('#amount').val()) < 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect waves-float waves-light me-1',
                    },
                    text: 'Cannot pay from credit account due to insufficient balance!',
                });
                return;
            }
        }
        $('#submitForm').trigger('click');
    }

    calculateUtilityValue();
</script>
