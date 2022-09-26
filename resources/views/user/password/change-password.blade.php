@extends('user.layouts.master')

@section('content')
<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                <span class="breadcrumb-item active">Change Password</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Change Password</span></h2>
    <div class="row px-xl-5">
        <div class="col-lg-12 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form action="{{ route('user#changePassword') }}" method="POST">
                @csrf
                    <div class="control-group">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Please Enter Your Current Password"
                        name="current_password"/>
                        <small class="d-block text-danger mb-3">{{ $errors->first('current_password') }}</small>
                    </div>
                    <div class="control-group">
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Please Enter Your New Password"
                        name="new_password"/>
                        <small class="d-block text-danger mb-3">{{ $errors->first('new_password') }}</small>
                    </div>
                    <div class="control-group">
                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"  placeholder="Please Confirm Your Password"
                        name="confirm_password"/>
                        <small class="d-block text-danger mb-3">{{ $errors->first('confirm_password') }}</small>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection