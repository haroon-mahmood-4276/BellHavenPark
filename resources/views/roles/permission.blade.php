@extends('layout.layout')

@section('title', 'Permissions')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Permissions</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Permissions</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="content-body">
        <!-- table -->
        <div class="card">
            <div class="card-header">
                <h4>{{ $role->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.permissions.update', ['role' => encryptParams($role->id)]) }}"
                    id="permissions-update-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive-md">
                        <table class="table table-hover ">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Store</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Destroy</th>
                                    <th scope="col">All</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 1;
                                @endphp

                                @forelse ($roles_permissions as $permission)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td style="text-align: left !important;">{{ $permission->name }}</td>
                                        {{-- <td>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="hidden"
                                                    name="check[{{ $permission->haven_permission_id }}][view]"
                                                    value="off" />
                                                <input type="checkbox" class="form-check-input"  id="customSwitch10"
                                                    checked />
                                                <label class="form-check-label" for="customSwitch10">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </td> --}}
                                        <td>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="hidden"
                                                    name="check[{{ $permission->haven_permission_id }}][view]"
                                                    value="off" />
                                                <input type="checkbox" class="form-check-input"
                                                    name="check[{{ $permission->haven_permission_id }}][view]"
                                                    id="{{ $permission->haven_permission_id }}_view"
                                                    {{ $permission->view == 1 ? 'checked' : null }} />
                                                <label class="form-check-label" for="{{ $permission->haven_permission_id }}_view">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="hidden"
                                                    name="check[{{ $permission->haven_permission_id }}][store]"
                                                    value="off" />
                                                <input type="checkbox" class="form-check-input"
                                                    name="check[{{ $permission->haven_permission_id }}][store]"
                                                    id="{{ $permission->haven_permission_id }}_store"
                                                    {{ $permission->store == 1 ? 'checked' : null }} />
                                                <label class="form-check-label" for="{{ $permission->haven_permission_id }}_store">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="hidden"
                                                    name="check[{{ $permission->haven_permission_id }}][update]"
                                                    value="off" />
                                                <input type="checkbox" class="form-check-input"
                                                    name="check[{{ $permission->haven_permission_id }}][update]"
                                                    id="{{ $permission->haven_permission_id }}_update"
                                                    {{ $permission->update == 1 ? 'checked' : null }} />
                                                <label class="form-check-label" for="{{ $permission->haven_permission_id }}_update">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="hidden"
                                                    name="check[{{ $permission->haven_permission_id }}][destroy]"
                                                    value="off" />
                                                <input type="checkbox" class="form-check-input"
                                                    name="check[{{ $permission->haven_permission_id }}][destroy]"
                                                    id="{{ $permission->haven_permission_id }}_destroy"
                                                    {{ $permission->destroy == 1 ? 'checked' : null }} />
                                                <label class="form-check-label" for="{{ $permission->id }}_destroy">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="hidden"
                                                    name="check[{{ $permission->haven_permission_id }}][all]"
                                                    value="off" />
                                                <input type="checkbox" class="form-check-input permission-check-all"
                                                    name="check[{{ $permission->haven_permission_id }}][all]"
                                                    id="{{ $permission->haven_permission_id }}_all"
                                                    {{ $permission->all == 1 ? 'checked' : null }} />
                                                <label class="form-check-label" for="{{ $permission->haven_permission_id }}_all">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" style="text-align: center">No permissions found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-relief-outline-primary me-1">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- table -->
    </div>

@endsection
