@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'customers.index') }}
@endsection

@section('page-title', 'Customers')

@section('page-vendor')
    {{ view('layout.datatables.css') }}
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/rateyo/jquery.rateyo.min.css">
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Customers</h2>
        {{ Breadcrumbs::render('customers.index') }}
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('customers.destroy') }}" id="customers-table-form" method="get">
                        {{ $dataTable->table() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    {{ view('layout.datatables.js') }}
@endsection

@section('page-js')
    <script src="{{ asset('assets') }}/vendor/libs/rateyo/jquery.rateyo.min.js"></script>
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
        $(".read-only-ratings").rateYo({
            rating: 2,
        });

        function deleteSelected() {
            var selectedCheckboxes = $('.dt-checkboxes:checked').length;
            if (selectedCheckboxes > 0) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Are you sure you want to delete the selected items?',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                    confirmButtonClass: 'btn-danger',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-1',
                        cancelButton: 'btn btn-success me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#customers-table-form').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please select at least one item!',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-1',
                        cancelButton: 'btn btn-success me-1'
                    },
                });
            }
        }

        function addNew() {
            location.href = "{{ route('customers.create') }}";
        }

        function rateYo(customer_id, average_rating) {
            $("#read-only-ratings_" + customer_id).rateYo({
                rating: average_rating,
                maxValue: 5,
                readOnly: true,
                starWidth: "25px",
                numStars: 1,
                ratedFill: "#7367f0",
            });
        }
    </script>
@endsection
