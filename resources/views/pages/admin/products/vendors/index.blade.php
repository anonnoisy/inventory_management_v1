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
    <h1>Vendors Management</h1>
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
    <h2 class="section-title">Vendors Management</h2>
    <p class="section-lead">You can manipulate vendors data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Vendors</h4>
                    <a href="{{ route('admin::product-manage::vendor::create') }}" class="ml-auto btn btn-primary">
                        <i class="fas fa-plus"></i> <span>Create new Vendor</span>
                    </a>
                </div>
                {{-- badge filter --}}
                <form action="{{ route('admin::product-manage::vendor::search-by-filter') }}" method="GET">
                    @method('GET')
                    <div class="badges mt-3 ml-3">
                        <div class="row align-items-center">
                            <div class="col col-md-6 col-lg-6">
                                <button name="all" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title data-original-title="Show all the vendor">All Vendors</button>
                                <button name="active" class="badge badge-success" data-toggle="tooltip" data-placement="top" title data-original-title="Only show all the vendors is active">Active Vendors</button>
                                <button name="inactive" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title data-original-title="Only show all the vendors is inactive">Inactive Vendors</button>
                            </div>
                            <div class="col col-md-6 col-lg-6">
                                <div class="form-inline justify-content-end mr-3 search-form">
                                    <div class="form-group mb-3">
                                        <input class="form-control rounded-pill mr-3" type="text" name="search" placeholder="Search vendor name or email" value="{{ $search ?? '' }}">
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
                            <th>Vendor</th>
                            <th>Mobile</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @if (! empty($vendors))
                            @foreach ($vendors as $vendor)
                            <tr>
                                <td>{{ $vendor->vendor_name }}</td>
                                <td>{{ $vendor->mobile }}</td>
                                <td>{{ $vendor->phone ?? 'Haven\'t phone' }}</td>
                                <td>{{ $vendor->email }}</td>
                                <td>{{ date_format($vendor->created_at, 'd M Y') }}</td>
                                <td>
                                    <div class="badge badge-{{ $vendor->active == 1 ? 'success' : 'danger' }}">
                                        {{ $vendor->active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin::product-manage::vendor::show', [ $vendor->id ]) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin::product-manage::vendor::destroy', [ $vendor->id ]) }}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td>No product Vendor data...</td>
                        </tr>
                        @endif
                    </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    {!! $vendors->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
