@extends('admin.layouts.master')

@section('profile-active', 'sidebar-active')

@section('title', 'User Profile')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6>User Profile</h6>
</div>

<form action="{{ route('admin#changePassword') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="row">
    <div class="col-md-12 mb-5">
        <div class="card">
            <div class="card-header">
                <div class=" d-flex justify-content-between align-items-center">
                    <p class="mb-0 py-1 card-ttl">
                        Personal Info
                    </p>
                </div>
            </div><!-- End of card-header -->

            <div class="card-body">
                <div class="form-row align-items-center">
                    <div class="col-3">
                        <div class="card border-0">
                            <div class="card-body text-center">
                                <img src="{{ $authUser->getPhotoPath() }}" alt="{{ $authUser->name }}" class="rounded-circle"
                                width="150px">
                            </div>
                        </div>
                    </div>

                    <div class="col-9 border-left">
                        <div class="card border-0">
                            <div class="card-body">
                                <ul type="none" class="info-blk">
                                    <li>
                                        <span class="text-center"><i class="far fa-user"></i></span>
                                        <strong>Username</strong> {{ $authUser->name }}
                                    </li>
                                    <li>
                                        <span class="text-center"><i class="fas fa-venus-mars"></i></span>
                                        <strong>Gender</strong> {{ ucwords($authUser->gender) }}
                                    </li>
                                    <li>
                                        <span class="text-center"><i class="far fa-envelope"></i></span>
                                        <strong>Email Address</strong> {{ $authUser->email }}
                                    </li>
                                    <li>
                                        <span class="text-center"><i class="fas fa-mobile-alt"></i></span>
                                        <strong>Phone Number</strong> {{ $authUser->phone }}
                                    </li>
                                    <li>
                                        <span class="text-center"><i class="far fa-map"></i></span>
                                        <strong>Address</strong> {{ $authUser->address }}
                                    </li>
                                    <li>
                                        <span class="text-center"><i class="fas fa-history"></i></span>
                                        <strong>Joined Date</strong> {{ $authUser->created_at->toFormattedDateString() }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End of card-body -->

            <div class="card-footer">
                <a href="{{ route('admin#showEditProfilePage') }}" class="btn btn-sm btn-outline-dark float-right rounded-0">
                    <i class="fa fa-edit"></i>&nbsp;
                    Edit Profile
                </a>
            </div>

        </div>
    </div>
</div>

</form>
@endsection