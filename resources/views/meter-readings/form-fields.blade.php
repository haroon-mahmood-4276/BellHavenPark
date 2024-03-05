{{-- <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 position-relative">
                <div data-repeater-list="meter_readings">
                    <div data-repeater-item>
                        <div class="d-flex border rounded position-relative pe-0 mb-3">
                            <div class="row w-100 m-2">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                                    <label class="form-label" for="meter-readings-1-1">Cabin</label>
                                    <select id="meter-readings-1-1" class="select2 form-select" name="cabin_id" data-placeholder="Select Cabin">
                                        @forelse ($cabins as $cabin)
                                            <option value="{{ $cabin->id }}">{{ $cabin->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('cabin_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <p class="m-0">
                                            <small class="text-muted">Select Cabin.</small>
                                        </p>
                                    @enderror
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                                    <label class="form-label" for="meter-readings-1-1">Meter</label>
                                    <select id="meter-readings-1-2" class="select2 form-select" name="meter_type" data-placeholder="Select Meter">
                                        @forelse ($meter_types as $name => $type)
                                            <option value="{{ $type }}">{{ $name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <p class="m-0">
                                        <small class="text-muted">Select Meter.</small>
                                    </p>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                                    <label class="form-label" style="font-size: 15px" for="reading">Reading <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('reading') is-invalid @enderror"
                                        id="reading" min="0" name="reading" value="0" />
                                    @error('reading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @else
                                        <p class="m-0">
                                            <small class="text-muted">Enter reading.</small>
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                <i class="fa-solid fa-xmark cursor-pointer" data-repeater-delete=""></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-end">
                            <button class="btn btn-primary me-1" type="button" data-repeater-create>
                                <i class="fa-solid fa-plus icon me-2"></i>
                                <span>Add another reading</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" for="cabin_id">Cabin</label>
                <select id="cabin_id" class="select2 form-select" name="cabin_id" data-placeholder="Select Cabin" required>
                    @if (isset($meterReading))
                        <option value="{{ $cabin->id }}">{{ $cabin->name }}</option>
                    @endif
                </select>
                @error('cabin_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Select Cabin.</small>
                    </p>
                @enderror
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" for="meter_type">Meter</label>
                <select id="meter_type" class="select2 form-select" name="meter_type" data-placeholder="Select Meter">
                    @forelse ($meter_types as $name => $type)
                        <option value="{{ $type }}"  selected="selected">{{ $name }}</option>
                    @empty
                    @endforelse
                </select>
                <p class="m-0">
                    <small class="text-muted">Select Meter.</small>
                </p>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="reading">Reading <span
                        class="text-danger">*</span></label>
                <input type="number" class="form-control @error('reading') is-invalid @enderror" id="reading"
                    min="0" name="reading" value="0" />
                @error('reading')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter reading.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <label class="form-label" style="font-size: 15px" for="comments">Comments</label>
                <textarea id="comments" name="comments" class="form-control" placeholder="Comments" aria-label="comments"
                    rows="5"></textarea>
            </div>
        </div>
    </div>
</div>
