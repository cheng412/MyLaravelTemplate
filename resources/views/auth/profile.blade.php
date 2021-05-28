@extends('layouts.app')

@section('page-header')

<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Edit Profile</h4>
    </div>
    <div class="page-rightheader">
        <div class="btn btn-list">
            
        </div>
    </div>
</div>

@endsection

@section('content')

<div class="row">
    <div class="col-sm-12 col-md-3">
        <div class="card box-widget widget-user">
            <div class="widget-user-image mx-auto mt-5">
                <img id="avatar-img" alt="User Avatar" class="rounded-circle" src="{{ $user->avatar_url }}">
            </div>
            <div class="card-body text-center">
                <div class="pro-user">
                    <h4 class="pro-user-username text-dark mb-1 font-weight-bold">{{ $user->fullname }}</h4>
                    <button type="button" class="btn btn-primary mt-3" onclick="triggerUploadProfileImage()">
                        <i class="fe fe-upload"></i> Upload Profile Picture
                    </button>
                </div>
            </div>
        </div>

        <div class="card">
            <form action="{{ route('profile.change-password') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label class="form-label" for="old_password">Old Password</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="old_password">
                            @error('old_password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label" for="password">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label" for="confirm_password">Confirm New Password</label>
                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password">
                            @error('confirm_password')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fe fe-save mr-1"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-12 col-md-9">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="file" name="avatar" id="avatar" class="hide">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="first_name">First Name</label>
                            <input type="text" class="form-control mb-1 @error('first_name') is-invalid @enderror"
                                name="first_name" id="first_name" value="{{ $user->first_name }}">
                            @error('first_name') 
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input type="text" class="form-control mb-1 @error('last_name') is-invalid @enderror"
                                name="last_name" id="last_name" value="{{ $user->last_name }}">
                            @error('last_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" class="form-control mb-1 @error('email') is-invalid @enderror"
                                name="email" id="email" value="{{ $user->email }}">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fe fe-save mr-1"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
    <script>
        function triggerUploadProfileImage() {
            $('#avatar').click()
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#avatar-img').attr('src', e.target.result)
                }
                
                reader.readAsDataURL(input.files[0])
            }
        }

        $("#avatar").change(function() {
            readURL(this);
        })
    </script>
@endsection