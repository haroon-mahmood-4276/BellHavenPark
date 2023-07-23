<div class="card">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="name">Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Name" value="{{ isset($booking_source) ? $booking_source->name : old('name') }}"
                    minlength="3" maxlength="50" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter booking source name.</small>
                    </p>
                @enderror
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="slug">Slug <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug" placeholder="Slug" value="{{ isset($booking_source) ? $booking_source->slug : old('slug') }}" readonly
                    minlength="3" maxlength="50" />
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Booking source slug.</small>
                    </p>
                @enderror
            </div>
        </div>

        <div class="row mb-1">
            <div class="col-lg-12 col-md-12 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="description">Description <span
                        class="text-danger"></span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    placeholder="Description" rows="5" minlength="3" maxlength="50" />{{ isset($booking_source) ? $booking_source->description : old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter booking source description.</small>
                    </p>
                @enderror
            </div>
        </div>
    </div>
</div>
