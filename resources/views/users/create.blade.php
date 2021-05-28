@extends('layouts.app')

@section('page-header')

<div class="page-header">
    <div class="page-leftheader">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('users') }}">
                    <i class="fe fe-users mr-2 fs-14"></i> List
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="javascript:void(0)">New User</a>
            </li>
        </ol>
        <h4 class="page-title mb-0">Users</h4>
    </div>
    <div class="page-rightheader">
        <div class="btn btn-list">
            
        </div>
    </div>
</div>

@endsection

@section('content')

<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <div class="card box-widget widget-user">
                <div class="widget-user-image mx-auto mt-5">
                    <img id="avatar-img" alt="User Avatar" class="rounded-circle" src="http://127.0.0.1:8000/assets/images/users/1.jpg">
                </div>
                <div class="card-body text-center">
                    <div class="pro-user">
                        <h4 class="pro-user-username text-dark mb-1 font-weight-bold">New User</h4>
                        <input type="file" name="avatar" id="avatar" class="hide">
                        <button type="button" class="btn btn-primary mt-3" onclick="triggerUploadProfileImage()">
                            <i class="fe fe-upload"></i> Upload Profile Picture
                        </button>
                    </div>
                </div>
                <div class="card-footer p-0">
                    
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="first_name">First Name</label>
                            <input type="text" class="form-control mb-1 @error('first_name') is-invalid @enderror"
                                name="first_name" id="first_name" value="{{ old('first_name') }}">
                            @error('first_name') 
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input type="text" class="form-control mb-1 @error('last_name') is-invalid @enderror"
                                name="last_name" id="last_name" value="{{ old('last_name') }}">
                            @error('last_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" class="form-control mb-1 @error('email') is-invalid @enderror"
                                name="email" id="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-control custom-select select2 mb-1 @error('status') is-invalid @enderror" 
                                name="status" id="status">
                                @foreach(\App\Models\User::STATUSES as $status)
                                    <option value="{{ $status }}" @if(old('status') == $status) selected @endif>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control mb-1 @error('password') is-invalid @enderror"
                                name="password" id="password">
                            @error('password') 
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-6 form-group">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control mb-1 @error('confirm_password') is-invalid @enderror"
                                name="confirm_password" id="confirm_password">
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
            </div>
        </div>
    </div>
</form>

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