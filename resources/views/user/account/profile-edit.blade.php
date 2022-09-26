@extends('user.layouts.master')

@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                <span class="breadcrumb-item active">Account</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Contact Start -->
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Update Account</span></h2>
    <form action="{{ route('user#updateProfile') }}" method="POST" enctype="multipart/form-data" class="row px-xl-5">
    @csrf
        <div class="col-lg-8 mb-5">
            <div class="contact-form bg-light p-30">
                <div class="control-group">
                    <label class="text-primary">Username</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $authUser->name) }}"
                    name="name"/>
                    <small class="d-block text-danger mb-3">{{ $errors->first('name') }}</small>
                </div>
                <div class="control-group">
                    <label class="text-primary">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('name', $authUser->email) }}"
                    name="email"/>
                    <small class="d-block text-danger mb-3">{{ $errors->first('email') }}</small>
                </div>
                <div class="control-group">
                    <label class="text-primary">Phone Number</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('name', $authUser->phone) }}"
                    name="phone"/>
                    <small class="d-block text-danger mb-3">{{ $errors->first('phone') }}</small>
                </div>
                <div class="control-group">
                    <label class="text-primary">Gender</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option selected disabled>Select Your Gender</option>
                        <option value="male" @if($authUser->gender == 'male') selected @endif>Male</option>
                        <option value="female" @if($authUser->gender == 'female') selected @endif>Female</option>
                    </select>
                    <small class="d-block text-danger mb-3">{{ $errors->first('gender') }}</small>
                </div>
                <div class="control-group">
                    <label class="text-primary">Address</label>
                    <textarea name="address" class="form-control mb-3" rows="3" id="message" placeholder="Address">{{ old('name', $authUser->address) }}</textarea>
                    <small class="d-block text-danger mb-3">{{ $errors->first('address') }}</small>
                </div>
                <div>
                    <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Update Account</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-5">
            <div class="bg-light p-30 mb-30">
                <label class="text-primary">Profile Image</label>
                <input type="file" class="dropify" name="image"
                @if($authUser->image) data-default-file="{{ $authUser->getPhotoPath() }}" @endif>
            </div>
        </div>
    </form>
</div>
<!-- Contact End -->
@endsection