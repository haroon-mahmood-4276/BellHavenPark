@extends('layout.layout')

@section('title', 'Edit Cabin')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit Cabin</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('cabins.index') }}">Cabins</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0);">Edit Cabin</a>
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
                <form action="{{ route('cabins.update', ['cabin' => encryptParams($cabin->id)]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="cabin_type">Cabin Type *</label>
                            <select class="select2-size-lg form-select @error('cabin_type') is-invalid @enderror"
                                id="cabin_type" name="cabin_type">
                                <option value="" selected>Select Cabin Type</option>
                                @foreach ($cabin_types as $cabin_type)
                                    <option value="{{ $cabin_type->id }}"
                                        {{ $cabin->haven_cabin_type_id == $cabin_type->id ? 'selected' : '' }}>
                                        {{ $loop->index + 1 }}) {{ $cabin_type->name }}</option>
                                @endforeach
                            </select>
                            @error('cabin_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="cabin_status">Cabin Status *</label>
                            <select class="select2-size-lg form-select @error('cabin_status') is-invalid @enderror"
                                id="cabin_status" name="cabin_status">
                                <option value="" selected>Select Cabin Status</option>
                                @foreach ($cabin_statuses as $cabin_status)
                                    <option value="{{ $cabin_status->id }}"
                                        {{ $cabin->haven_cabin_status_id == $cabin_status->id ? 'selected' : '' }}>
                                        {{ $loop->index + 1 }}) {{ $cabin_status->name }}</option>
                                @endforeach
                            </select>
                            @error('cabin_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="name">Cabin Name *</label>
                            <input type="text" id="name" name="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Cabin Name" aria-label="Cabin Name" value="{{ $cabin->name }}" minlength="3"
                                maxlength="50" />
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-xl-6 xol-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" style="font-size: 15px" for="daily_rate">Daily Rate
                                        *</label>
                                    <input type="text" id="daily_rate" name="daily_rate" value="0"
                                        oninput="validaitonNumber(this);"  class="form-control form-control-lg @error('daily_rate') is-invalid @enderror"
                                        placeholder="Daily Rate" aria-label="Daily Rate" value="{{ old('daily_rate') }}"
                                        minlength="3" maxlength="50" />
                                    @error('daily_rate')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-xl-6 xol-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" style="font-size: 15px" for="weekly_rate">Weekly Rate
                                        *</label>
                                    <input type="text" id="weekly_rate" name="weekly_rate" value="0"
                                        oninput="validaitonNumber(this);" class="form-control form-control-lg @error('weekly_rate') is-invalid @enderror"
                                        placeholder="Weekly Rate" aria-label="Weekly Rate"
                                        value="{{ old('weekly_rate') }}" minlength="3" maxlength="50" />
                                    @error('weekly_rate')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="long_term">Long Term</label>
                            <div class="form-check form-switch form-check-primary">
                                <input type="hidden" name="long_term" value="0" />
                                <input type="checkbox" class="form-check-input" id="long_term" name="long_term" value="1"
                                    {{ $cabin->long_term == '1' ? 'checked' : '' }} />
                                <label class="form-check-label" for="long_term">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>
                            @error('long_term')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="electric_meter">Electric
                                Meter</label>
                            <div class="form-check form-switch form-check-primary">
                                <input type="hidden" name="electric_meter" value="0" />
                                <input type="checkbox" class="form-check-input" id="electric_meter" name="electric_meter"
                                    value="1" {{ $cabin->electric_meter == '1' ? 'checked' : '' }} />
                                <label class="form-check-label" for="electric_meter">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>
                            @error('electric_meter')
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
