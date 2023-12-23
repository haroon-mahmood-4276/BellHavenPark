@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'cabins.index') }}
@endsection

@section('page-title', 'Cabins')

@section('page-vendor')
    {{ view('layout.libs.datatables.css') }}
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Cabins (Needs Cleani)</h2>
        {{ Breadcrumbs::render('cabins.index') }}
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('cabins.needs-cleaning.update') }}" id="cabins-table-form" method="POST">
                        @csrf
                        @method('PUT')
                        {{ $dataTable->table() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    {{ view('layout.libs.datatables.js') }}
@endsection

@section('page-js')
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
        function updateForCheckInCabins() {
            var selectedCheckboxes = $('.dt-checkboxes:checked').length;
            if (selectedCheckboxes > 0) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Are you sure you want to update the selected items?',
                    showCancelButton: true,
                    cancelButtonText: 'No',
                    confirmButtonText: 'Yes',
                    confirmButtonClass: 'btn-success',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-success me-1',
                        cancelButton: 'btn btn-danger me-1'
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#cabins-table-form').submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please select at least one item!',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-success me-1',
                        cancelButton: 'btn btn-danger me-1'
                    },
                });
            }
        }
    </script>
@endsection
