<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    {{-- <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document"> --}}
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Remove Cabin - Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="basicModal-close"></button>
            </div>
            <div class="modal-body mb-0 pb-0">
                <form action="{{ route('cabins.maintenance.store') }}" method="POST" id="form_maintenance_cabin"
                    enctype="multipart/form-data">

                    @csrf
                    @method('DELETE')
                    @include('cabins.maintenance.modal.form-fields')
                </form>

            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger me-1">
                    <span>Reset</span>
                </button>
                <button type="button" class="btn btn-primary btn-submit" id="btn-submit">
                    <span>Save</span>
                </button>

            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        cabins = $("#cabins");
        cabins.wrap('<div class="position-relative"></div>');
        cabins.select2({
            dropdownAutoWidth: !0,
            dropdownParent: cabins.parent(),
            width: "100%",
            multiple: true,
            containerCssClass: "select-lg",
            templateResult: function(e) {
                return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e
                    .text
            },
            templateSelection: function(e) {
                return e.text
            },
            escapeMarkup: function(cabins) {
                return cabins
            }
        });

        $('#btn-submit').on('click', function() {
            $('#form_maintenance_cabin').submit();
        });
    });
</script>
