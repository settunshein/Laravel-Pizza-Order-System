@extends('admin.layouts.master')

@section('password-active', 'sidebar-active')

@section('title', 'Change Password')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>User Account</h6>
</div>

<form action="{{ route('admin#changePassword') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row">
    <div class="col-md-12 mb-5">
        <div class="card">
            <div class="card-header">
                <div class=" d-flex justify-content-between align-items-center">
                    <p class="mb-0 py-1 card-ttl">
                        Change Password Form
                    </p>
                </div>
            </div><!-- End of card-header -->

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Current Password</label>
                        <input type="password" class="form-control form-control-sm rounded-0 @error('current_password') is-invalid @enderror" 
                        name="current_password" placeholder="Enter Your Current Password" autofocus>
                        <small class="text-danger">{{ $errors->first('current_password') }}</small>
                    </div>

                    <div class="form-group col-md-12">
                        <label>New Password</label>
                        <input type="password" class="form-control form-control-sm rounded-0 @error('new_password') is-invalid @enderror" 
                        name="new_password" placeholder="Enter Your New Password">
                        <small class="text-danger">{{ $errors->first('new_password') }}</small>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control form-control-sm rounded-0 @error('confirm_password') is-invalid @enderror" 
                        name="confirm_password" placeholder="Confirm Your New Password">
                        <small class="text-danger">{{ $errors->first('confirm_password') }}</small>
                    </div>
                </div>
            </div><!-- End of card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-outline-dark float-right rounded-0">
                    <i class="fa fa-edit"></i>&nbsp;
                    Change Password
                </button>
            </div>

        </div>
    </div>
</div>

</form>
@endsection


