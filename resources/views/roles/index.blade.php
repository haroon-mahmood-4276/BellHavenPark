@extends('layout.layout')

@section('title', 'Roles')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Roles</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Roles</a>
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
                @if (permission_check('roles')->store)
                    <a href="{{ route('roles.create') }}" class="btn btn-relief-outline-primary" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Add New Role">
                        <i data-feather="plus"></i>
                        {{-- <span class="me-25">Add</span> --}}
                    </a>
                @endif
                @if (!is_null($roles) && !empty($roles))
                    {{ $roles->onEachSide(2)->links('layout.pagination') }}
                @endif
                @if (permission_check('roles')->destroy)
                    <button class="btn btn-relief-outline-danger" id="btn-delete-selected" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Deleted Selected">
                        <i data-feather="trash"></i>
                        {{-- <span class="me-25">Deleted Selected</span> --}}
                    </button>
                @endif
            </div>

            <div class="card-body">
                <div class="table-responsive-md">
                    <table class="table table-hover sortable-table text-center">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 50px; align-items: center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select-all" value="all" />
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Role</th>
                                <th scope="col">Time / Date</th>
                                <th scope="col" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            <form action="{{ route('roles.destroy', ['role' => 'empty']) }}" id="delete-selected-form"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                @forelse ($roles as $role)
                                    @continue($role->id == 1)
                                    <tr>
                                        <td class="check">
                                            @if (permission_check('roles')->destroy)
                                                <div class="form-check">
                                                    <label for="delete[{{ encryptParams($role->id) }}]"></label>
                                                    <input class="form-check-input td-check" type="checkbox"
                                                        id="delete[{{ encryptParams(encryptParams($role->id)) }}]"
                                                        name="delete[{{ encryptParams($role->id) }}]"
                                                        value="{{ encryptParams($role->id) }}" />
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ Str::of($role->name)->limit(50, '...') }}</td>
                                        <td>{{ date('H:i:s', strtotime($role->created_at)) }} <br>
                                            <span
                                                class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($role->created_at)) }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="d-flex justify-content-center">
                                                @if (permission_check('roles')->update)
                                                    <a class="btn btn-relief-outline-primary me-1" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Edit Role"
                                                        href="{{ route('roles.edit', ['role' => encryptParams($role->id)]) }}">
                                                        <i data-feather="edit-2"></i>
                                                        {{-- <span class="me-50">Edit</span> --}}
                                                    </a>
                                                @endif

                                                @if (permission_check('permissions')->update)
                                                    <a class="btn btn-relief-outline-primary" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Permissions"
                                                        href="{{ route('roles.permissions', ['role' => encryptParams($role->id)]) }}">
                                                        <i data-feather="lock"></i>
                                                        {{-- <span class="me-50">Permissions</span> --}}
                                                    </a>
                                                @endif
                                            </div>

                                            {{-- <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                    data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @if (permission_check('roles')->update)
                                                        <a class="dropdown-item"
                                                            href="{{ route('roles.edit', ['role' => encryptParams($role->id)]) }}">
                                                            <i data-feather="edit-2" class="me-50"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    @endif

                                                    @if (permission_check('permissions')->update)
                                                        <a class="dropdown-item"
                                                            href="{{ route('roles.permissions', ['role' => encryptParams($role->id)]) }}">
                                                            <i data-feather="lock" class="me-50"></i>
                                                            <span>Permissions</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div> --}}
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center">Data not found.</td>
                                    </tr>
                                @endforelse
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer d-flex align-items-center justify-content-between">
                @if (permission_check('roles')->store)
                    <a href="{{ route('roles.create') }}" class="btn btn-relief-outline-primary" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Add New Role">
                        <i data-feather="plus"></i>
                        {{-- <span class="me-25">Add</span> --}}
                    </a>
                @endif
                @if (!is_null($roles) && !empty($roles))
                    {{ $roles->onEachSide(2)->links('layout.pagination') }}
                @endif
                @if (permission_check('roles')->destroy)
                    <button class="btn btn-relief-outline-danger" id="btn-delete-selected" data-bs-toggle="tooltip"
                        data-bs-placement="bottom" title="Deleted Selected">
                        <i data-feather="trash"></i>
                        {{-- <span class="me-25">Deleted Selected</span> --}}
                    </button>
                @endif
            </div>
        </div>
        <!-- table -->
    </div>

@endsection
