@extends('pages.layouts.app')

@section('content')

<div class="section-header">
    <h1>Product Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin::product-manage::brand::home') }}">Brand Management</a></div>
        <div class="breadcrumb-item">Create new brand</div>
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
    <h2 class="section-title">Brand Management</h2>
    <p class="section-lead">You can manipulate product brand data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create new product brand</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin::product-manage::brand::store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="category_id">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" aria-describedby="categoryHelp">
                                    <option>-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <small id="categoryHelp" class="form-text text-danger">* Please insert category before create a brand</small>

                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="name">Brand Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-4">
                                <label for="category_id">Code Name</label>
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
                            <label for="description">Description of brand</label>
                            <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" aria-describedby="descriptionHelp">
                            <small id="descriptionHelp" class="form-text text-muted">* This column is optional</small>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin::user-manage::admin::home') }}" class="btn btn-danger btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Create a Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection