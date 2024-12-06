@extends('layout.app')

@section('title', trans('Users'))
@section('page', trans('Create'))

@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">User Add</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card">
                <div class="card-body">
                    <form class="form" method="post" enctype="multipart/form-data" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="roleId">Role <i class="text-danger">*</i></label>
                                    <select class="form-control" name="roleId" id="roleId">
                                        <option value="">Select Role</option>
                                        @forelse($role as $r)
                                            <option value="{{ $r->id }}" {{ old('roleId') == $r->id ? 'selected' : '' }}>
                                                {{ $r->name }}</option>
                                        @empty
                                            <option value="">No Role found</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('roleId'))
                                        <span class="text-danger"> {{ $errors->first('roleId') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="fullAccess">Full Access</label>
                                    <select id="fullAccess" class="form-control" name="fullAccess">
                                        <option value="0" @if (old('fullAccess') == 0) selected @endif>No</option>
                                        <option value="1" @if (old('fullAccess') == 1) selected @endif>Yes
                                        </option>
                                    </select>
                                    @if ($errors->has('fullAccess'))
                                        <span class="text-danger"> {{ $errors->first('fullAccess') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="userName">Name<i class="text-danger">*</i></label>
                                    <input type="text" id="userName" class="form-control" value="{{ old('userName') }}"
                                        name="userName" placeholder="Enter name">
                                    @if ($errors->has('userName'))
                                        <span class="text-danger"> {{ $errors->first('userName') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="EmailAddress">Email <i class="text-danger">*</i></label>
                                    <input type="text" id="EmailAddress" class="form-control"
                                        value="{{ old('EmailAddress') }}" name="EmailAddress" placeholder="john@xyz.com">
                                    @if ($errors->has('EmailAddress'))
                                        <span class="text-danger"> {{ $errors->first('EmailAddress') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">User Name<i class="text-danger">*</i></label>
                                    <input type="text" id="username" class="form-control"
                                        value="{{ old('username') }}" name="username">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="contactNumber">Contact Number<i class="text-danger">*</i></label>
                                    <input type="text" id="contactNumber" class="form-control"
                                        value="{{ old('contactNumber') }}" name="contactNumber" placeholder="01XXXXXXXXXXX"
                                        maxlength="13">
                                    @if ($errors->has('contactNumber'))
                                        <span class="text-danger"> {{ $errors->first('contactNumber') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Class</label>
                                    <select class="form-control" name="class_id" id="class_id">
                                        <option value="">Select Class</option>
                                        @foreach ($classlist as $value)
                                            <option value="{{ $value->id }}">
                                                {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('class_id'))
                                        <span class="text-danger"> {{ $errors->first('class_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="password">Password <i class="text-danger">*</i></label>
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Type your password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger"> {{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control" name="status">
                                        <option value="1" @if (old('status', 1) == 1) selected @endif>Active
                                        </option>
                                        <option value="0" @if (old('status', 1) == 0) selected @endif>Inactive
                                        </option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="text-danger"> {{ $errors->first('status') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" class="form-control" placeholder="Image"
                                        name="image">
                                    @if ($errors->has('image'))
                                        <span class="text-danger"> {{ $errors->first('image') }}</span>
                                    @endif
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

@endsection
