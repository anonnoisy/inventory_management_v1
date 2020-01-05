@extends('pages.layouts.app')

@section('content')

<div class="section-header">
    <h1>Category Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin::product-manage::brand::home') }}">Category Management</a></div>
        <div class="breadcrumb-item">Show or edit Category</div>
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
    <h2 class="section-title">Category, {{ $category->name }}</h2>
    <p class="section-lead">Change information about category data on this page.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card profile-widget">
                <div class="profile-widget-description">
                    <div class="card-header">
                        <h4>Edit Category data</h4>
                        <form action="{{ route('admin::product-manage::category::status', [ $category->id ]) }}" method="post" class="ml-auto">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="active" value="{{ $category->active == 1 ? 0 : 1 }}">
                            @if ($category->active == 1)
                                <button type="submit" class="btn btn-warning"><i class="fas fa-eye-slash"></i> </button>
                            @else
                                <button type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="top" title data-original-title="Activate this user"><i class="fas fa-eye"></i> </button>
                            @endif
                        </form>
                    </div>
                    <form action="{{ route('admin::product-manage::category::update', [ $category->id ]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Category Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $category->name }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="code_name">Code Name</label>
                                <input id="code_name" type="text" class="form-control @error('code_name') is-invalid @enderror" name="code_name" value="{{ $category->code_name }}" readonly>

                                @error('code_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin::product-manage::category::home') }}" class="btn btn-danger btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Save a Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection