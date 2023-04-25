@extends('layout.layout')

@section('title', 'Add New Payment Method')

@section('PageCSS')
@endsection

@section('content-header')
    <div class="content-header row my-1">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Add New Payment Method</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('payment_methods.index') }}">Payment Method</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Add New Payment Method</a>
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
                <form action="{{ route('payment_methods.store') }}" method="POST">
                    @csrf

                    {{ view('paymentmethods.form_fields') }}

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
                </form>
            </div>
        </div>
    </div>
@endsection
