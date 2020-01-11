@extends('pages.layouts.app')

@section('content')

<div class="section-header">
    <h1>Vendors Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin::product-manage::vendor::home') }}">Vendor Management</a></div>
        <div class="breadcrumb-item">Show or edit vendor</div>
    </div>
</div>

{{-- show message after clicked update --}}
@if (session('status'))
<div class="alert alert-success">
    <button class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
    <div class="alert-title">Success</div>
    {{ session('status') }}
    </div>
@endif

<div class="section-body">
    <h2 class="section-title">Vendor, {{ $vendor->vendor_name }}</h2>
    <p class="section-lead">Change information about vendor data on this page.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card profile-widget">
                <div class="profile-widget-description">
                    <div class="card-header">
                        <h4>Edit vendor data</h4>
                        <form action="{{ route('admin::product-manage::vendor::status', [ $vendor->id ]) }}" method="post" class="ml-auto">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="active" value="{{ $vendor->active == 1 ? 0 : 1 }}">
                            @if ($vendor->active == 1)
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title data-original-title="Inactivate this vendor"><i class="fas fa-eye-slash"></i> </button>
                            @else
                                <button type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="top" title data-original-title="Activate this vendor"><i class="fas fa-eye"></i> </button>
                            @endif
                        </form>
                    </div>
                    <form action="{{ route('admin::product-manage::vendor::update', [ $vendor->id ]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="vendor_name">Vendor Name</label>
                                <input id="vendor_name" type="text" class="form-control @error('vendor_name') is-invalid @enderror" name="vendor_name" value="{{ old('vendor_name', $vendor->vendor_name) }}" autofocus aria-describedby="vendorNameHelp">
                                <small id="vendorNameHelp" class="form-text text-danger">* This field is required</small>

                                @error('vendor_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $vendor->email) }}" aria-describedby="emailHelp">
                                <small id="emailHelp" class="form-text text-danger">* This field is required</small>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="mobile">Mobile</label>
                                <input id="mobile" type="number" min="0" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile', $vendor->mobile) }}" aria-describedby="mobileHelp">
                                <small id="mobileHelp" class="form-text text-danger">* This field is required</small>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">Phone Number</label>
                                <input id="phone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $vendor->phone) }}" aria-describedby="phoneHelp">
                                <small id="phoneHelp" class="form-text text-danger">* This field is required</small>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="address">Address</label>
                                <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $vendor->address) }}" aria-describedby="addressHelp">
                                <small id="addressHelp" class="form-text text-danger">* This field is required</small>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="description">Description</label>
                                <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', $vendor->description) }}">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin::product-manage::vendor::home') }}" class="btn btn-danger btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Save a vendor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection