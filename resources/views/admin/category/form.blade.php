@extends('admin.layouts.master')

@section('category-active', 'sidebar-active')

@section('title') {{ isset($category) ? 'Edit Category' : 'Create Category' }} @endsection

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>Category Management</h6>
</div>

<form action="{{ isset($category) ? route('category#update', $category->id) : route('category#create') }}" method="POST"
enctype="multipart/form-data">
@csrf

<div class="row">
    <div class="col-md-12 mb-5">
        <div class="card">
            <div class="card-header">
                <div class=" d-flex justify-content-between align-items-center">
                    <p class="mb-0 py-1 card-ttl">
                        @isset($category)Edit Category Form @else Create Category Form @endisset
                    </p>
                    <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0" onclick="history.back()">
                        <i class="fas fa-arrow-circle-left"></i>&nbsp;
                        B A C K
                    </a>
                </div>
            </div><!-- End of card-header -->

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Category Name</label>
                        <input type="text" class="form-control form-control-sm rounded-0 @error('name') is-invalid @enderror" 
                        name="name" value="{{ isset($category) ? @old('name', $category->name) : @old('name') }}" autofocus>
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                </div>
            </div><!-- End of card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-outline-dark float-right rounded-0">
                    <i class="fa fa-edit"></i>&nbsp;
                    @isset($category) Update @else Create @endisset
                </button>
            </div>

        </div>
    </div>
</div>

</form>
@endsection


