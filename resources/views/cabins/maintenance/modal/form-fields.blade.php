<div class="row mb-3">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <label class="form-label" style="font-size: 15px" for="cabins">Cabins</label>
        <select class="select2-size-lg form-select" id="cabins" multiple name="cabins[]">
            @foreach ($cabins as $cabin)
                <option data-icon="fa-solid fa-angle-right" value="{{ $cabin['id'] }}"
                    {{ isset($cabinToRemove) && in_array($cabin['id'], $cabinToRemove) ? 'selected' : null }}>
                    {{ $cabin['name'] }} - {{ Str::of($cabin['cabin_status'])->headline() }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-lg-12 col-md-12 col-sm-12 position-relative">
        <label class="form-label" style="font-size: 15px" for="reason">Reason <span
                class="text-danger"></span></label>
        <textarea class="form-control" id="reason" name="reason" placeholder="ex. reason for under maintenance etc"
            rows="5"></textarea>
    </div>
</div>