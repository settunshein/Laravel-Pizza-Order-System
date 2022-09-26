@extends('user.layouts.master')

@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Categories ({{ count($categories) }})</span>
            </h5>
            <div class="bg-light p-4 mb-30">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="{{ route('user#home') }}" class="text-dark">
                        All Products
                    </a>
                </div>
                @foreach($categories as $category)
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="{{ route('user#productsByCategory', $category->id) }}" class="text-dark">
                        {{ $category->name }}
                    </a>
                </div>
                @endforeach
            </div>
            <!-- Price End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{ route('user#cartListPage') }}" class="me-3">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fas fa-cart-plus"></i> Cart
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">
                                        {{ count($carts) }}
                                    </span>
                                </button>
                            </a>

                            <a href="{{ route('user#orderHistoryPage') }}">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fas fa-history"></i> History
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($histories) }}
                                    </span>
                                </button>
                            </a>
                        </div>
                        <div class="">
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-control" placeholder="Sorting">
                                    <option>Choose Option . . .</option>
                                    <option value="asc">&uarr;&nbsp;Ascending</option>
                                    <option value="desc">&darr;&nbsp;Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row pb-3" id="productList">
                <input type="hidden" id="userId" value="{{ auth()->id() }}">
                @forelse($products as $product)
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square add-to-cart" href="javascript:;" data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetails', $product->id) }}"><i class="fas fa-info-circle"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{ $product->name }}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{ number_format($product->price) }} MMK</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-12 text-center">
                    <p class="mb-0">No Products Found</p>
                </div>
                @endforelse
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection

@section('js')
<script src="{{ asset('frontend/js/home.js') }}"></script>
@endsection