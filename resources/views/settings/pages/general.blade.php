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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 position-relative">
                                <label class="form-label" style="font-size: 15px" for="app_name">App Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('app_name') is-invalid @enderror"
                                    id="app_name" name="app_name" placeholder="App Name" value="{{ settings('app_name') }}"
                                    minlength="3" maxlength="250" />
                                @error('app_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @else
                                    <p class="m-0">
                                        <small class="text-muted">Enter App Name.</small>
                                    </p>
                                @enderror
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
        @if (session()->has('toaster_success'))
            toastr.success('Settings Updated')
        @endif
    </script>
@endsection
