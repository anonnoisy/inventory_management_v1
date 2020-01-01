@extends('pages.layouts.app')

@section('content')

<div class="section-header">
  <h1>Profile</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="{{ route('admin::home') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Profile</div>
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
  <h2 class="section-title">Hi, {{ $user_profile_information->firstname }}</h2>
  <p class="section-lead">
    Change information about yourself on this page.
  </p>

  <div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card profile-widget">
        <div class="profile-widget-header">
          <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
          <div class="profile-widget-items">
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">Posts</div>
              <div class="profile-widget-item-value">187</div>
            </div>
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">Followers</div>
              <div class="profile-widget-item-value">6,8K</div>
            </div>
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">Following</div>
              <div class="profile-widget-item-value">2,1K</div>
            </div>
          </div>
        </div>
        <div class="profile-widget-description">
          <form method="post" action="{{ route('admin::profile-update') }}" class="needs-validation" novalidate="">
            @method('PUT')
            @csrf
            <div class="card-header">
              <h4>Edit Profile</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6 col-12">
                  <label>First Name</label>
                  <input type="text" id="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user_profile_information->firstname }}" required="">
                  <p id="firstname_error"></p>
                  
                  @error('firstname')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group col-md-6 col-12">
                  <label>Last Name</label>
                  <input type="text" id="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user_profile_information->lastname }}" required="">
                  <p id="lastname_error"></p>
  
                  @error('lastname')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-7 col-12">
                  <label>Email</label>
                  <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user_profile_information->email }}" required="">
                  <p id="email_error"></p>
  
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group col-md-5 col-12">
                  <label>Phone</label>
                  <input type="tel" class="form-control" value="">
                </div>
              </div>
              <div class="form-divider">Your Home</div>
              <div class="row">
                <div class="form-group col-6">
                  <label>Country</label>
                  <select class="form-control selectric @error('country') is-invalid @enderror" value="{{ $user_profile_information->country }}" name="country">
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
                  <select class="form-control selectric @error('province') is-invalid @enderror" value="{{ $user_profile_information->province }}" name="province">
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
                  <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user_profile_information->city }}">

                  @error('city')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="form-group col-6">
                  <label>Postal Code</label>
                  <input type="text" class="form-control @error('postalcode') is-invalid @enderror" value="{{ $user_profile_information->postalcode }}" name="postalcode">

                  @error('postalcode')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
        <div class="card-footer text-center">
          <a href="#" class="btn btn-social-icon btn-facebook mr-1">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="btn btn-social-icon btn-twitter mr-1">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="btn btn-social-icon btn-github mr-1">
            <i class="fab fa-github"></i>
          </a>
          <a href="#" class="btn btn-social-icon btn-instagram">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection