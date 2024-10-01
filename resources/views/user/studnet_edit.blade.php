@extends('layout.app')
@section('title',trans('Users'))
@section('page',trans('Update'))
@section('content')
<style>
    .form-control {
        border: 1px solid blue;
    }
    .btn-primary {
        background: rgb(53, 99, 197);
    }
    .custom-file-input {
        display: none;
    }
    .custom-file-label {
        display: inline-block;
        cursor: pointer;
        padding: 5px 80px 5px 5px;
        /* background-color: rgb(53, 99, 197); */
        color: rgb(53, 99, 197);
        border-radius: 5px;
        border: 1px solid blue;
        font-weight: 600;
        text-align: center;
    }
    .custom-file-label:hover {
        /* background-color: rgb(40, 75, 150); */
    }
    .custom-file-icon {
        
    }
    .progress-bar {
        height: 5px;
        background-color: rgb(53, 99, 197);
        border-radius: 5px;
        margin-top: 10px;
    }
    .upload{
        margin-top: 80px;
    }
</style>
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">User Update</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                <div class="card-body">
                    <form class="form" method="post" enctype="multipart/form-data" action="{{route('profile_update',encryptor('encrypt',$user->id))}}">
                        @csrf
                        @method('Post')
                        {{-- <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$user->id)}}"> --}}

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <h4>Current Image</h4>
                            <img src="{{ asset('uploads/user/' . $user?->image) }}" alt="Current Logo" width="200px" height="150px" class="shadow">
                        </div>
                        <div class="col-md-4 col-12 mt-5">
                            <div class="form-group upload">
                                <span class="text-danger" style="font-size: small">**Logo size Maximum 2.00 MB and Size 360px & 630px</span>
                                <label for="image" class="custom-file-label">
                                    <i class="bi bi-upload mx-2"></i>Choose new logo
                                </label>
                                <input type="file" id="image" class="custom-file-input" name="image" accept="image/*">
                                <div id="file-size-warning" class="text-danger mt-2" style="display: none;">File size exceeds 2 MB. Please choose a smaller file.</div>
                                <div id="progress-bar" class="progress-bar" style="width: 0%;"></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <h4>Uploaded Logo</h4>
                            <img id="uploadedImagePreview" src="" alt="Uploaded Image Preview" width="200px" height="150px" class="shadow">
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="userName">Name<i class="text-danger">*</i></label>
                                    <input type="text" id="userName" class="form-control" value="{{ old('userName',$user->name)}}" name="userName" placeholder="Enter name">
                                    @if($errors->has('userName'))
                                        <span class="text-danger"> {{ $errors->first('userName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="EmailAddress">Email <i class="text-danger">*</i></label>
                                    <input type="text" id="EmailAddress" class="form-control" value="{{ old('EmailAddress',$user->email)}}" name="EmailAddress" placeholder="john@xyz.com">
                                    @if($errors->has('EmailAddress'))
                                        <span class="text-danger"> {{ $errors->first('EmailAddress') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="contactNumber">Contact Number<i class="text-danger">*</i></label>
                                    <input type="text" id="contactNumber" class="form-control" value="{{ old('contactNumber',$user->contact_no)}}" name="contactNumber" placeholder="01XXXXXXXXXXX" maxlength="13">
                                    @if($errors->has('contactNumber'))
                                        <span class="text-danger"> {{ $errors->first('contactNumber') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">User Name<i class="text-danger">*</i></label>
                                    <input type="text" id="username" class="form-control" value="{{ old('username',$user->username)}}" name="username">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="roleId">Class</label>
                                    <select class="form-control" name="class_id" id="class_id">
                                        <option value="">Select Class</option>
                                        @foreach($classlist as $value)
                                            <option value="{{$value->id}}" {{ old('class_id',$user->class_id)==$value->id?"selected":""}}> {{ $value->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('class_id'))
                                        <span class="text-danger"> {{ $errors->first('class_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Date of Birth</label>
                                    <input type="date" id="date" class="form-control" value="{{ old('date_of_birth',$user->date_of_birth)}}" name="date_of_birth">
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <i class="text-danger">*</i></label>
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Type your password">
                                        @if($errors->has('password'))
                                            <span class="text-danger"> {{ $errors->first('password') }}</span>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="status">Gender</label>
                                    <select id="gender" class="form-control" name="gender">
                                        <option value="">select gender</option>
                                        <option value="1" @if(old('gender',$user->gender)==1) selected @endif>Male</option>
                                        <option value="2" @if(old('gender',$user->gender)==2) selected @endif>Female</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea name="address" id="" class="form-control">{{old('address',$user->address)}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary px-5 py-2 my-1">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script>
    function validateLogo(input) {
    const file = input.files[0];
    const maxSize = 2 * 1024 * 1024; // 2 MB in bytes
    const progressBar = document.getElementById('progress-bar');
    const warning = document.getElementById('file-size-warning');
    const uploadedLogoPreview = document.getElementById('uploadedImagePreview');

    if (file) {
        // Check file size
        if (file.size > maxSize) {
            warning.style.display = 'block';
            progressBar.style.width = '100%';
            uploadedLogoPreview.src = ''; // Clear preview
        } else {
            warning.style.display = 'none';
            progressBar.style.width = '60%'; // Example progress

            // Preview the image using FileReader
            const reader = new FileReader();
            reader.onload = function (e) {
                uploadedLogoPreview.src = e.target.result; // Set preview image source
            };
            reader.readAsDataURL(file); // Trigger FileReader
        }
    } else {
        uploadedLogoPreview.src = ''; // Clear preview if no file is selected
    }
}

// Attach change event listener
document.getElementById('image').addEventListener('change', function () {
    validateLogo(this);
});

</script>
@endsection
