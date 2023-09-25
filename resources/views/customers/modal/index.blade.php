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
            <div class="modal-body mb-0 pb-0">
                <form action="{{ route('ajax.customers.modal.store', ['customer' => $customer->id]) }}" method="POST"
                    id="customer_comments_form" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="rating" value="0" id="rating">

                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-6">
                            <div class="overflow-scroll p-2" style="overflow-y: scroll; max-height: 44em;">
                                <ul class="timeline pt-3">
                                    @forelse ($customer->ratings as $rating)
                                        <li class="timeline-item pb-4 timeline-item-primary border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-primary">
                                                <i class="ti ti-send rounded-circle scaleX-n1-rtl bg-transparent"></i>
                                            </span>
                                            <div class="timeline-event">
                                                <div class="timeline-header border-bottom mb-3">
                                                    <h6 class="mb-2"><div id="readonly_customer_ratings_{{ $rating->id }}"></div></h6>
                                                    <span class="text-muted">{!! editDateTimeColumn($rating->created_at, dateFormat: 'F j, Y', withBr: false, order: 'DT') !!}</span>
                                                </div>
                                                <div class="d-flex justify-content-between flex-wrap mb-2">
                                                    <div class="d-flex align-items-center text-break">
                                                        <span>{{ $rating->comments }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <script>
                                            StarRating("#readonly_customer_ratings_{{ $rating->id }}", {{ $rating->rating }}, 5);
                                        </script>
                                    @empty
                                    @endforelse

                                </ul>
                            </div>

                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
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
        // starWidth: "50px",
        ratedFill: "#ff9f43",
        "starSvg": '<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z" fill-rule="nonzero"/></svg> '
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
