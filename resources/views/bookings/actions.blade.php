<div class="d-flex justify-content-center align-items-center">
    @if (!is_null($filter))
        @if ($filter == 'checkin')
            @can('bookings.checkin.index')
                <form action="{{ route('bookings.checkin.store', ['booking' => $booking]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Check in">
                        <i class="fa-solid fa-arrow-right-to-bracket" style="font-size: 1.1rem"></i></button>
                </form>
            @endcan
        @endif

        @if ($filter == 'checkout')
            @can('bookings.checkout.index')
                <form action="{{ route('bookings.checkout.store', ['booking' => $booking]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Check out">
                        <i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 1.1rem"></i></button>
                </form>
            @endcan
        @endif
    @endif
    @can('bookings.payments.create')
        <a class="btn btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Booking Payment"
            href="{{ route('bookings.payments.index', ['booking' => $booking]) }}">
            <i class="fa-solid fa-dollar-sign" style="font-size: 1.1rem" class="m-10"></i>
        </a>
    @endcan
</div>
