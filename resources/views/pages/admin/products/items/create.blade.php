@extends('pages.layouts.app')

@section('content')

<div class="section-header">
    <h1>Product Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin::product-manage::item::home') }}">Items Management</a></div>
        <div class="breadcrumb-item">Create new item</div>
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
    <h2 class="section-title">Items Management</h2>
    <p class="section-lead">You can manipulate product item data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create new product item</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin::product-manage::item::store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="category_id">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" aria-describedby="categoryHelp">
                                    <option>-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <small id="categoryHelp" class="form-text text-danger">* This field is required</small>

                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label for="brand_id">Brand Name</label>
                                <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror" aria-describedby="brandHelp">
                                    <option>-- Select Brand --</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <small id="brandHelp" class="form-text text-danger">* This field is required</small>

                                @error('brand_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Item Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus aria-describedby="nameHelp">
                                <small id="nameHelp" class="form-text text-danger">* This field is required</small>

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

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="price">Price</label>
                                <input id="price" type="number" min="0" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" aria-describedby="priceHelp">
                                <small id="priceHelp" class="form-text text-danger">* This field is required</small>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="quantity">Quantity</label>
                                <input id="quantity" type="number" min="0" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" aria-describedby="quantityHelp">
                                <small id="quantityHelp" class="form-text text-danger">* This field is required</small>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="description">Description of item</label>
                                <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" aria-describedby="descriptionHelp">
                                <small id="descriptionHelp" class="form-text text-muted">* This field is optional</small>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('admin::product-manage::item::home') }}" class="btn btn-danger btn-lg">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-lg">Create a Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection