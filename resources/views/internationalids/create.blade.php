@extends('layout.layout')

@section('title', 'Add New ID')

@section('content-header')
	<div class="content-header row my-1">
		<div class="content-header-left col-md-9 col-12 mb-2">
			<div class="row breadcrumbs-top">
				<div class="col-12">
					<h2 class="content-header-title float-start mb-0">Add New ID</h2>
					<div class="breadcrumb-wrapper">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item"><a href="{{ route('internationalids.index') }}">International IDs</a>
							</li>
							<li class="breadcrumb-item active"><a href="javascript:void(0);">Add New ID</a>
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('content')
	<div class="content-body">
		<div class="card">
			<div class="card-body">
				<form action="{{ route('internationalids.store') }}" method="POST">
					@csrf
					{{-- <div class="row">
						<div class="col-12"> --}}
					<div class="mb-1">
						<label class="form-label" style="font-size: 15px" for="first-name-icon">Name *</label>
						<input type="text" id="name" name="name"
						       class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="ID Name"
						       aria-label="ID Name" value="{{ old('name') }}" minlength="3" maxlength="50" />
						@error('name')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
                    </div>
                    {{-- </div> --}}
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-relief-outline-danger me-1">
                            <i data-feather='x-circle' class="me-25"></i>
                            <span>Reset</span>
                        </button>
                        <button type="submit" class="btn btn-relief-outline-primary">
                            <i data-feather='check-circle' class="me-25"></i>
                            <span>Save</span>
                        </button>
                    </div>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
@endsection
