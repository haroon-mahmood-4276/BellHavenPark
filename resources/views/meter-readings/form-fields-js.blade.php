<script src="{{ asset('assets') }}/vendor/libs/feligx/datedropper/datedropper.min.js"></script>
<script>
    $(document).ready(function() {
        new dateDropper({
            // overlay: true,
            // expandedDefault: true,
            expandable: true,
            selector: '#reading_date',
            format: 'MM dd, y',
            startFromMonday: true,
            minDate: moment().subtract(7, 'd').format('YYYY/MM/DD'),
            defaultDate: "{{ isset($meterReading) ? Carbon\Carbon::parse($meterReading->reading_date)->toDateString() : now()->toDateString() }}",
            // maxDate: moment().format('YYYY/MM/DD')
        });

        cabin_id = $("#cabin_id").wrap('<div class="position-relative"></div>');
        cabin_id.select2({
            ajax: {
                url: "{{ route('ajax.cabins.index') }}",
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
            placeholder: 'Search for Cabin...',
            dropdownAutoWidth: !0,
            minimumInputLength: 2,
            dropdownParent: cabin_id.parent(),
            width: "100%",
            containerCssClass: "select-lg",
            templateResult: function(row) {
                if (row.loading) {
                    return row.text;
                }
                return row.name || row.text;
            },
            templateSelection: function(row) {
                if (row.id == '') {
                    return row.text;
                }
                return row.name || row.text;
            },
        }).on('select2:select', function(e) {
            showBlockUI();
            getPreviousReading(e.params.data.id, $('#meter_type').val());
            hideBlockUI();
        });

        meter_type = $("#meter_type").wrap('<div class="position-relative"></div>');
        meter_type.select2({
            placeholder: 'Select meter',
            dropdownAutoWidth: !0,
            dropdownParent: meter_type.parent(),
            width: "100%",
            containerCssClass: "select-lg",
        }).on('select2:select', function(e) {
            showBlockUI();
            getPreviousReading(cabin_id.find(':selected').val(), e.params.data.id)
            hideBlockUI();
        });

        function getPreviousReading(cabin_id, meter_type) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "{{ route('ajax.cabins.meter-readings.previous', ['cabin' => ':cabin_id']) }}"
                    .replace(':cabin_id', cabin_id),
                data: {
                    'meter_type': meter_type
                },
                type: 'GET',
                cache: false,
                success: function(response) {
                    if (response.status && response?.data) {
                        $('#previous_reading').val(response?.data?.reading)
                        $('#span_previous_reading_date').html(moment.unix(response?.data
                            ?.reading_date).format("MMMM, DD YYYY"))
                        // .attr('data-bs-original-title', moment.unix(response?.data?.reading_date).format("dddd, MMMM, DD YYYY, h:mm:ss a"))
                    } else {
                        $('#previous_reading').val(0)
                        $('#span_previous_reading_date').html('N/A')
                        // .attr('data-bs-original-title', 'N/A')
                    }
                },
                error: function(jqXhr, json, errorThrown) {
                    hideBlockUI();

                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';

                    $.each(errors['errors'], function(index, value) {
                        errorsHtml +=
                            "<span class='badge rounded-pill bg-danger p-3 m-3'>" +
                            index +
                            " -> " + value + "</span>";
                    });
                }
            });
        }

        // if ({{ $from === 'edit' ? true : false }}) {
        //     showBlockUI();
        //     getPreviousReading(cabin_id.find(':selected').val(), $('#meter_type').val());
        //     hideBlockUI();
        // }
    });
</script>
