@extends('layouts.main')

@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/file-upload.js') }}"></script>
<div class="content-wrapper">
    @if (url()->current() == Route('adminProfile'))
        <div class="row px-4 py-4 mb-3" style="background-color: #191c24;border-radius:0.5rem">
            <div class="col-md-6 ps-3 text-center">
                <h4 class="align-center">General Account</h4>
            </div>
            <div class="col md-6 ps-3 ">
                <form action="{{ Route('adminChangeProfile') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <div class="mb-2">
                            <span>Profile Photo</span>
                        </div>
                        <div class="profileImg" style="margin-left: 1rem">
                            @if ($data->profile_image)       
                                <img class="img-preview rounded-circle" style="width: 100px;height:100px" src="{{ asset('storage/' . $data->profile_image) }}">
                            @else   
                                <img class="img-preview rounded-circle" style="width: 100px;height:100px" src="https://ui-avatars.com/api/?name={{ $data->username }}&color=7F9CF5&background=EBF4FF">
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <input type="file" id="profile" name="profilePhoto" class="file-upload-default"  onchange="imgPreview()">
                            <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ $data->username }}">
                        @error('username')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ $data->email }}">
                        @error('email')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    @else
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @elseif (session()->has('success'))
            <script>
                swal("Good job!", "Password changed successfully!", "success");
            </script>
        @endif
        <div class="row mt-3 px-4 py-4" id="changePassword" style="background-color: #191c24;border-radius:0.5rem">
            <div class="col-md-6 ps-3 text-center">
                <h4 class="align-center">Change Password</h4>
            </div>
            <div class="col-md-6">
                <form action="{{ Route('adminChangePassword') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" id="current_password" placeholder="Current Password" required>
                        @error('current_password')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" placeholder="New Password" required>
                        @error('new_password')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                        @error('confirm_password')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Change</button>
                </form>
            </div>
        </div>
    @endif
</div>
<script>
    function imgPreview() {
        const image = document.querySelector("#profile");
        const imgPreview = document.querySelector(".img-preview");

        // imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection