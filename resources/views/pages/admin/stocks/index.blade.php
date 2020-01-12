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
    <h1>Stocks Management</h1>
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
    <p class="section-lead">You can manipulate product items data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product Items</h4>
                    <a href="/dashboard/product-manage/manage-items/create?from=stocks" class="ml-auto btn btn-primary">
                        <i class="fas fa-plus"></i> <span>Create new stock</span>
                    </a>
                </div>
                {{-- badge filter --}}
                <form action="{{ route('admin::product-manage::item::search-by-filter') }}" method="GET">
                    @method('GET')
                    <div class="badges mt-3 ml-3">
                        <div class="row align-items-center">
                            <div class="col col-md-6 col-lg-6">
                                <button name="all" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title data-original-title="Show all the items">All Items</button>
                                <button name="active" class="badge badge-success" data-toggle="tooltip" data-placement="top" title data-original-title="Only show all the items is active">Active Items</button>
                                <button name="inactive" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title data-original-title="Only show all the items is inactive">Inactive Items</button>
                            </div>
                            <div class="col col-md-6 col-lg-6">
                                <div class="form-inline justify-content-end mr-3 search-form">
                                    <div class="form-group mb-3">
                                        <input class="form-control rounded-pill mr-3" type="text" name="search" placeholder="Search item name or code" value="{{ $search ?? '' }}">
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
                            <th>Item Code</th>
                            <th>Price</th>
                            <th>Item Quantity</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @if (! empty($stocks))
                            @foreach ($stocks as $stock)
                            <tr>
                                <td>{{ $stock->name }}</td>
                                <td>{{ $stock->code_name }}</td>
                                <td>IDR {{ $stock->price }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ date_format($stock->created_at, 'd M Y') }}</td>
                                <td>
                                    <div class="badge badge-{{ $stock->active == 1 ? 'success' : 'danger' }}">
                                        {{ $stock->active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                                <td>
                                    <a href="" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title data-original-title="Increase {{ $stock->name }} quantity">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title data-original-title="Descrease {{ $stock->name }} quantity">
                                        <i class="fas fa-minus"></i>
                                    </a>
                                    <a href="" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title data-original-title="Show {{ $stock->name }} product item">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @elseif(count($stocks) == 0)
                        <tr>
                            <td>No product item data...</td>
                        </tr>
                        @endif
                    </table>
                    </div>
                </div>
                <div class="card-footer text-right ml-auto">
                    {!! $stocks->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
