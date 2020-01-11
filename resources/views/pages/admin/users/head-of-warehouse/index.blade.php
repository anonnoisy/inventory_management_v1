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
    <h1>User Management</h1>
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
    <h2 class="section-title">Head Of Warehouse Management</h2>
    <p class="section-lead">You can manipulate user head of warehouse data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Users Admin</h4>
                    <a href="{{ route('admin::user-manage::head-of-warehouse::create') }}" class="ml-auto btn btn-primary">
                        <i class="fas fa-plus"></i> <span>Create new head of warehouse</span>
                    </a>
                </div>
                {{-- badge filter --}}
                <form action="{{ route('admin::user-manage::head-of-warehouse::search-by-filter') }}" method="GET">
                    @method('GET')
                    @csrf
                    <div class="badges mt-3 ml-3">
                        <div class="row align-items-center">
                            <div class="col col-md-6 col-lg-6">
                                <button name="all" class="badge badge-primary" data-toggle="tooltip" data-placement="top" title data-original-title="Show all the users">All Users</button>
                                <button name="active" class="badge badge-success" data-toggle="tooltip" data-placement="top" title data-original-title="Only show all the users is active">Active Users</button>
                                <button name="inactive" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title data-original-title="Only show all the users is inactive">Inactive Users</button>
                            </div>
                            <div class="col col-md-6 col-lg-6">
                                <div class="form-inline justify-content-end mr-3 search-form">
                                    <div class="form-group mb-3">
                                        <input class="form-control rounded-pill mr-3" type="text" name="search" placeholder="Search user HoW by name" value="{{ $search ?? '' }}">
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
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $user)
                        @if ($user->id != auth()->user()->id)
                            <tr>
                                <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                                <td>{{ $user->phone ?? 'Haven\'t phone number' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date_format($user->created_at, 'd M Y') }}</td>
                                <td>
                                    <div class="badge badge-{{ $user->active == 1 ? 'success' : 'danger' }}">
                                        {{ $user->active == 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin::user-manage::head-of-warehouse::show', [ $user->id ]) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin::user-manage::head-of-warehouse::show', [ $user->id ]) }}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @elseif(count($users) == 0)
                            <tr>
                                <td>No admin user data...</td>
                            </tr>
                        @endif
                        @endforeach
                    </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    {!! $users->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
