@props([
    'id',
    'name',
    'value' => null,
    'disabled' => false,
    'required' => false,
    'withLabel' => true,
    'helpText' => null,
    'type' => 'text',
])

@php
    $inputName = $name ?? $id;
    $label = Str::of($inputName)->ucfirst();
    $inputPlaceholder = $placeholder ?? Str::of($inputName)->ucfirst();
@endphp

<div>
    @if ($withLabel)
        <label class="form-label" style="font-size: 15px" for="{{ $id }}">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $id }}" name="{{ $inputName }}"
        placeholder="{{ $inputPlaceholder }}" @if (!is_null($value)) value="{{ $value }}" @endif
        {{ $attributes->merge(['class' => 'form-control']) }} @required($required) @disabled($disabled) />

    @error($inputName)
        <div class="invalid-feedback">{{ $message }}</div>
    @elseif (!is_null($helpText))
        <p class="m-0">
            <small class="text-muted">{{ $helpText }}</small>
        </p>
    @enderror
</div>
