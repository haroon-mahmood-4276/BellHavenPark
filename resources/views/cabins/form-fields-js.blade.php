<script src="{{ asset('assets') }}/vendor/libs/feligx/datedropper/datedropper.min.js"></script>
<script>
    $(document).ready(function() {

        new dateDropper({
            selector: '#closed_permanent_till',
            format: "MM dd, y",
            showArrowsOnHover: true,
            expandable: true,
            startFromMonday: true,
            defaultDate: "{{ now()->format('Y/m/d') }}",
            minDate: "{{ now()->format('Y/m/d') }}"
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
            var data = e.params.data;

            switch (data.id) {
                case 'closed-permanent':
                    $('#div_closed_permanent_till').removeClass('d-none');
                    break;
                case 'closed-temporarily':
                    $('#div_closed_temporarily_till').removeClass('d-none');
                    break;

                default:
                    break;
            }

        });
    });

    function c(e) {
        return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
    }
</script>
