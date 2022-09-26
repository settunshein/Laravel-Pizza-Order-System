@extends('user.layouts.master')

@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                <span class="breadcrumb-item active">Order History</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="cartListTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Order Code</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($orders as $order)
                    <tr>
                        <td class="align-middle">{{ $order->created_at }}</td>
                        <td class="align-middle">{{ $order->order_code }}</td>
                        <td class="align-middle">{{ number_format($order->total_price + 3000) }} MMK</td>
                        <td class="align-middle">
                            @if( $order->status == 0 )
                                <span class="badge badge-warning p-2 rounded-0">
                                    <i class="fas fa-spinner me-1"></i>
                                    PENDING
                                </span>
                            @elseif( $order->status == 1 )
                                <span class="badge badge-success p-2 rounded-0">
                                    <i class="fas fa-check-circle me-1"></i>
                                    COMPLETED
                                </span>
                            @elseif( $order->status == 2 )
                                <span class="badge badge-danger px-3 py-2 rounded-0">
                                    <i class="fas fa-times-circle me-1"></i>
                                    CANCELED
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection