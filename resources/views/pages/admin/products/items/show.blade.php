@extends('pages.layouts.app')

@section('content')

<div class="section-header">
    <h1>Item Management</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin::product-manage::brand::home') }}">Item Management</a></div>
        <div class="breadcrumb-item">Show or edit Item</div>
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
    <h2 class="section-title">Item, {{ $item->name }}</h2>
    <p class="section-lead">Change information about category data on this page.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card profile-widget">
                <div class="profile-widget-description">
                    <div class="card-header">
                        <h4>Edit Item data</h4>
                        <form action="{{ route('admin::product-manage::item::status', [ $item->id ]) }}" method="post" class="ml-auto">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="active" value="{{ $item->active == 1 ? 0 : 1 }}">
                            @if ($item->active == 1)
                                <button type="submit" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title data-original-title="Inactivate this item"><i class="fas fa-eye-slash"></i> </button>
                            @else
                                <button type="submit" class="btn btn-info" data-toggle="tooltip" data-placement="top" title data-original-title="Activate this item"><i class="fas fa-eye"></i> </button>
                            @endif
                        </form>
                    </div>
                    <form action="{{ route('admin::product-manage::item::update', [ $item->id ]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="category_id">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" aria-describedby="categoryHelp">
                                    <option>-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if( $category->id == $item->category_id ) selected @endif>{{ $category->name }}</option>
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
                                        <option value="{{ $brand->id }}" @if( $brand->id == $item->brand_id ) selected @endif>{{ $brand->name }}</option>
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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $item->name }}" autofocus aria-describedby="nameHelp">
                                <small id="nameHelp" class="form-text text-danger">* This field is required</small>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="code_name">Code Name</label>
                                <input id="code_name" type="text" class="form-control @error('code_name') is-invalid @enderror" name="code_name" value="{{ $item->code_name }}" readonly aria-describedby="codeNameHelp">
                                <small id="codeNameHelp" class="form-text text-danger">* This field will be auto generated</small>

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
                                <input id="price" type="number" min="0" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $item->price }}" aria-describedby="priceHelp">
                                <small id="priceHelp" class="form-text text-danger">* This field is required</small>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="quantity">Quantity</label>
                                <input id="quantity" type="number" min="0" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $item->quantity }}" aria-describedby="quantityHelp">
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
                                <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $item->description }}" aria-describedby="descriptionHelp">
                                <small id="descriptionHelp" class="form-text text-muted">* This field is optional</small>

                                @error('description')
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