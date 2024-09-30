@extends('layout.app')
@section('title',trans('Employees'))
@section('page',trans('Profile'))
@section('content')
<style>
.profile .profile-card img {
  max-width: 120px;
}

.profile .profile-card h2 {
  font-size: 24px;
  font-weight: 700;
  color: #2c384e;
  margin: 10px 0 0 0;
}

.profile .profile-card h3 {
  font-size: 18px;
}

.profile .profile-card .social-links a {
  font-size: 20px;
  display: inline-block;
  color: rgba(1, 41, 112, 0.5);
  line-height: 0;
  margin-right: 10px;
  transition: 0.3s;
}

.profile .profile-card .social-links a:hover {
  color: #012970;
}

.profile .profile-overview .row {
  margin-bottom: 20px;
  font-size: 15px;
}

.profile .profile-overview .card-title {
  color: #012970;
}

.profile .profile-overview .label {
  font-weight: 600;
  color: rgba(1, 41, 112, 0.6);
}

.profile .profile-edit label {
  font-weight: 600;
  color: rgba(1, 41, 112, 0.6);
}

.profile .profile-edit img {
  max-width: 120px;
}
</style>
<!-- Page Wrapper -->
            <div class="page-wrapper">
{{-- {{ dd(request()->session()->all()) }} --}}

				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Profile</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">{{encryptor('decrypt',request()->session()->get('role'))}}</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="card mb-0">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
										<div class="profile-img-wrap">
											<div class="profile-img">
                                                @if(request()->session()->has('image') && request()->session()->get('image') != 'no-image.png')
                                                    <!-- Show session image if available -->
                                                    <img src="{{ asset('public/uploads/user/' . request()->session()->get('image')) }}" alt="user">
                                                @else
                                                    @if((int) request()->session()->get('gender') === 1)
                                                        <img src="{{ asset('assets/img/profiles/avatar_male.png') }}" alt="Male">
                                                    @else
                                                        <img src="{{ asset('assets/img/profiles/avatar_female.png') }}" alt="Female">
                                                    @endif
                                                @endif
											</div>
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0 mb-0"></h3>
														<h5 class="">{{encryptor('decrypt',request()->session()->get('Name'))}}</h5>
														<div class="staff-id">Username: {{encryptor('decrypt',request()->session()->get('Name'))}}</div>
														<div class="small doj text-muted">Date of Join : {{ encryptor('decrypt', request()->session()->get('join'))}}</div>
														<div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div>
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<div class="title">Phone:</div>
															<div class="text"><a href="">{{request()->session()->get('contact')}}</a></div>
														</li>
														<li>
															<div class="title">Email:</div>
															<div class="text"><a href="">{{request()->session()->get('email')}}</a></div>
														</li>
														<li>
															<div class="title">Birthday:</div>
															<div class="text">{{request()->session()->get('birthday')}}</div>
														</li>
														<li>
															<div class="title">Address:</div>
															<div class="text">{{request()->session()->get('address')}}</div>
														</li>
														<li>
															<div class="title">Gender:</div>
															<div class="text">
                                                                @if(request()->session()->get('gender') == 1)
                                                                    Male
                                                                @else
                                                                    Female
                                                                @endif
                                                            </div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="pro-edit"><a class="edit-icon" href="{{route('user.edit',encryptor('encrypt',$profile->id))}}"><i class="fa fa-pencil"></i></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					{{-- <div class="tab-content">
						<div id="emp_profile" class="pro-overview">
							<div class="row">
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title">Personal Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
											<ul class="personal-info">
												<li>
													<div class="title">Passport No.</div>
													<div class="text">9876543210</div>
												</li>
												<li>
													<div class="title">Passport Exp Date.</div>
													<div class="text">9876543210</div>
												</li>
												<li>
													<div class="title">Tel</div>
													<div class="text"><a href="">9876543210</a></div>
												</li>
												<li>
													<div class="title">Nationality</div>
													<div class="text">Indian</div>
												</li>
												<li>
													<div class="title">Religion</div>
													<div class="text">Christian</div>
												</li>
												<li>
													<div class="title">Marital status</div>
													<div class="text">Married</div>
												</li>
												<li>
													<div class="title">Employment of spouse</div>
													<div class="text">No</div>
												</li>
												<li>
													<div class="title">No. of children</div>
													<div class="text">2</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title">Emergency Contact <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h3>
											<h5 class="section-title">Primary</h5>
											<ul class="personal-info">
												<li>
													<div class="title">Name</div>
													<div class="text">John Doe</div>
												</li>
												<li>
													<div class="title">Relationship</div>
													<div class="text">Father</div>
												</li>
												<li>
													<div class="title">Phone </div>
													<div class="text">9876543210, 9876543210</div>
												</li>
											</ul>
											<hr>
											<h5 class="section-title">Secondary</h5>
											<ul class="personal-info">
												<li>
													<div class="title">Name</div>
													<div class="text">Karen Wills</div>
												</li>
												<li>
													<div class="title">Relationship</div>
													<div class="text">Brother</div>
												</li>
												<li>
													<div class="title">Phone </div>
													<div class="text">9876543210, 9876543210</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> --}}
                </div>
            </div>
			<!-- /Page Wrapper -->
{{-- <header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
    <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Profile</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
            <nav
                aria-label="breadcrumb"
                class="breadcrumb-header float-start float-lg-end"
            >
                <ol class="breadcrumb">
               <li class="breadcrumb-item">
                    <a href="{{ currentUser() == 'employee' ? route('employee.dashboard') : route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Profile
                </li>
                </ol>
            </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                    <section class="section profile">
                    <div class="row">
                        <div class="col-sm-4">

                       <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                @if ($employee->image)
                                    <img src="{{ asset('public/uploads/employee/' . $employee->image) }}" alt="Profile" class="rounded-circle">
                                @else
                                    <img src="{{ asset('public/assets/images/profile.png') }}" alt="Profile" >
                                @endif
                                <h2>{{$employee->name}}</h2>
                                <h3 class="text-center">{{$employee->designation}}</h3>
                                <h6 class="text-center">{{$employee->employee_id}}</h6>
                                <form id="deleteImageForm" action="{{ route('profile.deleteImage') }}" method="post" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @if ($employee->image)
                                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"
                                        onclick="event.preventDefault(); document.getElementById('deleteImageForm').submit();">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                @endif
                               
                            </div>
                        </div>


                        </div>

                        <div class="col-sm-8">

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
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->name}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Company</div>
                                    <div class="col-lg-9 col-md-8">Zoom Logistics Limited</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8">Bangladesh</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Designation</div>
                                    <div class="col-lg-9 col-md-8">{{$employee?->designation}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Employee ID</div>
                                    <div class="col-lg-9 col-md-8">{{$employee?->employee_id}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                                    <div class="col-lg-9 col-md-8">{{$employee?->date_of_birth}}</div>
                                </div>                             

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->contact_no}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->email}}</div>
                                </div>

                                 <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{$employee?->address}}</div>
                                </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form class="form" method="post" enctype="multipart/form-data" action="{{route('profile.save')}}">
                                 @csrf
                                    <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input type="file" id="image" class="form-control" placeholder="Image" name="image">
                                        @if($errors->has('image'))
                                            <span class="text-danger"> {{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text" class="form-control" id="name" value="{{ old('name',$employee->name)}}" readonly>
                                    </div>
                                    </div>

                                    

                                    <div class="row mb-3">
                                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="company" type="text" class="form-control" id="company" value="Zoom Logistics Limited" readonly>
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="country" type="text" class="form-control" id="Country" value="Bangladesh" readonly>
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                    <label for="designation" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="designation" type="text" class="form-control" id="Job" value="{{ old('designation',$employee->designation)}}" readonly>
                                    </div>
                                    </div>

                                     <div class="row mb-3">
                                    <label for="date_of_birth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="date_of_birth" type="date" class="form-control" id="date_of_birth" value="{{ old('date_of_birth',$employee->date_of_birth)}}">
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                    <label for="contact_no" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="contact_no" type="text" class="form-control" id="contact_no" value="{{ old('contact_no',$employee->contact_no)}}">
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email" class="form-control" id="Email" value="{{ old('email',$employee->email)}}">
                                    </div>
                                    </div>    
                                    
                                     <div class="row mb-3">
                                    <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="address" type="text" class="form-control" id="Address" value="{{ old('address',$employee->address)}}">
                                    </div>
                                    </div>

                                    <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                                </div>

                               
                                <div class="tab-pane fade pt-3" id="profile-change-password">                                
                                    <form class="form" method="post" action="{{ route('change.password') }}">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="current_password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current_password" type="password" class="form-control" id="current_password" required>
                                                 @if($errors->has('current_password'))
                                                    <span class="text-danger"> {{ $errors->first('current_password') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="password">
                                            </div>
                                             @if($errors->has('password'))
                                                <span class="text-danger"> {{ $errors->first('password') }}</span>
                                            @endif
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password_confirmation" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation">
                                            </div>
                                             @if($errors->has('password_confirmation'))
                                                <span class="text-danger"> {{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>
                                </div>


                            </div><!-- End Bordered Tabs -->

                            </div>
                        </div>

                        </div>
                    </div>
                    </section>
            </div>
        </div>
    </section>
</div> --}}
@endsection
