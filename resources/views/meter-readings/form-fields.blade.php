<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 position-relative">
                <label class="form-label" for="cabin_id">Cabin</label>
                <select id="cabin_id" class="select2 form-select @error('cabin_id') is-invalid @enderror" name="cabin_id"
                    @disabled(isset($meterReading)) data-placeholder="Select Cabin">

                    @if (old('cabin_id'))
                        <option value="{{ old('cabin_id') }}" selected></option>
                    @elseif (isset($meterReading))
                        <option value="{{ $meterReading->cabin_id }}">{{ $meterReading->cabin->name }}</option>
                    @endif
                </select>
                @error('cabin_id')
                    <p class="m-0">
                        <small class="text-danger">{{ $message }}</small>
                    </p>
                @else
                    <p class="m-0">
                        <small class="text-muted">Select Cabin.</small>
                    </p>
                @enderror
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 position-relative">
                <label class="form-label" for="meter_type">Meter</label>
                <select id="meter_type" class="select2 form-select" name="meter_type" data-placeholder="Select Meter">
                    @forelse ($meter_types as $name => $type)
                        <option value="{{ $type }}" @selected(isset($meterReading) ? $meterReading->meter_type->value === $type : false)>{{ $name }}</option>
                    @empty
                    @endforelse
                </select>
                <p class="m-0">
                    <small class="text-muted">Select Meter.</small>
                </p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 position-relative">
                <label class="form-label d-flex justify-content-between" style="font-size: 15px" for="previous_reading">
                    <span>Previous Reading</span>
                    <span id="span_previous_reading_date"
                        class="text-primary">{{ isset($previous_reading) ? Carbon\Carbon::parse($previous_reading->reading_date)->format('F j, Y') : 'N/A' }}</span>
                </label>
                <input type="number" id="previous_reading" class="payment_dates form-control"
                    placeholder="Previous Reading" aria-label="Previous Reading" @disabled(true)
                    value="{{ isset($previous_reading) ? $previous_reading->reading : 0 }}" />
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="reading">Reading
                    <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('reading') is-invalid @enderror" id="reading"
                    min="0" name="reading"
                    value="{{ isset($meterReading) ? $meterReading->reading : old('reading') ?? 0 }}" />
                @error('reading')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter reading.</small>
                    </p>
                @enderror
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 position-relative">
                <label class="form-label d-flex justify-content-between" style="font-size: 15px" for="reading_date">
                    <span>Reading Date</span>
                </label>
                <input type="text" id="reading_date" class="form-control" placeholder="Reading Date"
                    aria-label="Reading Date"
                    value="{{ isset($meterReading) ? Carbon\Carbon::parse($meterReading->reading_date)->format('F d, Y') : now()->format('F d, Y') }}"
                    name="reading_date" />
                <p class="m-0">
                    <small class="text-muted">Enter reading date.</small>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label class="form-label" style="font-size: 15px" for="comments">Comments</label>
                <textarea id="comments" name="comments" class="form-control" placeholder="Comments" aria-label="comments"
                    rows="5">{{ isset($meterReading) ? $meterReading->comments : old('comments') }}</textarea>
            </div>
        </div>
    </div>
</div>
