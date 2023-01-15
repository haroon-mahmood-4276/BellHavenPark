<div class="mb-1">
    <label class="form-label" style="font-size: 15px" for="payment-method-name">Name *</label>
    <input type="text" id="payment-method-name" name="name"
        class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Payment Method Name"
        aria-label="ID Name" value="{{ isset($paymentMethod) ? $paymentMethod->name : old('name') }}" minlength="3" maxlength="50" />
    @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
