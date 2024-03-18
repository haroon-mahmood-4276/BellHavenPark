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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            <label class="form-label" style="font-size: 15px" for="booking_id">Booking ID</label>
                            <input type="text" class="form-control" id="booking_id"
                                value="{{ $booking->booking_number }}" placeholder="Booking ID" readonly />
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <input type="hidden" name="customer_id" value="{{ $booking->customer->id }}">
                            <label class="form-label" style="font-size: 15px" for="customer_id">Customer</label>
                            <input type="text" id="customer_id" class="form-control" placeholder="Customer"
                                aria-label="Customer" readonly value="{{ $booking->customer->name }}" />
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="booking_date">Booking
                                Date</label>
                            <input type="text" id="booking_date" name="booking_date" class="form-control"
                                placeholder="Booking Date" aria-label="Booking Date" readonly
                                value="{{ date('F j, Y', $booking->created_at) }}" />
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
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

                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="amount">Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="amount" class="form-control" placeholder="Amount"
                                    value="0" min="0" name="amount" />
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
        $('input[id^="rate_"]:checked').trigger('change');

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
        });
    });

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }

    function formReset() {
        $('#form_payments_store')[0].reset();
    }

    function formSubmit() {
        $('#submitForm').trigger('click');
    }
</script> 
