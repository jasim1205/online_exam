@extends('layout.appAuth')
@section('content')
        <div class="account-box">
            <div class="account-wrapper">
                <h3 class="account-title">Register</h3>
                <div class="text-center">
                    <img src="{{ asset('assets/img/images-removebg-preview.png') }}" alt="" width="200px">
                </div>
                {{-- <p class="account-subtitle">Access to our dashboard</p> --}}
                
                <!-- Account Form -->
                <form action="{{route('register.store')}}" method="POST">
								@csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="FullName">
                        @if($errors->has('FullName'))
                            <small class="d-block text-danger">
                                {{$errors->first('FullName')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="EmailAddress">
                        @if($errors->has('EmailAddress'))
                            <small class="d-block text-danger">
                                {{$errors->first('EmailAddress')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input class="form-control" type="text" name="contact_no">
                        @if($errors->has('contact_no'))
                            <small class="d-block text-danger">
                                {{$errors->first('contact_no')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group d-flex">
                        <input type="radio" id="male" name="gender" value="1">
                        <label for="male" class="mx-2">Male</label><br>
                        <input type="radio" id="female" name="gender" value="2">
                        <label for="female" class="mx-2">Female</label><br>
                        <input type="radio" id="other" name="gender" value="1">
                        <label for="other" class="mx-2">Other</label>
                        @if($errors->has('gender'))
                            <small class="d-block text-danger">
                                {{$errors->first('gender')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username">
                        @if($errors->has('username'))
                            <small class="d-block text-danger">
                                {{$errors->first('username')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Class</label>
                        <select name="class_id" id="" class="form-control">
                            <option value="">Select Class</option>
                            @foreach ($classlist as $item)
                              <option value="{{$item->id}}">{{$item->name}}</option>  
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password">
                        @if($errors->has('password'))
                            <small class="d-block text-danger">
                                {{$errors->first('password')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Repeat Password</label>
                        <input class="form-control" type="password" name="password_confirmation">
                        @if($errors->has('password'))
                            <small class="d-block text-danger">
                                {{$errors->first('password')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary account-btn" type="submit">Register</button>
                    </div>
                    <div class="account-footer">
                        <p>Already have an account? <a href="{{route('login')}}">Login</a></p>
                    </div>
                </form>
                <!-- /Account Form -->
            </div>
        </div>
@endsection