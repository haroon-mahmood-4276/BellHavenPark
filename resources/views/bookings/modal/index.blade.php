<div class="modal fade text-start" id="default" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">Add Booking - {{ $cabin->name }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('bookings.store') }}" method="POST" id="booking_store">
                    @csrf
                    <input type="hidden" name="cabin_id" value="{{ $cabin->id }}">
                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <input type="hidden" name="booking_date_from" value="{{ $date_from }}">
                            <label class="form-label" style="font-size: 15px" for="booking_date_from">Booking Date
                                From <span class="text-danger">*</span></label>
                            <input type="text" id="booking_date_from"
                                class="form-control form-control-lg @error('booking_date_from') is-invalid @enderror"
                                placeholder="Booking Date From" aria-label="Booking Date From" disabled
                                value="{{ $date_from }}" />
                            @error('booking_date_from')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <input type="hidden" name="booking_date_to" value="{{ $date_to }}">
                            <label class="form-label" style="font-size: 15px" for="booking_date_to">Booking Date To
                                <span class="text-danger">*</span></label>
                            <input type="text" id="booking_date_to"
                                class="form-control form-control-lg @error('booking_datetom') is-invalid @enderror"
                                placeholder="Booking Date To" aria-label="Booking Date To" disabled
                                value="{{ $date_to }}" />
                            @error('booking_date_to')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-xl-19col-lg-9 col-md-9 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="customers">Customers <span
                                    class="text-danger">*</span></label>
                            <select class="select2-size-lg form-select @error('customers') is-invalid @enderror"
                                id="customers" name="customers">
                                <option value="" selected>Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $loop->index + 1 }}) {{ $customer->full_name }}
                                        [{{ $customer->phone }}]</option>
                                @endforeach
                            </select>
                            @error('customers')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 ">
                            <div class="d-flex align-items-end justify-content-center w-100 h-100">
                                <a href="{{ route('customers.create') }}"
                                    class="btn w-100 btn-relief-outline-primary me-1">
                                    <span>Add New Customer</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="px-5">
                        <hr>
                    </div>

                    <div class="row my-1 text-center">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Type</p>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Rate</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Less Booking</p>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="m-0">Daily Rate</p>
                            </div>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control form-control-lg" id="txt_daily_rate"
                                    name="txt_daily_rate" placeholder="Daily Rate" value="0" min="0" />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">%</span>
                                <input type="number" name="txt_daily_less_booking_percentage"
                                    id="txt_daily_less_booking_percentage" class="form-control form-control-lg"
                                    placeholder="Less Booking" value="0" min="0" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="m-0">Weekly Rate</p>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control form-control-lg" id="txt_weekly_rate"
                                    name="txt_weekly_rate" {{ $differenceInDays + 1 < 7 ? 'disabled' : '' }}
                                    placeholder="Weekly Rate" value="0" min="0" />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group input-group-lg">
                                <span
                                    class="input-group-text {{ $differenceInDays + 1 < 7 ? 'text-muted' : '' }}">%</span>
                                <input type="number" id="txt_weekly_rate_less_booking_percentage"
                                    name="txt_weekly_rate_less_booking_percentage"
                                    class="form-control form-control-lg" placeholder="Less Booking" value="0"
                                    {{ $differenceInDays + 1 < 7 ? 'disabled' : '' }} />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="m-0">Four Weekly Rate</p>
                            </div>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control form-control-lg" id="txt_four_weekly_rate"
                                    name="txt_four_weekly_rate" {{ $differenceInDays + 1 < 28 ? 'disabled' : '' }}
                                    placeholder="Four Weekly Rate" value="0" min="0" />
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3">
                            <div class="input-group input-group-lg">
                                <span
                                    class="input-group-text {{ $differenceInDays + 1 < 28 ? 'text-muted' : '' }}">%</span>
                                <input type="number" id="txt_four_weekly_less_booking_percentage"
                                    name="txt_four_weekly_less_booking_percentage"
                                    class="form-control form-control-lg" placeholder="Less Booking" value="0"
                                    min="0" {{ $differenceInDays + 1 < 7 ? 'disabled' : '' }} />
                            </div>
                        </div>
                    </div>

                    <div class="px-5">
                        <hr>
                    </div>

                    <div class="row mb-1">

                        <div class="col-xl-4 col-lg-4 col-md-4 text-center">
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
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="booking_tax">Tax </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">%</span>
                                <input type="number" id="booking_tax" name="booking_tax"
                                    class="form-control form-control-lg" placeholder="Tax" value="10"
                                    min="0" />
                            </div>

                        </div>

                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-4 col-lg-4 col-md-4 text-center">
                            <label class="form-label d-block" style="font-size: 15px" for="check_in">Check In</label>

                            <div class="d-flex align-items-center justify-content-around h-75">
                                <div class="form-check form-check-primary">
                                    <input type="radio" name="btn_check_in" id="btn_check_in_now"
                                        class="form-check-input" value="now" />
                                    <label class="form-check-label" for="btn_check_in_now">Now</label>
                                </div>

                                <div class="form-check form-check-primary">
                                    <input type="radio" name="btn_check_in" id="btn_check_in_later"
                                        class="form-check-input" value="later" checked />
                                    <label class="form-check-label" for="btn_check_in_later">Later</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 text-center">

                            <label class="form-label d-block" style="font-size: 15px" for="check_in">Take
                                Payment</label>

                            <div class="d-flex align-items-center justify-content-around h-75">
                                <div class="form-check form-check-primary">
                                    <input type="radio" name="btn_payment" id="btn_payment_now"
                                        class="form-check-input" value="now" />
                                    <label class="form-check-label" for="btn_payment_now">Now</label>
                                </div>

                                <div class="form-check form-check-primary">
                                    <input type="radio" name="btn_payment" id="btn_payment_later"
                                        class="form-check-input" value="later" checked />
                                    <label class="form-check-label" for="btn_payment_later">Later</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="advance_payment">Advance
                                Payment</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">$</span>
                                <input type="text" readonly
                                    class="form-control form-control-lg @error('advance_payment') is-invalid @enderror"
                                    id="advance_payment" name="advance_payment" placeholder="Advance Payment"
                                    value="0" oninput="validaitonNumber(this);" />
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="booking_source">Booking Source
                            </label>
                            <select
                                class="select2InModal select2-size-lg form-select @error('booking_source') is-invalid @enderror"
                                id="booking_source" name="booking_source">
                                @foreach ($booking_sources as $booking_source)
                                    <option value="{{ $booking_source->id }}">
                                        {{ $loop->index + 1 }}) {{ $booking_source->name }}</option>
                                @endforeach
                            </select>
                            @error('booking_source')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="comments">Comments</label>
                            <textarea id="comments" name="comments" class="form-control form-control-lg @error('comments') is-invalid @enderror"
                                placeholder="Comments" aria-label="comments" rows="5"></textarea>
                            @error('comments')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
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
<script src="{{ asset('public_assets/admin') }}/vendors/js/forms/validation/additional-methods.validate.min.js">
</script>
<script>
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

    function formReset() {
        $('#booking_store')[0].reset();
    }

    $('#booking_store').validate({
        rules: {
            customers: {
                required: true
            },
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
        // Swal.fire('asdasdasdasd');
        // $('#booking_store').submit();
    }

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
</script>
