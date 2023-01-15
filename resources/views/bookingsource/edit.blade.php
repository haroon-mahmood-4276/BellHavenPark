@extends('layout.layout')

@section('title', 'Edit Booking Source')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit Booking Source</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('booking_sources.index') }}">Booking Source</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Booking Source</a>
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
                <form action="{{ route('booking_sources.update', ['booking_source' => encryptParams($booking_source->id)]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="name">Booking Source Name *</label>
                            <input type="text" id="name" name="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Booking Source Name" aria-label="Booking Source Name" value="{{ $booking_source->name }}"
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
                                rows="5">{{ $booking_source->description }}</textarea>
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
