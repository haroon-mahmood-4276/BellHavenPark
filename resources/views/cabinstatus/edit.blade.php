@extends('layout.layout')

@section('title', 'Edit Cabin Status')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit Cabin Status</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('cabin_statuses.index') }}">Cabin Status</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Cabin Status</a>
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
        <div class="card">
            <div class="card-body">
                <form action="{{ route('cabin_statuses.update', ['cabin_status' => $cabinStatus->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="name">Cabin Status Name *</label>
                            <input type="text" id="name" name="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Cabin Status Name" aria-label="Cabin Status Name" value="{{ $cabinStatus->name }}"
                                minlength="3" maxlength="50" />
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="description">Description</label>
                            <textarea id="description" name="description"
                                class="form-control form-control-lg @error('description') is-invalid @enderror"
                                placeholder="Description" aria-label="Description"
                                rows="5">{{ $cabinStatus->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-relief-outline-danger me-1">
                            <i data-feather='x-circle' class="me-25"></i>
                            <span>Reset</span>
                        </button>
                        <button type="submit" class="btn btn-relief-outline-primary">
                            <i data-feather='check-circle' class="me-25"></i>
                            <span>Save</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
