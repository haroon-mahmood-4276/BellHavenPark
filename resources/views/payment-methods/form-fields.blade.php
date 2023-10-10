<div class="card">
    <div class="card-body">
        <div class="row mb-1">
            <div class="col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="name">Name <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="Name" value="{{ isset($paymentMethod) ? $paymentMethod->name : old('name') }}"
                    minlength="3" maxlength="50" />
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
                    name="slug" placeholder="Slug" value="{{ isset($paymentMethod) ? $paymentMethod->slug : old('slug') }}" readonly
                    minlength="3" maxlength="50" />
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Payment method slug.</small>
                    </p>
                @enderror
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 position-relative">
                <label class="form-label" style="font-size: 15px" for="amount">&nbsp;</label>
                <div class="form-check">
                    <input type="hidden" value="0" name="is_linked_with_credit_account">
                    <input class="form-check-input" type="checkbox" value="1"
                        {{ (isset($paymentMethod) ? $paymentMethod->is_linked_with_credit_account : old('is_linked_with_credit_account')) ? 'checked' : null }}
                        id="is_linked_with_credit_account" name="is_linked_with_credit_account">
                    <label class="form-check-label" for="is_linked_with_credit_account">Is this methods linked with credit account<span
                            class="text-danger">*</span></label>
                </div>
                @error('amount')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <p class="m-0">
                        <small class="text-muted">Check if this methods will be used for credit account.</small>
                    </p>
                @enderror
            </div>
        </div>
    </div>
</div>
