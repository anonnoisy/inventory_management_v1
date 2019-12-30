@extends('pages.layouts.app')

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
    <h2 class="section-title">Admin Management</h2>
    <p class="section-lead">You can manipulate user admin data here.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>All User Admin</h4>
                    <a href="{{ route('admin::user-manage::create') }}" class="ml-auto btn btn-primary">
                        <i class="fas fa-plus"></i> <span>Create new admin</span>
                    </a>
                </div>
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
                        <tr>
                            <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                            <td>{{ $user->phone ?? 'Haven\'t phone number' }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ date_format($user->created_at, 'd M Y') }}</td>
                            <td><div class="badge badge-success">Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection