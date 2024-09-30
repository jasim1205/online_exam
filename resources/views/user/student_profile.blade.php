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

                                                @if($profile->image)
                                                    <!-- Show session image if available -->
                                                    <img src="{{ asset('public/uploads/user/'.$profile->image)}}" alt="user">
                                                @else
                                                    @if($profile->gender === 1)
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
														<h5 class="">{{$profile->name}}</h5>
														<div class="staff-id">Username: {{$profile->usernamne}}</div>
														<div class="staff-id">Class: {{$profile->classlist?->name}}</div>
														<div class="small doj text-muted">Date of Join : {{ $profile->created_at}}</div>
														<div class="staff-msg"><a class="btn btn-custom" href="#">Send Message</a></div>
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<div class="title">Phone:</div>
															<div class="text"><a href="">{{$profile->contact_no}}</a></div>
														</li>
														<li>
															<div class="title">Email:</div>
															<div class="text"><a href="">{{$profile->email}}</a></div>
														</li>
														<li>
															<div class="title">Birthday:</div>
															<div class="text">{{$profile->date_of_birth}}</div>
														</li>
														<li>
															<div class="title">Address:</div>
															<div class="text">{{$profile->address}}</div>
														</li>
														<li>
															<div class="title">Gender:</div>
															<div class="text">
                                                                @if($profile->gender == 1)
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
										<div class="pro-edit"><a class="edit-icon" href="{{route('profile_edit',encryptor('encrypt',$profile->id))}}"><i class="fa fa-pencil"></i></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
                </div>
            </div>
			<!-- /Page Wrapper -->
@endsection
