@extends('user.layouts.master')

@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                <span class="breadcrumb-item active">Cart</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="cartListTable">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($carts as $cart)
                    <tr>
                        <input type="hidden" class="cart-id" value="{{ $cart->id }}">
                        <input type="hidden" class="product-id" value="{{ $cart->product_id }}">
                        <input type="hidden" class="user-id" value="{{ $cart->user_id }}">

                        <td class="align-middle">
                            <img src="{{ asset('storage/'.$cart->product_image) }}" alt="{{ $cart->product_name }}" style="width: 100px;">
                        </td>
                        <td class="align-middle">
                            {{ $cart->product_name }}
                        </td>
                        <td class="align-middle" id="price" data-price="{{ $cart->product_price }}">{{ number_format($cart->product_price) }} MMK</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $cart->qty }}" id="qty">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <input type="hidden" value="{{ $cart->product_price * $cart->qty }}" id="total_amt">
                        <td class="align-middle" id="total">
                            {{ number_format($cart->product_price * $cart->qty) }} MMK
                        </td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Sub Total</h6>
                        <h6 id="subTotalPrice">{{ number_format($totalPrice) }} MMK</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">{{ number_format(3000) }} MMK</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="grandTotalPrice">{{ number_format($totalPrice + 3000) }} MMK</h5>
                    </div>
                    @if(count($carts) == 0)
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" type="button" 
                    onclick="toastr.error('Your Cart is Empty !', 'ACCESS DENIED', { closeButton: true, progressBar: true})">
                        Proceed To Checkout
                    </button>
                    @else
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">
                        Proceed To Checkout
                    </button>
                    @endif
                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-2" id="clearCartBtn">
                        Clear Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

@section('js')
<script src="{{ asset('frontend/js/cart.js') }}"></script>
@endsection