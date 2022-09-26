@extends('admin.layouts.master')

@section('profile-active', 'sidebar-active')

@section('title', 'Update Profile')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>User Profile</h6>
</div>

<form action="{{ route('admin#updateProfile') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="form-row">
    <div class="col-md-8 mb-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <p class="mb-0 py-1 card-ttl">
                    Update Profile Form
                </p>
                <a href="{{ route('admin#profilePage') }}" class="btn btn-sm btn-outline-dark rounded-0">
                    <i class="fas fa-arrow-circle-left"></i>&nbsp;
                    B A C K
                </a>
            </div><!-- End of card-header -->

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Username</label>
                        <input type="text" class="form-control form-control-sm rounded-0 @error('name') is-invalid @enderror" 
                        name="name" value="{{ old('name', $authUser->name) }}" autofocus>
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Email Address</label>
                        <input type="text" class="form-control form-control-sm rounded-0 @error('name') is-invalid @enderror" 
                        name="email" value="{{ old('email', $authUser->email) }}">
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone Number</label>
                        <input type="text" class="form-control form-control-sm rounded-0 @error('name') is-invalid @enderror" 
                        name="phone" value="{{ old('phone', $authUser->phone) }}">
                        <small class="text-danger">{{ $errors->first('phone') }}</small>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <select name="gender" class="form-control form-control-sm rounded-0 @error('gender') is-invalid @enderror">
                            <option selected disabled>Select Your Gender</option>
                            <option value="male" @if($authUser->gender == 'male') selected @endif>Male</option>
                            <option value="female" @if($authUser->gender == 'female') selected @endif>Female</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('gender') }}</small>
                    </div>

                    <div class="form-group col-md-12">
                        <label>User Role</label>
                        <input type="text" class="form-control form-control-sm rounded-0 @error('role') is-invalid @enderror" 
                        name="role" value="{{ ucwords($authUser->role) }}" disabled>
                        <small class="text-danger">{{ $errors->first('role') }}</small>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Address</label>
                        <textarea name="address" rows="3" class="form-control form-control-sm rounded-0">{{ old('address', $authUser->address) }}</textarea>
                        <small class="text-danger">{{ $errors->first('address') }}</small>
                    </div>
                </div>
            </div><!-- End of card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-outline-dark float-right rounded-0">
                    <i class="fa fa-edit"></i>&nbsp;
                    Update Profile
                </button>
            </div>
        </div>
    </div><!-- /.col-md-9 -->

    <div class="col-md-4 mb-5">
        <div class="card">
            <div class="card-header">
                <div class=" d-flex justify-content-between align-items-center">
                    <p class="mb-0 py-1 card-ttl">
                        Profile Image
                    </p>
                </div>
            </div>

            <div class="card-body">
                <input type="file" class="dropify" name="image" @if($authUser->image) data-default-file="{{ $authUser->getPhotoPath() }}" @endif>
                <small class="text-danger">{{ $errors->first('image') }}</small>
            </div>
        </div>
    </div>
</div>

</form>
@endsection


