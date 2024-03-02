<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        {{-- <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> --}}
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
                        <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">
                            <label class="form-label" style="font-size: 15px" for="customer">Customer</label>
                            <select class="select2-size-lg form-select" id="customer" name="customer"></select>
                        </div>

                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1">
                            <div class="d-flex align-items-end justify-content-center w-100 h-100">
                                <a href="{{ route('customers.create', ['return_url' => $return_url]) }}"
                                    class="btn w-100 btn-primary me-1">
                                    <span><i class="fa-solid fa-plus"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label" style="font-size: 15px" for="tenants">Tenants</label>
                            <select class="select2-size-lg form-select" multiple disabled id="tenants"
                                name="tenants[]"></select>
                        </div>
                    </div>

                    <div class="px-5">
                        <hr>
                    </div>

                    <div class="row my-3">
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Type</p>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-12">
                            <p class="form-label m-0" style="font-size: 15px; font-weight: bold;">Rate ($)</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="">Daily Rate</p>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-12">
                            <input type="number" class="form-control" id="daily_rate" name="daily_rate" step="0.5"
                                placeholder="Daily Rate" value="0" min="0" />
                            <p class="m-0">
                                <small class="text-muted">Enter daily rate.</small>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="m-0">Weekly Rate</p>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-12">
                            <input type="number" class="form-control" id="weekly_rate" name="weekly_rate"
                                placeholder="Weekly Rate" value="0" min="0"
                                {{ $differenceInDays + 1 < 7 ? 'disabled' : '' }} />
                            <p class="m-0">
                                <small class="text-muted">Enter weekly rate.</small>
                            </p>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xl-4 col-lg-4 col-md-12">
                            <div class="d-flex align-items-center h-100">
                                <p class="m-0">Monthly Rate</p>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-12">
                            <input type="number" class="form-control" id="four_weekly_rate" name="four_weekly_rate"
                                placeholder="Monthly Rate" value="0" min="0"
                                {{ $differenceInDays + 1 < 28 ? 'disabled' : '' }} />
                            <p class="m-0">
                                <small class="text-muted">Enter monthly rate.</small>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="booking_tax">Tax</label>
                            <select class="select2-size-lg form-select" id="booking_tax" name="booking_tax">
                                @foreach ($booking_taxes as $booking_tax)
                                    <option data-icon="fa-solid fa-angle-right" value="{{ $booking_tax->id }}"
                                        {{ $booking_tax->is_default ? 'selected' : null }}>{{ $booking_tax->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="m-0">
                                <small class="text-muted">Enter tax.</small>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-12 text-center">
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

                        <div class="col-xl-6 col-lg-6 col-md-12 text-center">
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
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 text-center">
                            <label class="form-label d-block" style="font-size: 15px">Utility Billing</label>

                            <div class="d-flex align-items-center justify-content-around h-75">
                                <div class="form-check form-check-primary">
                                    <input type="checkbox" id="check_bill_for_all" class="form-check-input" />
                                    <label class="form-check-label" for="check_bill_for_all">All</label>
                                </div>

                                <div class="form-check form-check-primary">
                                    <input type="hidden" name="bill_for_electricity"value="0" />
                                    <input type="checkbox" name="bill_for_electricity"
                                        id="check_bill_for_electricity" class="form-check-input" value="1" />
                                    <label class="form-check-label"
                                        for="check_bill_for_electricity">Electricity</label>
                                </div>

                                <div class="form-check form-check-primary">
                                    <input type="hidden" name="bill_for_gas"value="0" />
                                    <input type="checkbox" name="bill_for_gas" id="check_bill_for_gas"
                                        class="form-check-input" value="1" />
                                    <label class="form-check-label" for="check_bill_for_gas">Gas</label>
                                </div>

                                <div class="form-check form-check-primary">
                                    <input type="hidden" name="bill_for_water"value="0" />
                                    <input type="checkbox" name="bill_for_water" id="check_bill_for_water"
                                        class="form-check-input" value="1" />
                                    <label class="form-check-label" for="check_bill_for_water">Water</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-xl-6 col-lg-6 col-md-12 position-relative">
                            <label class="form-label" style="font-size: 15px" for="payment_methods">Payment
                                Method</label>
                            <select class="select2-size-lg form-select" id="payment_methods" disabled
                                name="payment_methods">
                                @foreach ($payment_methods as $payment_method)
                                    <option data-icon="fa-solid fa-angle-right" value="{{ $payment_method->id }}">
                                        {{ $payment_method->name }}</option>
                                @endforeach
                            </select>
                            <p class="m-0">
                                <small class="text-muted">Select payment method.</small>
                            </p>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 position-relative">
                            <label class="form-label" style="font-size: 15px" for="advance_payment">Advance
                                Payment</label>
                            <input type="hidden" name="advance_payment" value="0" />
                            <input type="number" class="form-control" id="advance_payment" name="advance_payment"
                                placeholder="Advance Payment" value="0" disabled
                                oninput="validaitonNumber(this);" />
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

                    <button type="submit" class="d-none" id="submitForm"></button>
                </form>

            </div>
            <div class="modal-footer pb-1">
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
    customer = $("#customer").wrap('<div class="position-relative"></div>');
    customer.select2({
        ajax: {
            url: "{{ route('ajax.customers.index') }}",
            dataType: 'json',
            delay: 500,
            data: function(params) {
                return {
                    q: params.term,
                    type: "query",
                    page: params.page,
                    per_page: 15,
                };
            },
            processResults: function(response, params) {
                return {
                    results: response.data.data,
                    pagination: {
                        more: response.data.next_page_url !== null
                    }
                };
            },
            cache: true
        },
        placeholder: 'Search for Customers...',
        dropdownAutoWidth: !0,
        minimumInputLength: 2,
        dropdownParent: customer.parent(),
        width: "100%",
        containerCssClass: "select-lg",
        templateResult: function(row) {

            if (row.loading) {
                return row.text;
            }

            var $container = $(
                "<div class='d-flex flex-column'>" +
                "<div class='d-flex flex-row align-content-center gap-2'>" +
                "<div class='fw-bold fs-5'>" + row.name + "</div>" +
                "<div class='fw-bold fs-5 dot-divider mx-0'></div>" +
                "<div class='fw-bold fs-5' id='read-only-ratings_" + row.id + "'>&#9733; " + row
                .average_rating + "</div>" +
                "</div>" +
                "<div>Email: " + (row.email || "N/A") + "</div>" +
                "<div>Phone: " + (row.phone || "N/A") + "</div>" +
                "<div>Address: " + (row.address || "N/A") + "</div>" +
                "</div>"
            );

            return $container;
        },
        templateSelection: function(row) {
            if (row.id == '') {
                return row.text;
            }
            var $container = $(
                "<div class='d-flex flex-column'>" +
                "<div class='d-flex flex-row align-content-center gap-2'>" +
                "<div class='fw-bold'>" + (row.name || "") + "</div>" +
                "<div class='dot-divider mx-0'>-</div>" +
                "<div class='fw-bold' id='read-only-ratings_" + row.id + "'>&#9733; " + (row
                    .average_rating || "0") + "</div>" +
                "</div>" +
                "</div>"
            );

            return $container;
        },
    }).on('select2:select', function(e) {
        var data = e.params.data;
        $("#tenants").attr('disabled', false);
    });

    tenants = $("#tenants").wrap('<div class="position-relative"></div>');
    tenants.select2({
        ajax: {
            url: "{{ route('ajax.customers.index') }}",
            dataType: 'json',
            delay: 500,
            data: function(params) {
                let data = {
                    q: params.term,
                    type: "query",
                };
                data.ignoredCustomerId = $('#customer').select2('data')[0]?.id;
                return data;
            },
            processResults: function(response, params) {
                return {
                    results: response.data.data,
                    pagination: {
                        more: response.data.next_page_url !== null
                    }
                };
            },
            cache: true
        },

        placeholder: 'Search for Customers...',
        dropdownAutoWidth: !0,
        minimumInputLength: 2,
        dropdownParent: tenants.parent(),
        width: "100%",
        containerCssClass: "select-lg",
        templateResult: function(row) {

            if (row.loading) {
                return row.text;
            }

            var $container = $(
                "<div class='d-flex flex-column'>" +
                "<div class='d-flex flex-row align-content-center gap-2'>" +
                "<div class='fw-bold fs-5'>" + row.name + "</div>" +
                "<div class='fw-bold fs-5 dot-divider mx-0'></div>" +
                "<div class='fw-bold fs-5' id='read-only-ratings_" + row.id + "'>&#9733; " + row
                .average_rating + "</div>" +
                "</div>" +
                "<div>Email: " + (row.email || "N/A") + "</div>" +
                "<div>Phone: " + (row.phone || "N/A") + "</div>" +
                "<div>Address: " + (row.address || "N/A") + "</div>" +
                "</div>"
            );

            return $container;
        },
        templateSelection: function(row) {
            if (row.id == '') {
                return row.text;
            }
            var $container = $(
                "<div class='d-flex flex-column'>" +
                "<div class='d-flex flex-row align-content-center gap-2'>" +
                "<div class='fw-bold'>" + (row.name || "") + "</div>" +
                "<div class='dot-divider mx-0'>-</div>" +
                "<div class='fw-bold' id='read-only-ratings_" + row.id + "'>&#9733; " + (row
                    .average_rating || "0") + "</div>" +
                "</div>" +
                "</div>"
            );

            return $container;
        },
    });

    booking_source = $("#booking_source").wrap('<div class="position-relative"></div>');
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

    payment_methods = $("#payment_methods").wrap('<div class="position-relative"></div>');
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

    booking_tax = $("#booking_tax").wrap('<div class="position-relative"></div>');
    booking_tax.select2({
        dropdownAutoWidth: !0,
        dropdownParent: booking_tax.parent(),
        width: "100%",
        containerCssClass: "select-lg",
        templateResult: c,
        templateSelection: c,
        escapeMarkup: function(booking_tax) {
            return booking_tax
        }
    });

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }

    function formReset() {
        $('#booking_store')[0].reset();
    }

    function formSubmit() {
        $('#booking_store').submit();
    }

    $(document).ready(function() {
        $("#btn_payment_now").change(function() {
            if ($(this).prop("checked")) {
                $('#advance_payment').attr('disabled', false);
                $('#payment_methods').attr('disabled', false);
            }
        });

        $("#btn_payment_later").change(function() {
            if ($(this).prop("checked")) {
                $('#advance_payment').val(0);
                $('#advance_payment').attr('disabled', true);
                $('#payment_methods').attr('disabled', true);
            }
        });

        $("#check_bill_for_all").change(function() {
            $('#check_bill_for_electricity').prop('checked', $(this).prop("checked"));
            $('#check_bill_for_gas').prop('checked', $(this).prop("checked"));
            $('#check_bill_for_water').prop('checked', $(this).prop("checked"));
        });

        $("#check_bill_for_electricity, #check_bill_for_gas, #check_bill_for_water").change(function() {
            $('#check_bill_for_all').prop('checked', false);
            if ($('#check_bill_for_electricity').prop('checked') && $('#check_bill_for_gas').prop(
                    'checked') && $('#check_bill_for_water').prop('checked')) {
                $('#check_bill_for_all').prop('checked', true);
            }
        });

        $('#basicModal-close').on('click', function() {

            var pageState = {
                booking_date_range: (
                    "{{ \Carbon\Carbon::parse($date_from)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($date_to)->format('F j, Y') }}"
                ).replaceAll(' ', '%20'),
                cabin_id: '',
                booking_from: '',
                booking_to: '',
                prevModal: 'modalPlace',
            };

            history.replaceState(pageState, '', "{{ route('bookings.create') }}?booking_date_range=" +
                pageState.booking_date_range);
        });
    });
</script>
