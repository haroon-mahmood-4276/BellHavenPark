@extends('settings.index')

@section('page-title', 'General Settings')

@section('breadcrumbs')
    <div class="d-flex justify-content-start align-items-center mb-3">
        <h2 class="content-header-title float-start mb-0 mx-3">Settings</h2>
        {{ Breadcrumbs::render('settings.index') }}
    </div>
@endsection

@section('content')
    @parent

    <form class="form form-vertical" action="{{ route('settings.update') }}" method="POST" id="form-update-settings"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <input type="hidden" name="tab" value="{{ $tab }}">

        <div class="row g-3">
            <div class="col-lg-9 col-md-9 col-sm-12 position-relative">
                {{-- Electricity --}}
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="m-0"><i class="fa-solid fa-fire-flame-simple me-1"></i>Electricity</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="electricity_base_rate">Base Rate
                                    (kWh) <span class="text-danger">*</span></label>
                                <input type="number"
                                    class="form-control @error('electricity_base_rate') is-invalid @enderror"
                                    id="electricity_base_rate" name="electricity_base_rate" placeholder="Ex. 400"
                                    value="{{ settings('electricity_base_rate', 0) }}" min="0" />
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <label class="form-label" style="font-size: 15px" for="electricity_tax">ID
                                    Type</label>
                                <select class="select2-size-lg form-select" id="electricity_tax" name="electricity_tax">
                                    @foreach ($taxes as $tax)
                                        <option data-icon="fa-solid fa-angle-right" value="{{ $tax->id }}"
                                            {{ settings('electricity_tax', 0) == $tax->id ? 'selected' : null }}>
                                            {{ $tax->name }}</option>
                                    @endforeach
                                </select>
                                <p class="m-0">
                                    <small class="text-muted">Select tax.</small>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px"
                                    for="electricity_flat_rate_percentage">Flat Rate / Percentage <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text gap-2">
                                        <input type="hidden" value="0" name="electricity_is_percentage">
                                        <input type="checkbox" class="form-check-input m-0" value="1"
                                            id="electricity_is_percentage" name="electricity_is_percentage"
                                            {{ settings('electricity_is_percentage', 0) ? 'checked' : null }}>
                                        <label class="form-label m-0" for="electricity_is_percentage">(%)</label>
                                    </div>
                                    <input type="number" class="form-control" id="electricity_flat_rate_percentage"
                                        name="electricity_flat_rate_percentage" placeholder="Ex. 4%"
                                        value="{{ settings('electricity_flat_rate_percentage', 0) }}" min="0">
                                </div>
                                <p class="m-0">
                                    <small class="text-muted">Enter flat rate / percentage.</small>
                                </p>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="electricity_sac_rate">Flat Rate (per
                                    day) for SAC <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="electricity_sac_rate"
                                    name="electricity_sac_rate" placeholder="Ex. 4%"
                                    value="{{ settings('electricity_sac_rate', 0) }}" min="0">
                                <p class="m-0">
                                    <small class="text-muted">SAC Rate = Flat rate x No of booking days.</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gas --}}
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="m-0"><i class="fa-solid fa-droplet me-1"></i>Gas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="gas_base_rate">Base Rate
                                    (M<sup>3</sup>) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('gas_base_rate') is-invalid @enderror"
                                    id="gas_base_rate" name="gas_base_rate" placeholder="Ex. 400"
                                    value="{{ settings('gas_base_rate', 0) }}" min="0" />
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <label class="form-label" style="font-size: 15px" for="gas_tax">ID
                                    Type</label>
                                <select class="select2-size-lg form-select" id="gas_tax" name="gas_tax">
                                    @foreach ($taxes as $tax)
                                        <option data-icon="fa-solid fa-angle-right" value="{{ $tax->id }}"
                                            {{ settings('gas_tax', 0) == $tax->id ? 'selected' : null }}>
                                            {{ $tax->name }}</option>
                                    @endforeach
                                </select>
                                <p class="m-0">
                                    <small class="text-muted">Select tax.</small>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="gas_flat_rate_percentage">Flat
                                    Rate / Percentage <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text gap-2">
                                        <input type="hidden" value="0" name="gas_is_percentage">
                                        <input type="checkbox" class="form-check-input m-0" value="1"
                                            id="gas_is_percentage" name="gas_is_percentage"
                                            {{ settings('gas_is_percentage', 0) ? 'checked' : null }}>
                                        <label class="form-label m-0" for="gas_is_percentage">(%)</label>
                                    </div>
                                    <input type="number" class="form-control" id="gas_flat_rate_percentage"
                                        name="gas_flat_rate_percentage" placeholder="Ex. 4%"
                                        value="{{ settings('gas_flat_rate_percentage', 0) }}" min="0">
                                </div>
                                <p class="m-0">
                                    <small class="text-muted">Enter flat rate / percentage.</small>
                                </p>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="gas_sac_rate">Flat Rate (per
                                    day) for SAC <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="gas_sac_rate" name="gas_sac_rate"
                                    placeholder="Ex. 4%" value="{{ settings('gas_sac_rate', 0) }}" min="0">
                                <p class="m-0">
                                    <small class="text-muted">SAC Rate = Flat rate x No of booking days.</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Water --}}
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="m-0"><i class="fa-solid fa-plug-circle-bolt me-1"></i>Water</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="water_base_rate">Base Rate
                                    (M<sup>3</sup>) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('water_base_rate') is-invalid @enderror"
                                    id="water_base_rate" name="water_base_rate" placeholder="Ex. 400"
                                    value="{{ settings('water_base_rate', 0) }}" min="0" />
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <label class="form-label" style="font-size: 15px" for="water_tax">ID
                                    Type</label>
                                <select class="select2-size-lg form-select" id="water_tax" name="water_tax">
                                    @foreach ($taxes as $tax)
                                        <option data-icon="fa-solid fa-angle-right" value="{{ $tax->id }}"
                                            {{ settings('water_tax', 0) == $tax->id ? 'selected' : null }}>
                                            {{ $tax->name }}</option>
                                    @endforeach
                                </select>
                                <p class="m-0">
                                    <small class="text-muted">Select tax.</small>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="water_flat_rate_percentage">Flat
                                    Rate / Percentage <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text gap-2">
                                        <input type="hidden" value="0" name="water_is_percentage">
                                        <input type="checkbox" class="form-check-input m-0" value="1"
                                            id="water_is_percentage" name="water_is_percentage"
                                            {{ settings('water_is_percentage', 0) ? 'checked' : null }}>
                                        <label class="form-label m-0" for="water_is_percentage">(%)</label>
                                    </div>
                                    <input type="number" class="form-control" id="water_flat_rate_percentage"
                                        name="water_flat_rate_percentage" placeholder="Ex. 4%"
                                        value="{{ settings('water_flat_rate_percentage', 0) }}" min="0">
                                </div>
                                <p class="m-0">
                                    <small class="text-muted">Enter flat rate / percentage.</small>
                                </p>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="water_sac_rate">Flat Rate (per
                                    day) for SAC <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="water_sac_rate" name="water_sac_rate"
                                    placeholder="Ex. 4%" value="{{ settings('water_sac_rate', 0) }}" min="0">
                                <p class="m-0">
                                    <small class="text-muted">SAC Rate = Flat rate x No of booking days.</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 position-relative">
                <div class="sticky-md-top top-lg-100px top-md-100px top-sm-0px" style="z-index: auto;">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success w-100 buttonToBlockUI me-1">
                                        <i class="fa-solid fa-floppy-disk icon me-2"></i>
                                        Update Setting
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <h4 class="alert-heading"><i data-feather="info" class="me-50"></i>Information!</h4>
                                <div class="alert-body">
                                    <span class="text-danger">*</span> means required field. <br>
                                    <span class="text-danger">**</span> means required field and must be unique.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>





@endsection

@section('custom-js')
    <script>
        $('#btn-update-settings').on('click', function() {
            $('#form-update-settings').submit();
        });

        $(".select2-size-lg").each(function() {
            var e = $(this);
            e.wrap('<div class="position-relative"></div>');
            e.select2({
                dropdownAutoWidth: !0,
                dropdownParent: e.parent(),
                width: "100%",
                containerCssClass: "select-lg",
                templateResult: function(e) {
                    return e.text
                },
                templateSelection: function(e) {
                    return e.text
                },
                escapeMarkup: function(taxes) {
                    return taxes
                }
            });
        });

        @if (session()->has('toaster_success'))
            toastr.success('Settings Updated')
        @endif
    </script>
@endsection
