<div class="card">
    <div class="card-body">

        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="first_name">First Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                    name="first_name" placeholder="First Name"
                    value="{{ isset($customer) ? $customer->first_name : old('first_name') }}" minlength="3"
                    maxlength="50" />
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's first name.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="last_name">Last Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                    name="last_name" placeholder="Last Name"
                    value="{{ isset($customer) ? $customer->last_name : old('last_name') }}" minlength="3"
                    maxlength="50" />
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's last name.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="email">Email <span
                        class="text-danger"></span></label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Email" value="{{ isset($customer) ? $customer->email : old('email') }}"
                    minlength="3" maxlength="250" />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's email.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="dob">Date of birth <span
                        class="text-danger"></span></label>
                <input type="text" class="form-control @error('dob') is-invalid @enderror" id="dob"
                    name="dob" placeholder="Date of birth"
                    value="{{ (isset($customer) ? Carbon\Carbon::parse($customer->dob)->format('F j, Y') : old('dob')) ?? now()->subYears(1)->format('F j, Y') }}"
                    minlength="3" maxlength="50" />
                @error('dob')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Select customer's date of birth.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="phone">Mobile <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    name="phone" placeholder="Mobile" value="{{ isset($customer) ? $customer->phone : old('phone') }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" min="1" max="20" />
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's mobile.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="telephone">Telephone <span
                        class="text-danger"></span></label>
                <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone"
                    name="telephone" placeholder="Telephone"
                    value="{{ isset($customer) ? $customer->telephone : old('telephone') }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" min="1" max="20" />
                @error('telephone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's telephone.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <label class="form-label" style="font-size: 15px" for="international_id">ID Type</label>
                <select class="select2-size-lg form-select" id="international_id" name="international_id">
                    @foreach ($international_ids as $InternationalIdRow)
                        @continue(isset($customer) && $InternationalIdRow->id == $customer->id)
                        <option data-icon="fa-solid fa-angle-right"
                            value="{{ $InternationalIdRow['id'] }}"{{ (isset($customer) ? $customer->international_id_id : old('international_id')) == $InternationalIdRow['id'] ? 'selected' : '' }}>
                            {{ $InternationalIdRow['name'] }}</option>
                    @endforeach
                </select>
                @error('international_id.id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Select Id.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="international_details">ID Details <span
                        class="text-danger"></span></label>
                <input type="text" class="form-control @error('international_details') is-invalid @enderror"
                    id="international_details" name="international_details" placeholder="ID Details"
                    value="{{ isset($customer) ? $customer->international_details : old('international_details') }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="3" maxlength="250" />
                @error('international_details')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's ID details.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="international_address">ID Address <span
                        class="text-danger"></span></label>
                <input type="text" class="form-control @error('international_address') is-invalid @enderror"
                    id="international_address" name="international_address" placeholder="Mobile"
                    value="{{ isset($customer) ? $customer->international_address : old('international_address') }}"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" minlength="3" maxlength="250" />
                @error('international_address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's ID address.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <label class="form-label" style="font-size: 15px" for="comments">Comments</label>
                <textarea type="text" id="comments" name="comments" class="form-control @error('comments') is-invalid @enderror"
                    placeholder="Comments" aria-label="comments" rows="5" minlength="3" maxlength="250">{{ isset($customer) ? $customer->comments : old('comments') }}</textarea>
                @error('comments')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's comments.</small>
                    </p>
                @enderror
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <label class="form-label" style="font-size: 15px" for="address">Address </label>
                <textarea type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror"
                    placeholder="Address" aria-label="address" rows="5" minlength="3" maxlength="250">{{ isset($customer) ? $customer->address : old('address') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter customer's comments.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-12 col-md-12 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="referenced_by">Referenced By <span
                        class="text-danger"></span></label>
                <input type="text" class="form-control @error('referenced_by') is-invalid @enderror"
                    id="referenced_by" name="referenced_by" placeholder="Referenced By"
                    value="{{ isset($customer) ? $customer->referenced_by : old('referenced_by') }}" minlength="3"
                    maxlength="250" />
                @error('referenced_by')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter reference.</small>
                    </p>
                @enderror
            </div>
        </div>

        {{-- <div class="divider divider-primary">
            <div class="divider-text" style="font-size: 15px">Tenants</div>
        </div>

        <div class="row mb-3">
            <div class="col-12 position-relative">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h2>Tenants</h2>
                </div>
                <div class="form-repeater">
                    <div data-repeater-list="tenants">

                        @forelse ($customer->tenants ?? [] as $tenant)
                            <div data-repeater-item>
                                <div class="row mb-3">
                                    <div class="col-xl-6 col-lg-6 col-12 position-relative">
                                        <label class="form-label" style="font-size: 15px"
                                            for="tenant_first_name">Tenant First
                                            Name
                                            <span class="text-danger"></span></label>
                                        <input type="text"
                                            class="form-control @error('tenant_first_name') is-invalid @enderror"
                                            id="tenant_first_name"
                                            name="tenants[{{ $loop->index }}][tenant_first_name]"
                                            placeholder="Tenant First Name"
                                            value="{{ $tenant['tenant_first_name'] ?? '' }}" minlength="3"
                                            maxlength="50" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 position-relative">
                                        <label class="form-label" style="font-size: 15px"
                                            for="tenant_last_name">Tenant Last
                                            Name
                                            <span class="text-danger"></span></label>
                                        <input type="text"
                                            class="form-control @error('tenant_last_name') is-invalid @enderror"
                                            id="tenant_last_name"
                                            name="tenants[{{ $loop->index }}][tenant_last_name]"
                                            placeholder="Tenant Last Name" value="{{ $tenant['tenant_last_name'] ?? '' }}"
                                            minlength="3" maxlength="50" />
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-12 position-relative">
                                        <label class="form-label" style="font-size: 15px" for="tenant_phone">Tenant
                                            Mobile
                                            <span class="text-danger"></span></label>
                                        <input type="text"
                                            class="form-control @error('tenant_phone') is-invalid @enderror"
                                            id="tenant_phone" name="tenants[{{ $loop->index }}][tenant_phone]"
                                            placeholder="Tenant Mobile" value="{{ $tenant['tenant_phone'] }}"
                                            min="1" max="20"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                    </div>
                                    <div class="col-xl-5 col-lg-6 col-12 position-relative">
                                        <label class="form-label" style="font-size: 15px" for="tenant_dob">Date of
                                            birth <span class="text-danger"></span></label>
                                        <input type="text"
                                            class="form-control @error('tenant_dob') is-invalid @enderror"
                                            id="tenant_dob" name="tenants[{{ $loop->index }}][tenant_dob]"
                                            placeholder="Date of birth"
                                            value="{{ Carbon\Carbon::parse($tenant['tenant_dob'])->format('F j, Y') }}"
                                            minlength="3" maxlength="50" />
                                    </div>
                                    <div class="col-xl-2 col-lg-12 col-12 d-flex align-items-center">
                                        <button class="btn btn-label-danger mt-4" type="button" data-repeater-delete>
                                            <i class="ti ti-x ti-xs me-1"></i>
                                            <span class="align-middle">Delete</span>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @empty
                            <div data-repeater-item>
                                <div class="row mb-3">
                                    <div class="col-xl-6 col-lg-6 col-12 position-relative">
                                        <label class="form-label" style="font-size: 15px"
                                            for="tenant_first_name">Tenant First
                                            Name
                                            <span class="text-danger"></span></label>
                                        <input type="text"
                                            class="form-control @error('tenant_first_name') is-invalid @enderror"
                                            id="tenant_first_name" name="tenant_first_name"
                                            placeholder="Tenant First Name" minlength="3" maxlength="50" />
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 position-relative">
                                        <label class="form-label" style="font-size: 15px"
                                            for="tenant_last_name">Tenant
                                            Last Name
                                            <span class="text-danger"></span></label>
                                        <input type="text"
                                            class="form-control @error('tenant_last_name') is-invalid @enderror"
                                            id="tenant_last_name" name="tenant_last_name"
                                            placeholder="Tenant Last Name" minlength="3" maxlength="50" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-12 position-relative">
                                        <label class="form-label" style="font-size: 15px" for="tenant_phone">Tenant
                                            Mobile
                                            <span class="text-danger"></span></label>
                                        <input type="text"
                                            class="form-control @error('tenant_phone') is-invalid @enderror"
                                            id="tenant_phone" name="tenant_phone" placeholder="Tenant Mobile"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '');" min="1"
                                            max="20" />
                                    </div>
                                    <div class="col-xl-5 col-lg-6 col-12 position-relative">
                                        <label class="form-label" style="font-size: 15px" for="tenant_dob">Date of
                                            birth
                                            <span class="text-danger"></span></label>
                                        <input type="text"
                                            class="form-control @error('tenant_dob') is-invalid @enderror"
                                            id="tenant_dob" name="tenant_dob" placeholder="Date of birth"
                                            minlength="3" maxlength="50" />
                                    </div>
                                    <div class="col-xl-2 col-lg-12 col-12 d-flex align-items-center">
                                        <button class="btn btn-label-danger mt-4" type="button" data-repeater-delete>
                                            <i class="ti ti-x ti-xs me-1"></i>
                                            <span class="align-middle">Delete</span>
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <button class="btn btn-primary me-1" type="button" data-repeater-create>
                                <i class="fa-solid fa-plus icon me-2"></i>
                                <span>Add New</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
</div>
