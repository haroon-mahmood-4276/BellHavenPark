@extends('layout.layout')

@section('title', 'Add New Cabin Type')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Add New Cabin Type</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('cabin_types.index') }}">Cabin Type</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Add New Cabin Type</a>
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
            <form action="{{ route('cabin_types.store') }}" method="POST">
                @csrf
                <div class="row mb-1">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label class="form-label" style="font-size: 15px" for="name">Cabin Type Name *</label>
                        <input type="text" id="name" name="name"
                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                            placeholder="Cabin Type Name" aria-label="Cabin Type Name" value="{{ old('name') }}" minlength="3"
                            maxlength="50" />
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <label class="form-label" style="font-size: 15px" for="rate">Rate</label>
                        <input type="text" id="rate" name="rate"
                            class="form-control form-control-lg @error('rate') is-invalid @enderror"
                            placeholder="Rate" aria-label="Rate" value="{{ old('rate') }}"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '');"/>
                        @error('rate')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div> --}}
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
