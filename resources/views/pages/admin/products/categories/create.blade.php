@extends('pages.layouts.app')

@section('content')

<div class="section-header">
    <h1>Product Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin::product-manage::category::home') }}">Catogories Management</a></div>
        <div class="breadcrumb-item">Create new category</div>
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
    <h2 class="section-title">Catogories Management</h2>
    <p class="section-lead">You can manipulate product category data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create new product category</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin::product-manage::category::store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Category Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="code_name">Code Name</label>
                                <input id="code_name" type="text" class="form-control @error('code_name') is-invalid @enderror" name="code_name" value="{{ old('code_name') }}" aria-describedby="codeNameHelp">
                                <small id="codeNameHelp" class="form-text text-muted">* You can pass this column for automatic generate code name</small>

                                @error('code_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin::product-manage::category::home') }}" class="btn btn-danger btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Create a Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection