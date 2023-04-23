<div class="d-flex justify-content-cetner align-items-center">
    @if (!is_null($filter))
        @if ($filter == 'checkin')
            @can('bookings.checkin.index')
                <form action="{{ route('bookings.checkin.store', ['id' => encryptParams($id)]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Booking Payment">
                        <i class="fa-solid fa-arrow-right-to-bracket" style="font-size: 1.1rem"></i>&nbsp;&nbsp;
                        Check In</button>
                </form>
            @endcan
        @endif

        @if ($filter == 'checkout')
            @can('bookings.checkout.index')
                <form action="{{ route('bookings.checkout.store', ['id' => encryptParams($id)]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Booking Payment">
                        <i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 1.1rem"></i>&nbsp;&nbsp;Check Out</button>
                </form>
            @endcan
        @endif
    @endif
    @can('bookings.payments.create')
        <a class="btn btn-primary m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Booking Payment"
            href="{{ route('bookings.payments.index', ['id' => encryptParams($id)]) }}">
            <i class="fa-solid fa-dollar-sign" style="font-size: 1.1rem" class="m-10"></i>
        </a>
    @endcan
</div>
