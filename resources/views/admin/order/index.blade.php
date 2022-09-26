@extends('admin.layouts.master')

@section('order-active', 'sidebar-active')

@section('title', 'Order List')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Order Management</h6>
</div>

<div class="row">
    <div class="table-responsive">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <p class="mb-0 py-1 card-ttl">
                           <span class="order-ttl">Order List Table</span>
                            <span>
                                <a href="javascript:;">
                                    ( 
                                        <i class="fas fa-database mr-1"></i>
                                        <span class="order-count">{{ count($orders) }}</span>  
                                    )
                                </a>
                            </span>
                        </p>
                        <div class="btn-group">
                            <a href="javascript:;" class="order-status-btn btn btn-sm btn-primary rounded-0" data-status="">
                                All Orders
                            </a>
                            <a href="javascript:;" class="order-status-btn btn btn-sm btn-warning rounded-0" data-status="0">
                                Pending Orders
                            </a>
                            <a href="javascript:;" class="order-status-btn btn btn-sm btn-success rounded-0" data-status="1">
                                Completed Orders
                            </a>
                            <a href="javascript:;" class="order-status-btn btn btn-sm btn-danger rounded-0" data-status="2">
                                Canceled Orders
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="orderListTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Username</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th width="12%">Status</th>
                            </tr>
                        </thead>
                        <tbody id="orderList">
                            @forelse($orders as $order)
                            <tr class="text-center">
                                <input type="hidden" class="order-id" value="{{ $order->id }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a href="{{ route('order#details', $order->order_code) }}" class="text-danger">
                                        {{ $order->order_code }}
                                    </a>
                                </td>
                                <td>{{ number_format($order->total_price) }} MMK</td>
                                <td>
                                    <select name="status" class="status-select form-control form-control-sm rounded-0 {{ $order->checkOrderStatus() }}">
                                        <option class="text-warning" value="0" @if($order->status == 0) selected @endif>
                                            Pending
                                        </option>
                                        <option class="text-success" value="1" @if($order->status == 1) selected @endif>
                                            Completed
                                        </option>
                                        <option class="text-danger" value="2" @if($order->status == 2) selected @endif>
                                            Canceled
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="8" class="font-weight-bold text-danger">
                                    No Order Found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('backend/js/order.js') }}"></script>
@endsection