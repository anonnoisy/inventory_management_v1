@extends('pages.layouts.app')

@section('content')

<div class="section-header">
    <h1>Customer Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin::customer-manage::customer::home') }}">Customer Management</a></div>
        <div class="breadcrumb-item">Show or edit Customer</div>
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
    <h2 class="section-title">Customer, {{ $customer->firstname }}</h2>
    <p class="section-lead">Change information about customer data on this page.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card profile-widget">
                <div class="profile-widget-description">
                    <div class="card-header">
                        <h4>Edit Customer data</h4>
                        <form action="{{ route('admin::customer-manage::customer::status', [ $customer->id ]) }}" method="post" class="ml-auto">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="active" value="{{ $customer->active == 1 ? 0 : 1 }}">
                            @if ($customer->active == 1)
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title data-original-title="Inactivate this customer"><i class="fas fa-eye-slash"></i> </button>
                            @else
                                <button type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="top" title data-original-title="Activate this customer"><i class="fas fa-eye"></i> </button>
                            @endif
                        </form>
                    </div>
                    <form action="{{ route('admin::customer-manage::customer::update', [ $customer->id ]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="firstname">Firstname</label>
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $customer->firstname) }}" autofocus aria-describedby="firstnameHelp">
                                <small id="firstnameHelp" class="form-text text-danger">* This field is required</small>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="lastname">Lastname</label>
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $customer->lastname) }}" aria-describedby="LastnameHelp">
                                <small id="LastnameHelp" class="form-text text-muted">* This field is optional</small>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="number_id">Number ID</label>
                                <input id="number_id" type="number" min="0" class="form-control @error('number_id') is-invalid @enderror" name="number_id" value="{{ old('number_id', $customer->number_id) }}" aria-describedby="number_idHelp">
                                <small id="number_idHelp" class="form-text text-danger">* This field is required</small>

                                @error('number_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="phone">Phone Number</label>
                                <input id="phone" type="number" min="0" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $customer->phone) }}" aria-describedby="phoneHelp">
                                <small id="phoneHelp" class="form-text text-danger">* This field is required</small>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="email">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $customer->email) }}" aria-describedby="emailHelp">
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
                                <label for="postcode">Postcode</label>
                                <input id="postcode" type="postcode" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode', $customer->postcode) }}" aria-describedby="postcodeHelp">
                                <small id="postcodeHelp" class="form-text text-danger">* This field is required</small>

                                @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="address">Customer Address</label>
                                <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $customer->address) }}" aria-describedby="addressHelp">
                                <small id="addressHelp" class="form-text text-danger">* This field is required</small>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin::customer-manage::customer::home') }}" class="btn btn-danger btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Save a Customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection