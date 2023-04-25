@extends('layout.layout')

@section('title', 'International ID\'s')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">International ID's</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">International ID's</a>
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
                <a href="{{ route('internationalids.create') }}" class="btn btn-relief-outline-primary">
                    <i data-feather="plus" class="me-25"></i>
                    <span>Add</span>
                </a>
                @if (!is_null($international_ids) && !empty($international_ids))
                    {{ $international_ids->onEachSide(2)->links('layout.pagination') }}
                @endif
                <button class="btn btn-relief-outline-danger btn-delete-selected" id="btn-delete-selected">
                    <i data-feather="trash" class="me-25"></i>
                    <span>Deleted Selected</span>
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive-md">
                    <table class="table table-hover table-hover-animation">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 50px; align-items: center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select-all" value="all" />
                                    </div>
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Time / Date</th>
                                <th scope="col" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('internationalids.destroy', ['internationalid' => 'empty']) }}"
                                id="delete-selected-form" method="POST">
                                @csrf
                                @method('DELETE')

                                @forelse ($international_ids as $international_id)
                                    <tr>
                                        <td class="check">

                                            <div class="form-check">
                                                <label for="delete[{{ encryptParams($international_id->id) }}]"></label>
                                                <input class="form-check-input td-check" type="checkbox"
                                                    id="delete[{{ encryptParams(encryptParams($international_id->id)) }}]"
                                                    name="delete[{{ encryptParams($international_id->id) }}]"
                                                    value="{{ encryptParams($international_id->id) }}" />
                                            </div>

                                        </td>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $international_id->name }}</td>
                                        <td>{{ date('H:i:s', strtotime($international_id->created_at)) }} <br>
                                            <span
                                                class="text-primary fw-bolder">{{ date('d/m/Y', strtotime($international_id->created_at)) }}</span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                    data-bs-toggle="dropdown">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item"
                                                        href="{{ route('internationalids.edit', ['internationalid' => encryptParams($international_id->id)]) }}">
                                                        <i data-feather="edit-2" class="me-50"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </div>
                                            </div>
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
                <a href="{{ route('internationalids.create') }}" class="btn btn-relief-outline-primary">
                    <i data-feather="plus" class="me-25"></i>
                    <span>Add</span>
                </a>
                @if (!is_null($international_ids) && !empty($international_ids))
                    {{ $international_ids->onEachSide(2)->links('layout.pagination') }}
                @endif
                <button class="btn btn-relief-outline-danger btn-delete-selected" id="btn-delete-selected">
                    <i data-feather="trash" class="me-25"></i>
                    <span>Deleted Selected</span>
                </button>
            </div>
        </div>
        <!-- table -->
    </div>

@endsection
