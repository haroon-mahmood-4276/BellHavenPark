<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    {{-- <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document"> --}}
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Cabin - Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="basicModal-close"></button>
            </div>
            <div class="modal-body mb-0 pb-0">
                <form action="{{ route('cabins.maintenance.store') }}" method="POST" id="form_maintenance_cabin"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="cabins">Cabins</label>
                            <select class="select2-size-lg form-select" id="cabins" name="cabins">
                                @foreach ($cabins as $cabin)
                                    <option data-icon="fa-solid fa-angle-right" value="{{ $cabin['id'] }}">
                                        {{ $cabin['name'] }} - {{ Str::of($cabin['cabin_status'])->headline() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12 col-sm-12 position-relative">
                            <label class="form-label" style="font-size: 15px" for="reason">Reason <span
                                    class="text-danger"></span></label>
                            <textarea class="form-control" id="reason" name="reason" placeholder="ex. reason for under maintenance etc"
                                rows="5"></textarea>
                        </div>
                    </div>
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
            containerCssClass: "select-lg",
            templateResult: function(e) {
                return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e
                    .text
            },
            templateSelection: function(e) {
                return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e
                    .text
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
