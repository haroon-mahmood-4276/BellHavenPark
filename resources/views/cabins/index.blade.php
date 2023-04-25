@extends('layout.layout')

@section('title', 'Cabins')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Cabins</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Cabins</a>
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
                <a href="{{ route('cabins.create') }}" class="btn btn-relief-outline-primary">
                    <i data-feather="plus" class="me-25"></i>
                    <span>Add</span>
                </a>
                @if (!is_null($cabins) && !empty($cabins))
                    {{ $cabins->onEachSide(2)->links('layout.pagination') }}
                @endif
                <button class="btn btn-relief-outline-danger btn-delete-selected" id="btn-delete-selected">
                    <i data-feather="trash" class="me-25"></i>
                    <span>Delete Selected</span>
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive-md">
                    <table class="table table-hover table-hover-animation">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 50px; vertical-align: middle; align-items: center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select-all" value="all" />
                                    </div>
                                </th>
                                <th style="vertical-align: middle;" scope="col">#</th>
                                <th style="vertical-align: middle;" scope="col">Name</th>
                                <th style="vertical-align: middle;" scope="col">Cabin Status</th>
                                <th style="vertical-align: middle;" scope="col">Cabin Type</th>
                                <th style="vertical-align: middle;" scope="col">Long Term</th>
                                <th style="vertical-align: middle;" scope="col">Electric Meter</th>
                                <th style="vertical-align: middle;" scope="col">Time / Date</th>
                                <th style="vertical-align: middle; width: 150px;" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('cabins.destroy', ['cabin' => 'empty']) }}" id="delete-selected-form"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                @forelse ($cabins as $cabin)
                                    <tr>
                                        <td style="vertical-align: middle;" class="check">
                                            <div class="form-check">
                                                <label for="delete[{{ encryptParams($cabin->id) }}]"></label>
                                                <input class="form-check-input td-check" type="checkbox"
                                                    id="delete[{{ encryptParams(encryptParams($cabin->id)) }}]"
                                                    name="delete[{{ encryptParams($cabin->id) }}]"
                                                    value="{{ encryptParams($cabin->id) }}" />
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">{{ $loop->index + 1 }}</td>
                                        <td style="vertical-align: middle;">{{ $cabin->name }}</td>
                                        <td style="vertical-align: middle;">{{ $cabin->cabin_status_name }}</td>
                                        <td style="vertical-align: middle;">{{ $cabin->cabin_type_name }}</td>
                                        <td style="vertical-align: middle;">
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="checkbox" class="form-check-input"
                                                    id="long_term_{{ $loop->index }}" disabled
                                                    name="long_term_{{ $loop->index }}" value="1"
                                                    {{ $cabin->long_term == '1' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="long_term">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="form-check form-switch form-check-primary">
                                                <input type="checkbox" class="form-check-input"
                                                    id="electric_meter{{ $loop->index }}" disabled
                                                    name="electric_meter{{ $loop->index }}" value="1"
                                                    {{ $cabin->electric_meter == '1' ? 'checked' : '' }} />
                                                <label class="form-check-label" for="electric_meter">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {{ date('H:i:s', strtotime($cabin->created_at)) }} <br>
                                            <span
                                                class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($cabin->created_at)) }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="dropdown">
                                                <button Status="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                    data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item"
                                                        href="{{ route('cabins.edit', ['cabin' => encryptParams($cabin->id)]) }}">
                                                        <i data-feather="edit-2" class="me-50"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="20" style="text-align: center">Data not found.</td>
                                    </tr>
                                @endforelse
                            </form>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('cabins.create') }}" class="btn btn-relief-outline-primary">
                    <i data-feather="plus" class="me-25"></i>
                    <span>Add</span>
                </a>
                @if (!is_null($cabins) && !empty($cabins))
                    {{ $cabins->onEachSide(2)->links('layout.pagination') }}
                @endif
                <button class="btn btn-relief-outline-danger btn-delete-selected" id="btn-delete-selected">
                    <i data-feather="trash" class="me-25"></i>
                    <span>Delete Selected</span>
                </button>
            </div>
        </div>
        <!-- table -->
    </div>

@endsection
