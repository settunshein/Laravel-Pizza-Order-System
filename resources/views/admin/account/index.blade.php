@extends('admin.layouts.master')

@section('admin-active', 'sidebar-active')

@section('title', 'Admin List')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Admin User Management</h6>
    <form action="{{ route('admin#index') }}" method="GET">
        <div class="input-group">
            <p class="mb-0 mr-2" style="font-size: 12.5px; margin-top: 7px;">
                Search Key : <span class="text-danger">{{ request('search') }}</span>
            </p>
            <input type="text" class="search-input form-control rounded-0 border-dark" placeholder="Search Admin User . . ." 
            style="width: 250px" name="search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-dark btn-sm rounded-0" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
          </div>
    </form>
</div>

<div class="row">
    <div class="table-responsive">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <p class="mb-0 py-1 card-ttl">
                            Admin List Table
                            <span>
                                <a href="javascript:;">
                                    ( <i class="fas fa-database mr-1"></i> {{ $admins->total() }})
                                </a>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="adminListTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Created Date</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr class="text-center">
                                <td>{{ ++$i }}</td>
                                <td>
                                    <img src="{{ $admin->getPhotoPath() }}" alt="{{ $admin->name }}" width="60px"
                                    class="rounded-circle">
                                </td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ ucwords($admin->gender) }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>{{ $admin->address }}</td>
                                <td>{{ $admin->created_at->toFormattedDateString() }}</td>
                                <td>
                                    @if( auth()->id() != $admin->id )
                                    <select name="status" class="role-select form-control form-control-sm rounded-0" data-id="{{ $admin->id }}">
                                        <option value="user">
                                            User
                                        </option>
                                        <option value="admin" selected>
                                            Admin
                                        </option>
                                    </select>
                                    @endif
                                </td>
                                <td>
                                    @if( auth()->id() != $admin->id )
                                    <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0 del-admin-btn 
                                    {{ $admin->isDisabledDelete(auth()->id(), $admin->id) }}" data-id="{{ $admin->id }}">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('backend/js/admin_user.js') }}"></script>
@endsection