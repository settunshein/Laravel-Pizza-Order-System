@extends('admin.layouts.master')

@section('customer-active', 'sidebar-active')

@section('title', 'Customer List')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Customer Management</h6>
    <form action="{{ route('admin#index') }}" method="GET">
        <div class="input-group">
            <p class="mb-0 mr-2" style="font-size: 12.5px; margin-top: 7px;">
                Search Key : <span class="text-danger">{{ request('search') }}</span>
            </p>
            <input type="text" class="search-input form-control rounded-0 border-dark" placeholder="Search Customer . . ." 
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
                            Customer List Table
                            <span>
                                <a href="javascript:;">
                                    ( <i class="fas fa-database mr-1"></i> {{ $customers->total() }})
                                </a>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="customerListTable">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr class="text-center">
                                <td>{{ ++$i }}</td>
                                <td>
                                    <img src="{{ $customer->getPhotoPath() }}" alt="{{ $customer->name }}" width="60px"
                                    class="rounded-circle">
                                </td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ ucwords($customer->gender) }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->created_at->toFormattedDateString() }}</td>
                                <td>
                                    <select name="status" class="role-select form-control form-control-sm rounded-0" data-id="{{ $customer->id }}">
                                        <option value="user" selected>
                                            User
                                        </option>
                                        <option value="admin">
                                            Admin
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('backend/js/customer.js') }}"></script>
@endsection