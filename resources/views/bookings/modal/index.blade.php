<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Create Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="basicModal-close"></button>
            </div>
            <div class="modal-body mb-0">
                <form action="{{ route('bookings.store') }}" method="POST" id="booking_store">
                    @csrf
                    <input type="hidden" name="cabin_id" value="{{ $cabin->id }}">

                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <label class="form-label" style="font-size: 15px" for="booking_from">Booking
                                Date(From)</label>
                            <input type="hidden" name="booking_from" value="{{ $date_from }}">
                            <input type="text" class="form-control" id="booking_from"
                                value="{{ \Carbon\Carbon::parse($date_from)->format('F j, Y') }}"
                                placeholder="Booking Date(From)" readonly />
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <label class="form-label" style="font-size: 15px" for="booking_to">Booking Date(To)</label>
                            <input type="hidden" name="booking_to" name="booking_to" value="{{ $date_to }}">
                            <input type="text" class="form-control" id="booking_to"
                                value="{{ \Carbon\Carbon::parse($date_to)->format('F j, Y') }}"
                                placeholder="Booking Date(To)" readonly />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                            <label class="form-label" style="font-size: 15px" for="customer">Customer</label>
                            <select class="select2-size-lg form-select" id="customer" name="customer">
                                @foreach ($customers as $customerRow)
                                    @continue(isset($customer) && $customerRow->id == $customer->id)
                                    <option data-icon="fa-solid fa-angle-right"
                                        value="{{ $customerRow['id'] }}"{{ (isset($customer) ? $customer->customer_id : old('customer')) == $customerRow['id'] ? 'selected' : '' }}>
                                        {{ $customerRow['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="d-flex align-items-end justify-content-center w-100 h-100">
                                <a href="{{ route('customers.create') }}" class="btn w-100 btn-primary me-1">
                                    <span><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add New</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="px-5">
                        <hr>
                    </div>

                    <div class="row my-3">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Type</p>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Rate ($)</p>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Less Booking (%)</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="m-0">Daily Rate</p>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <input type="number" class="form-control" id="daily_rate" name="daily_rate" step="0.5"
                                placeholder="Daily Rate" value="0" min="0" />
                            <p class="m-0">
                                <small class="text-muted">Enter daily rate.</small>
                            </p>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <input type="number" class="form-control" id="daily_less_booking_percentage"
                                name="daily_less_booking_percentage" placeholder="Daily Rate" value="0"
                                step="0.5" min="0" />
                            <p class="m-0">
                                <small class="text-muted">Enter daily rate.</small>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="m-0">Wekkly Rate</p>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <input type="number" class="form-control" id="weekly_rate" name="weekly_rate"
                                placeholder="Weekly Rate" value="0" min="0"
                                {{ $differenceInDays + 1 < 7 ? 'disabled' : '' }} />
                            <p class="m-0">
                                <small class="text-muted">Enter weekly rate.</small>
                            </p>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <input type="number" class="form-control" id="weekly_rate_less_booking_percentage"
                                name="weekly_rate_less_booking_percentage" placeholder="Daily Rate" value="0"
                                min="0" {{ $differenceInDays + 1 < 7 ? 'disabled' : '' }} />
                            <p class="m-0">
                                <small class="text-muted">Enter daily rate.</small>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="m-0">Monthly Rate</p>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <input type="number" class="form-control" id="monthly_rate" name="monthly_rate"
                                placeholder="Monthly Rate" value="0" min="0"
                                {{ $differenceInDays + 1 < 28 ? 'disabled' : '' }} />
                            <p class="m-0">
                                <small class="text-muted">Enter monthly rate.</small>
                            </p>
                        </div>


                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <input type="number" class="form-control" id="monthly_less_booking_percentage"
                                name="monthly_less_booking_percentage" placeholder="Daily Rate" value="0"
                                min="0" {{ $differenceInDays + 1 < 28 ? 'disabled' : '' }} />
                            <p class="m-0">
                                <small class="text-muted">Enter monthly rate.</small>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">

                        {{-- <div class="col-xl-4 col-lg-4 col-md-4 text-center">
                            <label class="form-label d-block" style="font-size: 15px"
                                for="check_in">Electricity</label>

                            <div class="d-flex align-items-center justify-content-around h-75">
                                <div class="form-check form-check-primary">
                                    <input type="radio" name="electricity_included" id="electricity_included"
                                        class="form-check-input" value="included" checked />
                                    <label class="form-check-label" for="electricity_included">Included</label>
                                </div>

                                <div class="form-check form-check-primary">
                                    <input type="radio" name="electricity_included" id="electricity_not_included"
                                        class="form-check-input" value="not_included" />
                                    <label class="form-check-label" for="electricity_not_included">Not
                                        Included</label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="booking_tax">Tax </label>
                            <input type="number" class="form-control" id="booking_tax" name="booking_tax"
                                placeholder="Tax" value="10" min="0" />
                            <p class="m-0">
                                <small class="text-muted">Enter tax.</small>
                            </p>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-4 col-lg-4 col-md-4 text-center">
                            <label class="form-label d-block" style="font-size: 15px" for="check_in">Check In</label>

                            <div class="d-flex align-items-center justify-content-around h-75">
                                <div class="form-check form-check-primary">
                                    <input type="radio" name="check_in" id="btn_check_in_now"
                                        class="form-check-input" value="now" />
                                    <label class="form-check-label" for="btn_check_in_now">Now</label>
                                </div>

                                <div class="form-check form-check-primary">
                                    <input type="radio" name="check_in" id="btn_check_in_later"
                                        class="form-check-input" value="later" checked />
                                    <label class="form-check-label" for="btn_check_in_later">Later</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 text-center">

                            <label class="form-label d-block" style="font-size: 15px" for="payment">Take
                                Payment</label>

                            <div class="d-flex align-items-center justify-content-around h-75">
                                <div class="form-check form-check-primary">
                                    <input type="radio" name="payment" id="btn_payment_now"
                                        class="form-check-input" value="now" />
                                    <label class="form-check-label" for="btn_payment_now">Now</label>
                                </div>

                                <div class="form-check form-check-primary">
                                    <input type="radio" name="payment" id="btn_payment_later"
                                        class="form-check-input" value="later" checked />
                                    <label class="form-check-label" for="btn_payment_later">Later</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="advance_payment">Advance
                                Payment</label>
                            <input type="number" class="form-control" id="advance_payment" name="advance_payment"
                                placeholder="Advance Payment" value="0" oninput="validaitonNumber(this);" />
                            <p class="m-0">
                                <small class="text-muted">Enter advance payment.</small>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="booking_source">Booking
                                Source</label>
                            <select class="select2-size-lg form-select" id="booking_source" name="booking_source">
                                @foreach ($booking_sources as $booking_source)
                                    <option data-icon="fa-solid fa-angle-right" value="{{ $booking_source->id }}">
                                        {{ $booking_source->name }}</option>
                                @endforeach
                            </select>
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
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger me-1">
                    <span>Reset</span>
                </button>
                <button type="button" class="btn btn-primary" onclick="formSubmit();">
                    <span>Save</span>
                </button>

            </div>
        </div>
    </div>
</div>

<script>
    customer = $("#customer");
    customer.wrap('<div class="position-relative"></div>');
    customer.select2({
        dropdownAutoWidth: !0,
        dropdownParent: customer.parent(),
        width: "100%",
        containerCssClass: "select-lg",
        templateResult: c,
        templateSelection: c,
        escapeMarkup: function(customer) {
            return customer
        }
    });

    booking_source = $("#booking_source");
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

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }

    function formReset() {
        $('#booking_store')[0].reset();
    }

    function formSubmit() {
        // $('#submitForm').trigger('click');
        $('#booking_store').submit();
    }

    $(document).ready(function() {
        $("#btn_payment_now").change(function() {
            if ($(this).prop("checked")) {
                $('#advance_payment').attr('readonly', false);
            }
        });

        $("#btn_payment_later").change(function() {
            if ($(this).prop("checked")) {
                $('#advance_payment').val(0);
                $('#advance_payment').attr('readonly', true);
            }
        });

        $('#basicModal-close').on('click', function() {
            console.log('close button clicked', "{{ route('bookings.create') }}");
            let pageState = {
                cabin_id: '',
                booking_from: '',
                booking_to: '',
                prevModal: 'modalPlace',
            };

            history.replaceState(pageState, '', "{{ route('bookings.create') }}");
        });

        // $('#booking_store').validate({
        //     rules: {
        //         customers: {
        //             required: true
        //         },
        //         daily_rate: {
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
    });
</script>
<script>
    // document.addEventListener('DOMContentLoaded', function (e) {
    //     FormValidation.formValidation(document.getElementById('demoForm'), {
    //         fields: {
    //             'languages[]': {
    //                 validators: {
    //                     choice: {
    //                         min: 2,
    //                         max: 4,
    //                         message: 'Please choose 2 - 4 programming languages you are good at',
    //                     },
    //                 },
    //             },
    //             'editors[]': {
    //                 validators: {
    //                     choice: {
    //                         min: 2,
    //                         max: 3,
    //                         message: 'Please choose 2 - 3 editors you use most',
    //                     },
    //                 },
    //             },
    //         },
    //         plugins: {
    //             trigger: new FormValidation.plugins.Trigger(),
    //             bootstrap: new FormValidation.plugins.Bootstrap(),
    //             submitButton: new FormValidation.plugins.SubmitButton(),
    //             icon: new FormValidation.plugins.Icon({
    //                 valid: 'fa fa-check',
    //                 invalid: 'fa fa-times',
    //                 validating: 'fa fa-refresh',
    //             }),
    //         },
    //     });
    // });
</script>
