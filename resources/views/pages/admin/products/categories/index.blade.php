@extends('pages.layouts.app')

@section('style')
<style>
.search-form input {
    font-size: 12px !important;
    height: 35px !important;
}

.search-form button {
    padding: .2rem .8rem;
}
</style>
@endsection

@section('content')

<div class="section-header">
    <h1>Products Management</h1>
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
    <h2 class="section-title">Categories Management</h2>
    <p class="section-lead">You can manipulate product categories data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product Catories</h4>
                    <a href="{{ route('admin::product-manage::category::create') }}" class="ml-auto btn btn-primary">
                        <i class="fas fa-plus"></i> <span>Create new category</span>
                    </a>
                </div>
                {{-- badge filter --}}
                <form action="{{ route('admin::product-manage::category::search-by-filter') }}" method="GET">
                    @method('GET')
                    @csrf
                    <div class="badges mt-3 ml-3">
                        <div class="row align-items-center">
                            <div class="col col-md-6 col-lg-6">
                                <button name="all" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title data-original-title="Show all the categories">All Categories</button>
                                <button name="active" class="badge badge-success" data-toggle="tooltip" data-placement="top" title data-original-title="Only show all the categories is active">Active Categories</button>
                                <button name="inactive" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title data-original-title="Only show all the categories is inactive">Inactive Categories</button>
                            </div>
                            <div class="col col-md-6 col-lg-6">
                                <div class="form-inline justify-content-end mr-3 search-form">
                                    <div class="form-group mb-3">
                                        <input class="form-control rounded-pill mr-3" type="text" name="search" placeholder="Search category name or code" value="{{ $search ?? '' }}">
                                        <button class="btn btn-primary btn-small rounded-pill pl-4 pr-4">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>Name</th>
                            <th>Code Name</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @if (! empty($categories))
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->code_name }}</td>
                                <td>{{ date_format($category->created_at, 'd M Y') }}</td>
                                <td>
                                    <div class="badge badge-{{ $category->active == 1 ? 'success' : 'danger' }}">
                                        {{ $category->active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin::product-manage::category::show', [ $category->id ]) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin::product-manage::category::destroy', [ $category->id ]) }}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @elseif(count($categories) == 0)
                        <tr>
                            <td>No product category data...</td>
                        </tr>
                        @endif
                    </table>
                    </div>
                </div>
                <div class="card-footer text-right ml-auto">
                    {!! $categories->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
