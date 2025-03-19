@extends('admin.layouts.master')
@section('pageTitle', 'Profile')
@section('content')
<style type="text/css">
    .myImage {
    width: 120px; /* Adjust as needed */
    height: 120px; /* Keep width and height the same */
    object-fit: cover; /* Ensures proper cropping */
    border-radius: 50%; /* Makes it a perfect circle */
    border: 3px solid #ddd; /* Optional: Adds a border */
}
</style>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            @if (Auth::user()->image_path!="")
                                <img src="<?=Auth::user()->image_path?>"  class="rounded-circle myImage" alt="Profile">
                            @else
                                <img src="{{asset('admin/assets/img/avatar.png')}}" class="rounded-circle myImage" alt="Profile">
                            @endif
                            <h2>{{ Auth::user()->name }}</h2>

                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Name</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->name}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{Auth::user()->phone}}</div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form id="update_profile">

                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                @if (Auth::user()->image_path!="")
                                                    <img src="<?=Auth::user()->image_path?>"  class="myImage" alt="Profile">
                                                @else
                                                    <img src="{{asset('admin/assets/img/avatar.png')}}" class="myImage" alt="Profile">
                                                @endif
                                                <div class="pt-1">
                                                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Select image</label>
                                                    <a class="form-control" title="Upload Profile Image">
                                                        <label  for="update_profile_photo">
                                                            <i class="bi bi-upload"></i>
                                                            <input class="upload-image" type="file" id="picture" >
                                                        </label>
                                                    </a>
                                                    <!--                                                    <a onclick="remove_profile_photo(`<=$user['id']?>`)" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>-->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" required class="form-control" id="name" value="{{Auth::user()->name}}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" readonly class="form-control" id="email" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="tel" class="form-control" id="phone" value="{{Auth::user()->phone}}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" id="edit_profile_btn" class="btn btn-primary">Update Profile</button>
                                        </div>
                                    </form>
                                    <!-- End Profile Edit Form -->

                                </div>
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form id="update_password">

                                        <div class="row mb-3">
                                            <label for="old_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="old_password" type="password" required class="form-control" id="old_password">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" required class="form-control" id="new_password">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="c_password" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="c_password" type="password" required class="form-control" id="confirm_password">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" id="update_password_btn" class="btn btn-primary">Update Password</button>
                                        </div>
                                    </form>
                                    <!-- End Change Password Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


