@extends('pages.layouts.app')

@section('content')

<div class="section-header">
    <h1>User Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin::user-manage::home') }}">Admin Management</a></div>
        <div class="breadcrumb-item">Create new admin</div>
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
    <h2 class="section-title">Admin Management</h2>
    <p class="section-lead">You can manipulate user admin data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create new admin user</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin::user-manage::store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="firstname">First Name</label>
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="lastname">Last Name</label>
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}">

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password" class="form-control pwstrength @error('password') is-invalid @enderror" value="{{ old('password') }}" data-indicator="pwindicator" name="password">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="password-confirm" class="d-block">Password Confirmation</label>
                                <input id="password-confirm" type="password" class="form-control" {{ old('password_confirmation') }} name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-divider">Your Home</div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Country</label>
                                <select class="form-control selectric @error('country') is-invalid @enderror" value="{{ old('country') }}" name="country">
                                    <option value="indonesia">Indonesia</option>
                                    <option value="palestine">Palestine</option>
                                    <option value="syria">Syria</option>
                                    <option value="malaysia">Malaysia</option>
                                    <option value="thailand">Thailand</option>
                                </select>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Province</label>
                                <select class="form-control selectric @error('province') is-invalid @enderror" value="{{ old('province') }}" name="province">
                                    <option value="west java">West Java</option>
                                    <option value="east java">East Java</option>
                                </select>

                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Postal Code</label>
                                <input type="text" class="form-control @error('postalcode') is-invalid @enderror" value="{{ old('postalcode') }}" name="postalcode">

                                @error('postalcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin::user-manage::home') }}" class="btn btn-danger btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection