<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="name">Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Name" value="{{ isset($cabin_asset) ? $cabin_asset->name : old('name') }}"
                    minlength="3" maxlength="50" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter cabin type name.</small>
                    </p>
                @enderror
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="slug">Slug <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug" placeholder="Slug" value="{{ isset($cabin_asset) ? $cabin_asset->slug : old('slug') }}" readonly
                    minlength="3" maxlength="50" />
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter cabin type slug.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                <label class="switch switch-square">
                    <input type="hidden" name="installable" value="0" />
                    <input type="checkbox" name="installable" value="1" class="switch-input"
                        {{ (isset($cabin_asset) ? $cabin_asset->installable : old('installable')) ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Installable</span>
                </label>
                @error('installable')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Check if assets is installable.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                <label class="switch switch-square">
                    <input type="hidden" name="serviceable" value="0" />
                    <input type="checkbox" name="serviceable" value="1" class="switch-input"
                        {{ (isset($cabin_asset) ? $cabin_asset->serviceable : old('serviceable')) ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Serviceable</span>
                </label>
                @error('serviceable')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Check if assets is serviceable.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                <label class="switch switch-square">
                    <input type="hidden" name="expireable" value="0" />
                    <input type="checkbox" name="expireable" value="1" class="switch-input"
                        {{ (isset($cabin_asset) ? $cabin_asset->expireable : old('expireable')) ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Expireable</span>
                </label>
                @error('expireable')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Check if assets is expireable.</small>
                    </p>
                @enderror
            </div>
        </div>
    </div>
</div>
