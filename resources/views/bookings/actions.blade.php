<div class="d-flex justify-content-cetner align-items-center">
    @can('customers.edit')
        <a class="btn btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Booking Payment"
            href="{{ route('bookings.payments.index', ['id' => encryptParams($id)]) }}">
            <i class="fa-solid fa-dollar-sign" style="font-size: 1.1rem" class="m-10"></i>
        </a>
    @endcan
</div>
