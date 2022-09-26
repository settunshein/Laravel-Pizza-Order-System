@extends('admin.layouts.master')

@section('product-active', 'sidebar-active')

@section('title', 'Product List')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Product Management</h6>
    <form action="{{ route('product#index') }}" method="GET">
        <div class="input-group">
            <p class="mb-0 mr-2" style="font-size: 12.5px; margin-top: 7px;">
                Search Key : <span class="text-danger">{{ request('search') }}</span>
            </p>
            <input type="text" class="search-input form-control rounded-0 border-dark" placeholder="Search by Product Name . . ." 
            style="width: 250px" name="search" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-dark btn-sm rounded-0" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
          </div>
    </form>
</div>

<div class="row mb-5">
    <div class="table-responsive">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class=" d-flex justify-content-between align-items-center">
                        <p class="mb-0 py-1 card-ttl">
                            Product List Table
                            <span>
                                <a href="javascript:;">
                                    ( <i class="fas fa-database mr-1"></i>{{ $products->total() }} )
                                </a>
                            </span>
                        </p>
                        <a href="{{ route('product#create') }}" class="btn btn-sm btn-outline-dark rounded-0">
                            Create&nbsp;
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="productListTable">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>View Count</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr class="text-center">
                                <td>{{ ++$i }}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="100px">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>
                                    {{ number_format($product->price) }}
                                    <small>MMK</small>
                                </td>
                                <td>
                                    {{ number_format($product->view_count) }}
                                    View{{ $product->view_count > 1 ? 's' : '' }}
                                </td>
                                <td>{{ $product->created_at->toFormattedDateString() }}</td>
                                <td width="12%">
                                    <a href="{{ route('product#edit', $product->id) }}" 
                                    class="btn btn-sm btn-outline-dark rounded-0">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    
                                    <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0 del-product-btn"
                                    data-id="{{ $product->id }}">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="8" class="font-weight-bold text-danger">
                                    No Product Found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click', '.del-product-btn', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are You Sure?',
            text: "Do You Want to Delete this Product?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            onfirmButtonText: 'OK',
            cancelButtonText: 'CANCEL',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'GET',
                    url   : `/product/delete/${id}`,

                    success: function(){
                        $('#productListTable tbody').load(location.href + ' #productListTable tbody tr');
                        Swal.fire({
                            icon : 'success',
                            title: 'SUCCESS',
                            text : 'Product Deleted Successfully',
                        });
                        
                    }
                })
            }
        })
    })/* End of Product Confirm Delete */
</script>
@endsection