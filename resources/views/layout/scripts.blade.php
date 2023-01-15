<!-- BEGIN: Page Vendor JS-->

<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/buttons.colVis.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

<script src="{{ asset('public_assets/admin') }}/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/extensions/polyfill.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/js/scripts/components/components-tooltips.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/extensions/toastr.min.js"></script>
<script src="https://unpkg.com/flatpickr@4.6.11/dist/plugins/rangePlugin.js"></script>

<script src="{{ asset('public_assets/admin') }}/vendors/js/tables/datatable/buttons.server-side.js"></script>

<!-- BEGIN: Theme JS-->
<script src="{{ asset('public_assets/admin') }}/js/core/app-menu.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/js/core/app.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/js/scripts/ui/ui-feather.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/js/scripts/customizer.min.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('public_assets/admin') }}/js/scripts/tables/table-datatables-basic.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/forms/select/select2.full.min.js"></script>
<!-- END: Page JS-->

<script src="{{ asset('public_assets/admin') }}/js/scripts/forms/form-select2.min.js"></script>
<script src="{{ asset('public_assets/admin') }}/vendors/js/lightbox/lightbox.min.js"></script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }

        // toastr.success("You have successfully logged in to Admin Panel. Now you can start to explore!",
        //     "👋 Welcome John Doe!", {
        //         closeButton: !0,
        //         tapToDismiss: !1,
        //         showMethod: "slideDown",
        //         hideMethod: "slideUp",
        //         timeOut: 2e3,
        //         rtl: 0,
        //     });
    });

    $('#select-all').on('click', function() {
        $('.td-check').prop('checked', $(this).prop('checked'))
    });

    $('.btn-delete-selected').on('click', function() {
        $('#delete-selected-form').submit();
    });

    $('.permission-check-all').on('click', function() {
        var id = $(this).attr('id').substr(0, 1);
        $('#' + id + '_view').prop('checked', $(this).prop('checked'));
        $('#' + id + '_store').prop('checked', $(this).prop('checked'));
        $('#' + id + '_update').prop('checked', $(this).prop('checked'));
        $('#' + id + '_destroy').prop('checked', $(this).prop('checked'));
    });

    function validaitonNumber(element) {
        // if (element.value.length < 1) {
        //     element.value = 0;
        // }
        element.value = element.value.replace(/[^0-9]/g, '');
    }

    function showBlockUI(element = null) {
        blockUIOptions = {
            message: `
            <div class="d-flex justify-content-center flex-column align-items-center">
                <div class="la-fire la-3x text-primary">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <p class="mt-2 text-primary">Please wait...</p>
            </div>`,
            css: {
                backgroundColor: 'transparent',
                border: '0'
            },
            overlayCSS: {
                opacity: 0.8
            }
        };
        if (element) {
            $(element).block(blockUIOptions);
        } else {
            $.blockUI(blockUIOptions);
        }
    }

    function hideBlockUI(element = null) {
        if (element) {
            $(element).unblock();
        } else {
            $.unblockUI();
        }
    }

    function changeTableRowColor(element) {
            if ($(element).is(':checked'))
                $(element).closest('tr').addClass('table-primary');
            else {
                $(element).closest('tr').removeClass('table-primary');
            }
        }

        function changeAllTableRowColor() {
            $('.dt-checkboxes').trigger('change');
        }
</script>
