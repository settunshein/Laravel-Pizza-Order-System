@extends('admin.layouts.master')

@section('dashboard-active', 'sidebar-active')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Dashboard</h6>
</div>

<div class="widget-blk row mb-2">
    <div class="col-md-3">
        <div class="p-3">
            <div class="row widget" style="background-color: #42B883;">
                <div class="col-9 py-3 text-white">
                    <h3 class="mb-2">
                        {{ number_format($categories) }}
                    </h3>
                    <p class="custom-fs-12 mb-0 text-white">Total Categories</p>
                </div>
                <div class="col-3 py-3 text-white d-flex align-items-center justify-content-center" 
                style="background-color: rgba(0,0,0,.1);">
                    <i class="fas fa-stream" style="font-size: 32px;"></i>
                </div> 
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3">
            <div class="row widget" style="background-color: #DD4814;">
                <div class="col-9 py-3 text-white">
                    <h3 class="mb-2">
                        {{ number_format($products) }}
                    </h3>
                    <p class="custom-fs-12 mb-0 text-white">Total Products</p>
                </div>
                <div class="col-3 py-3 text-white d-flex align-items-center justify-content-center" 
                style="background-color: rgba(0,0,0,.1);">
                    <i class="fas fa-pizza-slice" style="font-size: 32px;"></i>
                </div> 
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3">
            <div class="row widget" style="background-color: #4584B6;">
                <div class="col-9 py-3 text-white">
                    <h3 class="mb-2">
                        {{ number_format($customers) }}
                    </h3>
                    <p class="custom-fs-12 mb-0 text-white">Total Customers</p>
                </div>
                <div class="col-3 py-3 text-white d-flex align-items-center justify-content-center" 
                style="background-color: rgba(0,0,0,.1);">
                    <i class="fas fa-users" style="font-size: 32px;"></i>
                </div> 
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="p-3">
            <div class="row widget" style="background-color: #F7DF1E;">
                <div class="col-9 py-3 text-white">
                    <h3 class="mb-2">
                        {{ number_format($orders) }}
                    </h3>
                    <p class="custom-fs-12 mb-0 text-white">Total Orders</p>
                </div>
                <div class="col-3 py-3 text-white d-flex align-items-center justify-content-center" 
                style="background-color: rgba(0,0,0,.1);">
                    <i class="fas fa-file-alt" style="font-size: 32px;"></i>
                </div> 
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="table-responsive">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <p class="mb-0 py-1 card-ttl">
                            Today Order List Table
                            <span>
                                <a href="javascript:;">
                                    ( <i class="fas fa-database mr-1"></i>{{ $today_orders->total() }} )
                                </a>
                            </span>
                        </p>
                        <a href="javascript:;" class="btn btn-sm btn-danger rounded-0">
                            <i class="fa fa-calendar-alt"></i>&nbsp;
                            {{ date('d M, Y') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="categoryListTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Customer</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($today_orders as $order)
                            <tr class="text-center">
                                <td>{{ ++$i }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td>
                                    <a href="{{ route('order#details', $order->order_code) }}" class="text-danger">
                                        {{ $order->order_code }}
                                    </a>
                                </td>
                                <td>{{ number_format($order->total_price) }} <small>MMK</small></td>
                                <td>
                                    @if($order->status == 0)
                                    <a href="javascript:;" class="btn btn-sm btn-warning rounded-0">
                                        <i class="fas fa-spinner"></i>&nbsp;
                                        Pending
                                    </a>
                                    @elseif($order->status == 1)
                                    <a href="javascript:;" class="btn btn-sm btn-success rounded-0" style="cursor: default;">
                                        <i class="far fa-check-circle"></i>&nbsp;
                                        Completed
                                    </a>
                                    @else
                                    <a href="javascript:;" class="btn btn-sm btn-danger rounded-0" style="cursor: default;">
                                        <i class="fas fa-times-circle"></i>&nbsp;
                                        Canceled
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="5" class="font-weight-bold text-danger">
                                    No Orders Found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $today_orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection