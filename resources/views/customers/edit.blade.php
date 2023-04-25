@extends('layout.layout')

@section('title', 'Update Customer')

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Edit Customer</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('customers.index') }}">Customers</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Edit Customer</a>
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
                <form action="{{ route('customers.update', ['customer' => encryptParams($customer->id)]) }}"
                    class="tenants-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="first_name">First Name *</label>
                            <input type="text" id="first_name" name="first_name"
                                class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                                placeholder="First Name" aria-label="First Name" value="{{ $customer->first_name }}"
                                minlength="3" maxlength="50" />
                            @error('first_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="last_name">Last Name *</label>
                            <input type="text" id="last_name" name="last_name"
                                class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                                placeholder="Last Name" aria-label="Last Name" value="{{ $customer->last_name }}"
                                min="3" max="50" />
                            @error('last_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="email">Email *</label>
                            <input type="text" id="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                placeholder="Email" aria-label="Email" value="{{ $customer->email }}" min="3"
                                max="50" disabled />
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="dob">DOB *</label>
                            <input type="text" id="dob" name="dob"
                                class="form-control form-control-lg dob-human-friendly @error('dob') is-invalid @enderror"
                                placeholder="October 14, 2020" onload="openFlatPicker('{{ $customer->dob }}')" />
                            @error('dob')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="phone">Mobile *</label>
                            <input type="text" id="phone" name="phone"
                                class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                placeholder="Phone" aria-label="Phone" value="{{ $customer->phone }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" min="1" max="20" />
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="telephone">Telephone</label>
                            <input type="text" id="telephone" name="telephone"
                                class="form-control form-control-lg @error('telephone') is-invalid @enderror"
                                placeholder="Telephone" aria-label="Telephone" value="{{ $customer->telephone }}"
                                min="1" max="20"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                            @error('telephone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="id_type">ID Type *</label>
                            <select class="select2-size-lg form-select @error('id_type') is-invalid @enderror"
                                id="id_type" name="id_type">
                                {{-- <option value="" selected>ID Type</option> --}}
                                @foreach ($id_types as $id_type)
                                    <option value="{{ $id_type->id }}"
                                        {{ $customer->haven_international_id_id == $id_type->id ? 'selected' : '' }}>
                                        {{ $loop->index + 1 }} - {{ $id_type->name }}</option>
                                @endforeach
                            </select>
                            @error('id_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="id_details">ID Details *</label>
                            <input type="text" id="id_details" name="id_details"
                                class="form-control form-control-lg @error('id_details') is-invalid @enderror"
                                placeholder="ID Details" aria-label="id_details"
                                value="{{ $customer->haven_international_id_details }}" min="3" max="50" />
                            @error('id_details')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="id_address">ID Address *</label>
                            <input type="text" id="id_address" name="id_address"
                                class="form-control form-control-lg @error('id_address') is-invalid @enderror"
                                placeholder="ID Address" aria-label="id_address"
                                value="{{ $customer->haven_international_id_address }}" min="3" max="50" />
                            @error('id_address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="comments">Comments</label>
                            <textarea type="text" id="comments" name="comments"
                                class="form-control form-control-lg @error('comments') is-invalid @enderror" placeholder="Comments"
                                aria-label="comments" rows="5">{{ $customer->comments }}</textarea>
                            @error('comments')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="address">Address *</label>
                            <textarea type="text" id="address" name="address"
                                class="form-control form-control-lg @error('address') is-invalid @enderror" placeholder="Address"
                                aria-label="address" rows="5">{{ $customer->address }}</textarea>
                            @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label" style="font-size: 15px" for="referenced_by">Referenced By</label>
                            <input type="text" id="referenced_by" name="referenced_by"
                                class="form-control form-control-lg @error('referenced_by') is-invalid @enderror"
                                placeholder="Referenced By" aria-label="referenced_by"
                                value="{{ $customer->referenced_by }}" min="1" max="255" />
                            @error('referenced_by')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="divider divider-primary">
                        <div class="divider-text">Tenants</div>
                    </div>

                    <div class="row my-2">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h1>Tenants</h1>
                                <button class="btn btn-relief-outline-primary me-1" type="button" data-repeater-create>
                                    <i data-feather="plus" class="me-25"></i>
                                    <span>Add New</span>
                                </button>
                            </div>
                            <input type="hidden" id="tenant-count" name="tenant-count" value="0">

                            @php
                                $tenants = json_decode($customer->tenants) ?? [];
                            @endphp

                            <div data-repeater-list="tenants">
                                @forelse ($tenants as $key => $tenant)
                                    <div data-repeater-item>
                                        <div class="card shadow border-primary">
                                            <div class="card-header justify-content-end align-items-center">
                                                <button class="btn btn-relief-outline-danger text-nowrap px-1"
                                                    data-repeater-delete type="button">
                                                    <i data-feather="trash" class="me-25"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-3 col-md-3 col-sm-12">
                                                        <label class="form-label" style="font-size: 15px"
                                                            for="tenant_name">Tenant Name *</label>
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="tenant_name" name="tenants[{{ $key }}][tenant_name]" value="{{ $tenant->tenant_name }}"
                                                            aria-describedby="tenant_name" placeholder="Tenant Name" />
                                                    </div>
                                                    <div class="col-xl-4 col-lg-3 col-md-3 col-sm-12">
                                                        <label class="form-label" style="font-size: 15px"
                                                            for="tenant_phone">Tenant Phone</label>
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="tenant_phone" name="tenants[{{ $key }}][tenant_phone]" value="{{ $tenant->tenant_phone }}"
                                                            aria-describedby="tenant_phone" placeholder="Tenant Phone" />
                                                    </div>
                                                    <div class="col-xl-4 col-lg-3 col-md-3 col-sm-12">
                                                        <label class="form-label" style="font-size: 15px"
                                                            for="tenant_dob">DOB</label>
                                                        <input type="text" id="tenant_dob" name="tenants[{{ $key }}][tenant_dob]" value="{{ $tenant->tenant_dob }}"
                                                            class="form-control form-control-lg dob-human-friendly @error('tenant-dob') is-invalid @enderror"
                                                            placeholder="{{ now()->format('F j, Y') }}"
                                                            onfocus="openFlatPicker()" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-relief-outline-danger me-1">
                            <i data-feather='x-circle' class="me-25"></i>
                            <span>Reset</span>
                        </button>
                        <button type="submit" class="btn btn-relief-outline-primary">
                            <i data-feather='check-circle' class="me-25"></i>
                            <span>Upadte</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('PageJS')
    <script>
        function openFlatPicker(date) {
            $('.dob-human-friendly').flatpickr({
                altInput: !0,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
                minDate: '{{ now() }}',
                defaultDate: date,
            });
        }

        $(".tenants-form").repeater({
            // initEmpty: true,
            show: function() {
                $(this).slideDown();
                feather && feather.replace({
                    width: 14,
                    height: 14
                });
            },
            hide: function(e) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-relief-outline-danger me-1',
                        cancelButton: 'btn btn-relief-outline-primary me-1',
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).slideUp(e);
                    }
                });
            }
        });
    </script>
@endsection
