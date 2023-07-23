<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    {{-- <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document"> --}}
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add Comment - {{ $customer->name }} -
                    {{ $customer->phone }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="basicModal-close"></button>
            </div>
            <div class="modal-body mb-0">
                <form action="{{ route('ajax.customers.modal.store', ['customer' => $customer->id]) }}" method="POST"
                    id="customer_comments_form" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="rating" value="0" id="rating">

                    <div class="row mb-3">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="rating">Rating</label>
                            <div id="customer_ratings_{{ $customer->id }}"></div>
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
                <button type="button" class="btn btn-primary" onclick="formSubmit({{ $customer->id }});">
                    <span>Save</span>
                </button>

            </div>
        </div>
    </div>
</div>

<script>
    $("#customer_ratings_{{ $customer->id }}").rateYo({
        rating: 0,
        maxValue: 5,
        starWidth: "70px",
        ratedFill: "#7367f0",
    }).click(function() {
        $('#rating').val($(this).rateYo("rating"));
    });

    function formSubmit(customer_id) {
        $.ajax({
            url: ("{{ route('ajax.customers.modal.store', ['customer' => ':customer_id']) }}").replace(
                ':customer_id', customer_id),
            type: 'POST',
            cache: false,
            data: {
                rating: parseFloat($('#rating').val()),
                comments: $('#comments').val(),
            },
            beforeSend: function() {
                showBlockUI();
            },
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message.success, 'Success')
                    $('#basicModal').modal('hide');
                    $('.buttons-reload').trigger('click');
                }
            },
            error: function(jqXhr, json, errorThrown) {
                var errors = jqXhr.responseJSON;
                var errorsHtml = '';

                $.each(errors['errors'], function(index, value) {
                    errorsHtml += "<span class='badge rounded-pill bg-danger p-3 m-3'>" + index +
                        " -> " + value + "</span>";
                });
            },
            complete: function() {
                hideBlockUI();
            },
        });
    }
</script>
