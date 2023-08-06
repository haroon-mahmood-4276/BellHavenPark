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

    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.update') }}" method="POST" id="form-update-settings">

                @csrf
                @method('PUT')

                <input type="hidden" name="tab" value="{{ $tab }}">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                        <label class="form-label" style="font-size: 15px" for="app_name">App Name <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('app_name') is-invalid @enderror" id="app_name"
                            name="app_name" placeholder="App Name" value="{{ settings('app_name') }}" minlength="3"
                            maxlength="250" />
                        @error('app_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <p class="m-0">
                                <small class="text-muted">Enter App Name.</small>
                            </p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <div>
                <button type="button" id="btn-update-settings" class="btn btn-success me-1">
                    <i class="fa-solid fa-floppy-disk icon me-2"></i>
                    Update Setting
                </button>

                <a href="{{ route('roles.index') }}" class="btn btn-danger">
                    <i class="fa-solid fa-xmark icon me-2"></i>
                    Cancel
                </a>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        $('#btn-update-settings').on('click', function() {
            $('#form-update-settings').submit();
        });
    </script>
@endsection
