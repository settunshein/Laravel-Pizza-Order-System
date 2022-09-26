@extends('admin.layouts.master')

@section('order-active', 'sidebar-active')

@section('title', 'Order Details')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6 class="d-flex justify-content-between align-items-center">
        Order Management
        <span class="text-danger mx-1">
            (<span class="mx-1"><i class="far fa-file-alt"></i>&nbsp; {{ $order_items[0]->order_code }}</span>)
        </span>
    </h6>
    <a href="javascript:;" class="btn btn-sm btn-primary rounded-0">
        <i class="fa fa-history"></i>&nbsp;
        {{ $order_items[0]->created_at->toFormattedDateString() }}
    </a>
</div>

<div class="row mb-5">
    <div class="table-responsive">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <p class="mb-0 py-1 card-ttl">
                           <span class="order-ttl">Order Item List Table</span>
                            <span>
                                <a href="javascript:;">
                                    ( <i class="fas fa-database mr-1"></i>
                                      <span class="order-count">{{ count($order_items) }}</span>  
                                    )
                                </a>
                            </span>
                        </p>
                        <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0" onclick="history.back()">
                            <i class="fas fa-arrow-circle-left"></i>&nbsp;
                            B A C K
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row justify-content-between align-items-center mb-4">
                        <div class="col-md-6 d-flex">
                            <a href="javascript:;" class="text-decoration-none brand-logo">
                                <span class="h4 text-uppercase text-custom-warning bg-custom-dark px-2">PIZZA</span>
                                <span class="h4 text-uppercase text-custom-dark bg-custom-warning px-2 ml-n1">HUB</span>
                            </a>
                        </div>
                        
                        <div class="mr-3" style="margin-left: 30px;">
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
                        </div>
                    </div>

                    <div class="row justify-content-between mb-3">
                        <div class="col-6">
                            From
                            <address class="mb-2">
                                <strong>Pizza Hub</strong><br>
                                123 Wakanda City<br>
                                Phone: +959 123123123<br>
                                Email: pizzahub@info.com
                            </address>
                        </div>
    
                        <div class="col-6 text-right">
                            <span>To</span>
                            <address class="mb-2">
                                <strong>{{ $order_items[0]->user_name }}</strong><br>
                                {{ $order_items[0]->user_address }}<br>
                                Phone: {{ $order_items[0]->user_phone }}<br>
                                Email: {{ $order_items[0]->user_email }}
                            </address>
                        </div>
                    </div><!-- End of 2nd Row -->

                    <table class="table table-border-less" id="orderListTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Product Info</th>
                                <th>Customer</th>
                                <th>Order Code</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="orderList">
                            @foreach($order_items as $order_item)
                            <tr class="text-center">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$order_item->product_img) }}" alt="{{ $order_item->product_name }}" width="100px">
                                    <p class="mt-2 mb-0 font-weight-bold">{{ $order_item->product_name }}</p>
                                </td>
                                <td>{{ $order_item->user_name }}</td>
                                <td>{{ $order_item->created_at->toFormattedDateString() }}</td>
                                <td>{{ $order_item->qty }}</td>
                                <td>{{ number_format($order_item->unit_price) }} MMK</td>
                                <td>{{ number_format($order_item->qty * $order_item->unit_price) }} MMK</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th colspan="5"></th>
                                <th>Sub Total</th>
                                <th>{{ number_format($order->total_price) }} MMK</th>
                            </tr>
                            <tr class="text-center">
                                <th class="border-0" colspan="5"></th>
                                <th class="border-0">Shipping Fee</th>
                                <th class="border-0">3,000 MMK</th>
                            </tr>
                            <tr class="text-center text-danger">
                                <th style="border-top: 2.5px double #dee2e6;" colspan="5"></th>
                                <th style="border-top: 2.5px double #dee2e6;">Grand Total</th>
                                <th style="border-top: 2.5px double #dee2e6;">{{ number_format($order->total_price + 3000) }} MMK</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection