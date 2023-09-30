<div class="d-flex justify-content-center align-items-center">
    @can('booking-taxes.edit')
        <a class="btn btn-warning m-1"
            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit International Ids"
            href="{{ route('booking-taxes.edit', ['booking_tax' => $id]) }}">
            <i class="fa-solid fa-i-cursor" style="font-size: 1.1rem" class="m-10"></i>
        </a>
    @endcan
</div>
