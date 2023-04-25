@extends('layout.layout')

@section('title', 'Cabin Type')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Cabin Type</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Cabin Type</a>
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
                <a href="{{ route('cabin_types.create') }}" class="btn btn-relief-outline-primary">
                    <i data-feather="plus" class="me-25"></i>
                    <span>Add</span>
                </a>
                @if (!is_null($cabinTypes) && !empty($cabinTypes))
                    {{ $cabinTypes->onEachSide(2)->links('layout.pagination') }}
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
                                {{-- <th style="vertical-align: middle;" scope="col">Rate</th> --}}
                                <th style="vertical-align: middle;" scope="col">Time / Date</th>
                                <th style="vertical-align: middle; width: 150px;" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('cabin_types.destroy', ['cabin_type' => 'empty']) }}"
                                id="delete-selected-form" method="POST">
                                @csrf
                                @method('DELETE')
                                @forelse ($cabinTypes as $cabinType)
                                    <tr>
                                        <td style="vertical-align: middle;" class="check">
                                            <div class="form-check">
                                                <label for="delete[{{ encryptParams($cabinType->id) }}]"></label>
                                                <input class="form-check-input td-check" type="checkbox"
                                                    id="delete[{{ encryptParams(encryptParams($cabinType->id)) }}]"
                                                    name="delete[{{ encryptParams($cabinType->id) }}]"
                                                    value="{{ encryptParams($cabinType->id) }}" />
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;">{{ $loop->index + 1 }}</td>
                                        <td style="vertical-align: middle;">{{ $cabinType->name }}</td>
                                        {{-- <td style="vertical-align: middle;">{{ number_format( $cabinType->rate, 2 ) }}</td> --}}
                                        <td style="vertical-align: middle;">
                                            {{ date('H:i:s', strtotime($cabinType->created_at)) }} <br>
                                            <span
                                                class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($cabinType->created_at)) }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                    data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item"
                                                        href="{{ route('cabin_types.edit', ['cabin_type' => encryptParams($cabinType->id)]) }}">
                                                        <i data-feather="edit-2" class="me-50"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" style="text-align: center">Data not found.</td>
                                    </tr>
                                @endforelse
                            </form>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="{{ route('cabin_types.create') }}" class="btn btn-relief-outline-primary">
                    <i data-feather="plus" class="me-25"></i>
                    <span>Add</span>
                </a>
                @if (!is_null($cabinTypes) && !empty($cabinTypes))
                    {{ $cabinTypes->onEachSide(2)->links('layout.pagination') }}
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
