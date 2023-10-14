<div class="card">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="name">Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Name"
                    value="{{ isset($paymentMethod) ? $paymentMethod->name : old('name') }}" minlength="3"
                    maxlength="50" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Enter payment method name.</small>
                    </p>
                @enderror
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="slug">Slug <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                    name="slug" placeholder="Slug"
                    value="{{ isset($paymentMethod) ? $paymentMethod->slug : old('slug') }}" readonly minlength="3"
                    maxlength="50" />
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Payment method slug.</small>
                    </p>
                @enderror
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="linked_account">Linked Account</label>
                <select class="select2-size-lg form-select @error('linked_account') is-invalid @enderror"
                    id="linked_account" name="linked_account">
                    <option data-icon="fa-solid fa-angle-right" value="">Select Account</option>
                    @foreach ($linked_accounts as $key => $account)
                        <option data-icon="fa-solid fa-angle-right"
                            {{ isset($paymentMethod) && !is_null($paymentMethod->linked_account) && $paymentMethod->linked_account->value == $key ? 'selected' : null }}
                            value="{{ $key }}">{{ $account['text'] }}</option>
                    @endforeach
                </select>
                @error('linked_account')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Select linked customer account.</small>
                    </p>
                @enderror
            </div>

        </div>
    </div>
</div>
