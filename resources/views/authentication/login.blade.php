@extends('layout.appAuth')
@section('content')
        <div class="account-box">
            <div class="account-wrapper">
                <h3 class="account-title">Login</h3>
                <p class="account-subtitle">Access to our dashboard</p>

                <!-- Account Form -->
                <form action="{{route('login.check')}}" method="POST" class="">
                    @csrf
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" value="{{old('username')}}">
                        @if($errors->has('username'))
                            <small class="d-block text-danger fw-bold">
                                {{$errors->first('username')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label>Password</label>
                            </div>
                            {{-- <div class="col-auto">
                                <a class="text-muted" href="forgot-password.html">
                                    Forgot password?
                                </a>
                            </div> --}}
                        </div>
                        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
                        @if($errors->has('password'))
                            <small class="d-block text-danger fw-bold">
                                {{$errors->first('password')}}
                            </small>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary account-btn" type="submit">Login</button>
                    </div>
                    <div class="account-footer">
                        <p>Don't have an account yet? <a href="{{route('register')}}">Register</a></p>
                    </div>
                </form>
                <!-- /Account Form -->

            </div>
        </div>
@endsection