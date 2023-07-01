@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'bookings.calender.index') }}
@endsection

@section('page-title', 'Calender')

@section('page-vendor')
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/fullcalendar/fullcalendar.css" />
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/app-calendar.css" />
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Calender</h2>
        {{ Breadcrumbs::render('bookings.calender.index') }}
    </div>
@endsection

@section('content')
    <div class="card app-calendar-wrapper">
        <div class="row g-0">
            <div class="col app-calendar-content">
                <div class="card shadow-none border-0">
                    <div class="card-body pb-0">
                        <!-- FullCalendar -->
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    <script src="{{ asset('assets') }}/vendor/libs/fullcalendar/fullcalender.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
@endsection

@section('page-js')
@endsection

@section('custom-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var events = [];
            var eventsColors = {
                Booked: "primary",
                CheckedIn: "info",
                CheckedOut: "success",
            }
            @forelse($bookings as $booking)
                events.push({
                    id: '{{ $booking->booking_number }}',
                    title: '{{ "#" . $booking->booking_number . " - " . $booking->customer->name . " - " . $booking->cabin->name }}',
                    start: '{{ Carbon\Carbon::parse($booking->booking_from)->format("Y-m-d")}}',
                    end: '{{ Carbon\Carbon::parse($booking->booking_to)->format("Y-m-d") }}',
                    // classNames: 'fc-event fc-event-primary'
                    extendedProps: {
                        class: '{{ $booking->check_in_date < 1 && $booking->check_out_date < 1 ? "Booked" : ($booking->check_out_date < 1 ? "CheckedIn" : "CheckedOut") }}'
                    }
                });
            @empty
            @endforelse

            let calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                initialView: 'dayGridMonth',
                dayMaxEventRows: 3,
                headerToolbar: {
                    left: 'AddNewBooking,prev,next',
                    center: 'title',
                    right: 'dayGridYear,dayGridMonth,multiMonthYear'
                },
                customButtons: {
                    AddNewBooking: {
                        text: "Add New Booking",
                        click: function() {
                            window.location.replace('{{ route('bookings.create') }}');
                        }
                    }
                },
                buttonText: {
                    multiMonthYear: "Multi Month"
                },
                aspectRatio: 1.5,
                fixedWeekCount: true,
                firstDay: 1,
                events: events,
                eventClassNames: function({
                    event: event
                }) {
                    return ["fc-event-" + eventsColors[event.extendedProps.class]]
                },
                eventClick: function({
                    event: event
                }) {
                    console.log(event.extendedProps)
                },
                eventMouseEnter: function({
                    el: element
                }) {
                    $(element).attr('href', 'javascript:void(0)')
                }
            }).render();

            initializeAddBookingButton();
        });

        function initializeAddBookingButton() {

            $('.fc-AddNewBooking-button').each(function() {
                $(this).removeClass(['fc-button', 'fc-button-primary']).addClass(['btn', 'btn-primary', 'me-3']);
            })
            // $('.fc-daygrid-day-bottom').each(function() {
            //     $(this).css('margin-top', '65px')
            // })
        }
    </script>
@endsection
