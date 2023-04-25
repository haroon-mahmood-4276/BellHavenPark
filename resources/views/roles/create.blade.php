@extends('layout.layout')

@section('title', 'Add New Role')

@section('content-header')
	<div class="content-header row my-1">
		<div class="content-header-left col-md-9 col-12 mb-2">
			<div class="row breadcrumbs-top">
				<div class="col-12">
					<h2 class="content-header-title float-start mb-0">Add New Role</h2>
					<div class="breadcrumb-wrapper">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a>
							</li>
							<li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a>
							</li>
							<li class="breadcrumb-item active"><a href="javascript:void(0);">Add New Role</a>
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
				<form action="{{ route('roles.store') }}" method="POST">
					@csrf
					{{-- <div class="row">
						<div class="col-12"> --}}
					<div class="mb-1">
						<label class="form-label" style="font-size: 15px" for="first-name-icon">Role
							Name</label>
						<input type="text" id="role_name" name="role_name"
						       class="form-control form-control-lg @error('role_name') is-invalid @enderror" placeholder="Role Name"
						       aria-label="Role Name" value="{{ old('role_name') }}" min="3" max="250" />
						@error('role_name')
						<span class="invalid-feedback">{{ $message }}</span>
						@enderror
                    </div>
                    <div class="row mb-1">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-relief-outline-primary me-1">Save</button>
                            <button type="reset" class="btn btn-relief-outline-danger">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
