@extends('admin.layouts.master')

@section('product-active', 'sidebar-active')

@section('title') {{ isset($product) ? 'Edit Product' : 'Create Product' }} @endsection

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Product Management</h6>
</div>

<form action="{{ isset($product) ? route('product#update', $product->id) : route('product#create') }}" method="POST"
enctype="multipart/form-data">
@csrf

<div class="row">
    <div class="col-md-8 mb-5">
        <div class="card">
            <div class="card-header">
                <div class=" d-flex justify-content-between align-items-center">
                    <p class="mb-0 py-1 card-ttl">
                        @isset($product)Edit Product Form @else Create Product Form @endisset
                    </p>
                    <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0" onclick="history.back()">
                        <i class="fas fa-arrow-circle-left"></i>&nbsp;
                        B A C K
                    </a>
                </div>
            </div><!-- End of card-header -->

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Product Name</label>
                        <input type="text" class="form-control form-control-sm rounded-0 @error('name') is-invalid @enderror" 
                        name="name" value="{{ isset($product) ? @old('name', $product->name) : @old('name') }}" autofocus>
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Category Name</label>
                        <select name="category_id" class="form-control form-control-sm rounded-0 @error('category_id') is-invalid @enderror">
                            <option disabled selected>Select Your Product's Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                            @if( isset($product) ? @old('category_id', $product->category_id) : @old('category_id') == $category->id ) 
                                selected
                            @endif>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('category_id') }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Product Price</label>
                        <input type="number" class="form-control form-control-sm rounded-0 @error('price') is-invalid @enderror" 
                        name="price" value="{{ isset($product) ? @old('price', $product->price) : @old('price') }}" autofocus>
                        <small class="text-danger">{{ $errors->first('price') }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Waiting Time</label>
                        <input type="number" class="form-control form-control-sm rounded-0 @error('waiting_time') is-invalid @enderror" 
                        name="waiting_time" value="{{ isset($product) ? @old('waiting_time', $product->waiting_time) : @old('waiting_time') }}" autofocus>
                        <small class="text-danger">{{ $errors->first('waiting_time') }}</small>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Product Description</label>
                        <textarea name="description" rows="4" class="form-control form-control-sm rounded-0 @error('description') is-invalid @enderror">{{ isset($product) ? @old('description', $product->description) : @old('description') }}</textarea>
                        <small class="text-danger">{{ $errors->first('description') }}</small>
                    </div>
                </div>
            </div><!-- End of card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-outline-dark float-right rounded-0">
                    <i class="fa fa-edit"></i>&nbsp;
                    @isset($product) Update @else Create @endisset
                </button>
            </div>

        </div>
    </div>

    <div class="col-md-4 mb-5">
        <div class="card">
            <div class="card-header">
                <div class=" d-flex justify-content-between align-items-center">
                    <p class="mb-0 py-1 card-ttl">
                        Product Image
                    </p>
                </div>
            </div>

            <div class="card-body">
                <input type="file" class="dropify" name="image"
                @isset($product)
                    @if($product->image)
                        data-default-file="{{ asset('storage/'.$product->image) }}"
                    @endif
                @endif>
                <small class="text-danger">{{ $errors->first('image') }}</small>
            </div>
        </div>
    </div>
</div>

</form>
@endsection


