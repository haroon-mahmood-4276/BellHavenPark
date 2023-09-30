<div class="card">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="name">Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Name"
                    value="{{ isset($booking_tax) ? $booking_tax->name : old('name') }}" minlength="3"
                    maxlength="50" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter booking tax name.</small>
                    </p>
                @enderror
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="amount">Amount <span
                        class="text-danger">*</span></label>
                <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                    name="amount" placeholder="Amount" min="0" max="100"
                    value="{{ isset($booking_tax) ? $booking_tax->amount : old('amount') }}"/>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter booking tax amount.</small>
                    </p>
                @enderror
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="amount">&nbsp;</label>
                <div class="form-check">
                    <input type="hidden" value="0" name="is_flat">
                    <input class="form-check-input" type="checkbox" value="1" {{ (isset($booking_tax) ? $booking_tax->is_flat : old('is_flat')) ? 'checked' : null }} id="is_flat" name="is_flat">
                    <label class="form-check-label" for="is_flat">Is flat rate <span
                        class="text-danger">*</span></label>
                  </div>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Is booking amount a flat rate or percentage(unchecked).</small>
                    </p>
                @enderror
            </div>
        </div>
    </div>
</div>
