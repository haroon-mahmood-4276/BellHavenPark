<div class="card">
    <div class="card-body">

        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <label class="form-label" style="font-size: 15px" for="cabin_type">Cabin Type</label>
                <select class="select2-size-lg form-select" id="cabin_type" name="cabin_type">
                    @foreach ($cabin_types as $cabinTypeRow)
                        @continue(isset($cabin) && $cabinTypeRow->id == $cabin->id)
                        <option data-icon="fa-solid fa-angle-right"
                            value="{{ $cabinTypeRow['id'] }}"{{ (isset($cabin) ? $cabin->cabin_type_id : old('cabin_type')) == $cabinTypeRow['id'] ? 'selected' : '' }}>
                            {{ $cabinTypeRow['name'] }}</option>
                    @endforeach
                </select>
                @error('cabin_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter cabin type.</small>
                    </p>
                @enderror
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                <label class="form-label" style="font-size: 15px" for="cabin_status">Cabin Status</label>
                <select class="select2-size-lg form-select" id="cabin_status" name="cabin_status">
                    @foreach ($cabin_statuses as $statusKey => $cabinStatusRow)
                        <option data-icon="fa-solid fa-angle-right"
                            {{ isset($cabin) && $cabin->cabin_status->value == $statusKey ? 'selected' : null }}
                            value="{{ $statusKey }}">{{ $cabinStatusRow['text'] }}</option>
                    @endforeach
                </select>
                @error('cabin_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter cabin status.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6 col-md-12 col-sm-6 position-relative">
                <label class="form-label" style="font-size: 15px" for="name">Cabin Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Name" value="{{ isset($cabin) ? $cabin->name : old('name') }}"
                    minlength="3" maxlength="50" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter cabin name.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 position-relative">
                <div class="{{ isset($cabin) && $cabin->cabin_status->value == 'closed_permanently' ? null : 'd-none' }}"
                    id="div_closed_permanent_till">
                    <label class="form-label" style="font-size: 15px" for="closed_permanent_till">Permanently Closed
                        Till <span class="text-danger"></span></label>

                    <input type="text" class="form-control @error('closed_permanent_till') is-invalid @enderror"
                        id="closed_permanent_till" placeholder="Permanently Closed Till"
                        value="{{ isset($cabin) ? \Carbon\Carbon::parse($cabin->closed_to)->format('F j, Y') : now()->format('F j, Y') }}" />

                    <input type="hidden" name="closed_permanent_till"
                        value="{{ isset($cabin) ? \Carbon\Carbon::parse($cabin->closed_to)->startOfDay()->timestamp : now()->startOfDay()->timestamp }}">
                    @error('closed_permanent_till')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <p class="m-0">
                            <small class="text-muted">Select the date until the cabin is closed permanently.</small>
                        </p>
                    @enderror
                </div>

                <div class="{{ isset($cabin) && $cabin->cabin_status->value == 'closed_temporarily' ? null : 'd-none' }}"
                    id="div_closed_temporarily_till">
                    <label class="form-label" style="font-size: 15px" for="closed_temporarily_till">Temporarily Closed
                        Till <span class="text-danger"></span></label>

                    <input type="text" class="form-control @error('closed_temporarily_till') is-invalid @enderror"
                        id="closed_temporarily_till" placeholder="Temporarily Closed Till"
                        value="{{ isset($cabin) ? \Carbon\Carbon::parse($cabin->closed_from)->format('F j, Y') : now()->format('F j, Y') }} - {{ isset($cabin)? \Carbon\Carbon::parse($cabin->closed_to)->format('F j, Y'): now()->addDay()->format('F j, Y') }}" />

                    <input type="hidden" name="closed_temporarily_till_from"
                        value="{{ isset($cabin) ? \Carbon\Carbon::parse($cabin->closed_from)->startOfDay()->timestamp : now()->startOfDay()->timestamp }}">
                    <input type="hidden" name="closed_temporarily_till_to"
                        value="{{ isset($cabin)? \Carbon\Carbon::parse($cabin->closed_to)->startOfDay()->timestamp: now()->addDay()->startOfDay()->timestamp }}">

                    @error('closed_temporarily_till')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <p class="m-0">
                            <small class="text-muted">Select the date range until the cabin is closed temporarily.</small>
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                <label class="form-label" style="font-size: 15px" for="daily_rate">Daily Rate <span
                        class="text-danger">*</span></label>
                <input type="number" class="form-control @error('daily_rate') is-invalid @enderror" id="daily_rate"
                    name="daily_rate" placeholder="Daily Rate"
                    value="{{ isset($cabin) ? $cabin->daily_rate : old('daily_rate') ?? '0' }}" min="0" />
                @error('daily_rate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter daily rate.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                <label class="form-label" style="font-size: 15px" for="weekly_rate">Weekly Rate <span
                        class="text-danger">*</span></label>
                <input type="number" class="form-control @error('weekly_rate') is-invalid @enderror"
                    id="weekly_rate" name="weekly_rate" placeholder="Weekly Rate"
                    value="{{ isset($cabin) ? $cabin->weekly_rate : old('weekly_rate') ?? '0' }}" min="0" />
                @error('weekly_rate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter weekly rate.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                <label class="form-label" style="font-size: 15px" for="monthly_rate">Monthly Rate <span
                        class="text-danger">*</span></label>
                <input type="number" class="form-control @error('monthly_rate') is-invalid @enderror"
                    id="monthly_rate" name="monthly_rate" placeholder="Monthly Rate"
                    value="{{ isset($cabin) ? $cabin->monthly_rate : old('monthly_rate') ?? '0' }}" min="0" />
                @error('monthly_rate')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter monthly rate.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                <label class="switch switch-square">
                    <input type="hidden" name="long_term" value="0" />
                    <input type="checkbox" name="long_term" value="1" class="switch-input"
                        {{ (isset($cabin) ? $cabin->long_term : old('long_term')) ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Long Term</span>
                </label>
                @error('long_term')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Check if it is long term.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 position-relative">
                <label class="switch switch-square">
                    <input type="hidden" name="electric_meter" value="0" />
                    <input type="checkbox" name="electric_meter" value="1" class="switch-input"
                        {{ (isset($cabin) ? $cabin->electric_meter : old('electric_meter')) ? 'checked' : '' }}>
                    <span class="switch-toggle-slider">
                        <span class="switch-on"><i class="ti ti-check"></i></span>
                        <span class="switch-off"><i class="ti ti-x"></i></span>
                    </span>
                    <span class="switch-label">Electric Meter</span>
                </label>
                @error('electric_meter')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Check if it has electric meter.</small>
                    </p>
                @enderror
            </div>
        </div>
    </div>
</div>
