@extends('layout.layout')

@section('seo-breadcrumb')
    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'roles.index') }}
@endsection

@section('page-title', 'Roles')

@section('page-vendor')
    {{ view('layout.datatables.css') }}
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Roles</h2>
        {{ Breadcrumbs::render('roles.index') }}
    </div>
@endsection

@section('content')
    <p class="mb-4">A role provided access to predefined menus and features so that depending on <br> assigned role an
        administrator can have access to what user needs.</p>
    <!-- Role cards -->
    <div class="row g-4 mb-4">
        @forelse ($roles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-normal mb-2">Total 4 users</h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/5.png"
                                        alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Allen Rieske" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/12.png"
                                        alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Julee Rossignol" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/6.png"
                                        alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/3.png"
                                        alt="Avatar">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="John Doe" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/1.png"
                                        alt="Avatar">
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-between align-items-end mt-1">
                            <div class="role-heading">
                                <h4 class="mb-1">{{ $role->name }}</h4>
                                <a href="{{ route('roles.edit', ['id' => $role->id]) }}"
                                    class="role-edit-modal"><span>Edit Role</span></a>
                            </div>
                            {{-- <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse

        @can('roles.create')
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                <img src="{{ asset('assets') }}/img/illustrations/add-new-roles.png"
                                    class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button class="btn btn-primary mb-2 text-nowrap" onclick="addNew();"><i
                                        class="fa-solid fa-plus"></i>&nbsp;&nbsp;Add New Role</button>
                                <p class="mb-0 mt-1">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('roles.destroy') }}" id="roles-table-form" method="get">
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
@endsection

@section('custom-js')
    {{ $dataTable->scripts() }}
    <script>
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
                        $('#roles-table-form').submit();
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
            location.href = "{{ route('roles.create') }}";
        }
    </script>
@endsection
