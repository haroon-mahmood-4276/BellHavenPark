<script src="{{ asset('assets') }}/vendor/libs/feligx/datedropper/datedropper.min.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
<script src="{{ asset('assets') }}/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
<script>
    $(document).ready(function() {

        new dateDropper({
            selector: '#closed_permanent_till',
            format: "MM dd, y",
            showArrowsOnHover: true,
            expandable: true,
            startFromMonday: true,
            defaultDate: "{{ isset($cabin) ? \Carbon\Carbon::parse($cabin->closed_to)->format('Y/m/d') : now()->format('Y/m/d') }}",
            minDate: "{{ isset($cabin) ? \Carbon\Carbon::parse($cabin->closed_to)->format('Y/m/d') : now()->format('Y/m/d') }}",
            onChange: function(res) {
                $('input[name="closed_permanent_till"]').val(moment(res.output.string).add(1,
                    'days').startOf('day').unix());
            }
        });

        new dateDropper({
            // overlay: true,
            // expandable: true,
            // expandedDefault: true,
            doubleView: true,
            expandedOnly: true,
            selector: '#closed_temporarily_till',
            format: 'MM dd, y',
            startFromMonday: true,
            minDate: '{{ now()->subDays(1)->toDateString() }}',
            defaultDate: '{{ now()->toDateString() }}',
            range: true,
            onRangeSet: function(range) {
                $('#closed_temporarily_till').val(range.a.string + ' - ' + range.b.string);
                $('input[name="closed_temporarily_till_from"]').val(moment(range.a.string).add(1,
                    'days').startOf('day').unix());
                $('input[name="closed_temporarily_till_to"]').val(moment(range.b.string).add(1,
                    'days').startOf('day').unix());
            },
        });

        cabin_type = $("#cabin_type");
        cabin_type.wrap('<div class="position-relative"></div>');
        cabin_type.select2({
            dropdownAutoWidth: !0,
            dropdownParent: cabin_type.parent(),
            width: "100%",
            containerCssClass: "select-lg",
            templateResult: c,
            templateSelection: c,
            escapeMarkup: function(cabin_type) {
                return cabin_type
            }
        });

        cabin_status = $("#cabin_status");
        cabin_status.wrap('<div class="position-relative"></div>');
        cabin_status.select2({
            dropdownAutoWidth: !0,
            dropdownParent: cabin_status.parent(),
            width: "100%",
            containerCssClass: "select-lg",
            templateResult: c,
            templateSelection: c,
            escapeMarkup: function(cabin_status) {
                return cabin_status
            }
        }).on('select2:select', function(e) {
            $('#div_closed_permanent_till, #div_closed_temporarily_till').addClass('d-none');
            switch (e.params.data.id) {
                case 'closed_permanently':
                    $('#div_closed_permanent_till').removeClass('d-none');
                    break;
                case 'closed_temporarily':
                    $('#div_closed_temporarily_till').removeClass('d-none');
                    break;
            }

        });

        $("#cabins-form").repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();

                initiateForAssets();

                initiateDateDropper('install_date');
                initiateDateDropper('service_date');
                initiateDateDropper('expire_date');
            },
            hide: function(e) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-danger me-1',
                        cancelButton: 'btn btn-success me-1'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).slideUp(e);
                    }
                });
            }
        });


    });

    function initiateDateDropper(element_id) {
        new dateDropper({
            selector: "[name^='cabin_assets['][name$='][" + element_id + "]']",
            format: "MM dd, y",
            showArrowsOnHover: true,
            expandable: true,
            startFromMonday: true,
            defaultDate: '{{ now()->format('Y/m/d') }}',
        });
    }

    function initiateForAssets() {

        $('.div-install-date').each(function(index) {
            $(this).attr('id', 'div-install-date-' + index);
        })

        $('.div-service-date').each(function(index) {
            $(this).attr('id', 'div-service-date-' + index);
        })

        $('.div-expire-date').each(function(index) {
            $(this).attr('id', 'div-expire-date-' + index);
        })


        $('.assetsSelectPicker').selectpicker().on('changed.bs.select', function(e, clickedIndex, isSelected,
            previousValue) {

                console.log($(this).prop('name'));

            let installable = $(this).find(':selected').data('installable');
            let serviceable = $(this).find(':selected').data('serviceable');
            let expireable = $(this).find(':selected').data('expireable');


        });

        // customer = $("[name^='cabin_asset['][name$='][name]']").wrap('<div class="position-relative"></div>');

        // customer.select2({
        //     ajax: {
        //         url: "{{ route('ajax.customers.index') }}",
        //         dataType: 'json',
        //         delay: 500,
        //         data: function(params) {
        //             return {
        //                 q: params.term,
        //                 type: "query",
        //                 // page: params.page
        //             };
        //         },
        //         processResults: function(response, params) {
        //             // params.page = params.page || 1;
        //             return {
        //                 results: response.data,
        //                 // pagination: {
        //                 //     more: (params.page * 30) < data.total_count
        //                 // }
        //             };
        //         },
        //         cache: true
        //     },
        //     placeholder: 'Search for Customers...',
        //     dropdownAutoWidth: !0,
        //     minimumInputLength: 2,
        //     dropdownParent: customer.parent(),
        //     width: "100%",
        //     containerCssClass: "select-lg",
        //     templateResult: function(row) {

        //         if (row.loading) {
        //             return row.text;
        //         }

        //         var $container = $(
        //             "<div class='d-flex flex-column'>" +
        //             "<div class='d-flex flex-row align-content-center gap-2'>" +
        //             "<div class='fw-bold fs-5'>" + row.name + "</div>" +
        //             "<div class='fw-bold fs-5 dot-divider mx-0'></div>" +
        //             "<div class='fw-bold fs-5' id='read-only-ratings_" + row.id + "'>&#9733; " +
        //             row
        //             .average_rating + "</div>" +
        //             "</div>" +
        //             "<div>Email: " + (row.email || "N/A") + "</div>" +
        //             "<div>Phone: " + (row.phone || "N/A") + "</div>" +
        //             "<div>Address: " + (row.address || "N/A") + "</div>" +
        //             "</div>"
        //         );

        //         return $container;
        //     },
        //     templateSelection: function(row) {
        //         if (row.id == '') {
        //             return row.text;
        //         }
        //         var $container = $(
        //             "<div class='d-flex flex-column'>" +
        //             "<div class='d-flex flex-row align-content-center gap-2'>" +
        //             "<div class='fw-bold'>" + (row.name || "") + "</div>" +
        //             "<div class='dot-divider mx-0'>-</div>" +
        //             "<div class='fw-bold' id='read-only-ratings_" + row.id + "'>&#9733; " + (row
        //                 .average_rating || "") + "</div>" +
        //             "</div>" +
        //             "</div>"
        //         );

        //         return $container;
        //     },
        // }).on('select2:select', function(e) {
        //     var data = e.params.data;
        // });

        // $(this).find("[name^='cabin_asset['][name$='][name]']").removeClass('select2-hidden-accessible');
        // $(this).find("[name^='cabin_asset['][name$='][name]']-container").remove();
        // $(this).find("[name^='cabin_asset['][name$='][name]']").select2();
    }

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }
</script>
