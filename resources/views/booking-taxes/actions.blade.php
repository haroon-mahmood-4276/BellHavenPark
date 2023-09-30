<div class="d-flex justify-content-center align-items-center">
    @can('booking-taxes.set-default')
        <a class="btn btn-primary m-1" href="{{ route('booking-taxes.set-default', ['booking_tax' => $id]) }}">
            <i class="fa-regular fa-check-circle" style="font-size: 1.1rem" class="m-10"></i>
        </a>
    @endcan
    @can('booking-taxes.edit')
        <a class="btn btn-warning m-1" href="{{ route('booking-taxes.edit', ['booking_tax' => $id]) }}">
            <i class="fa-solid fa-i-cursor" style="font-size: 1.1rem" class="m-10"></i>
        </a>
    @endcan
</div>
