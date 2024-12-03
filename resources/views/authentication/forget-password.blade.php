@extends('layout.appAuth')
@section('content')
    <div class="account-box shadow-lg">
        <div class="account-wrapper">
            <h1 class="mb-2">Forgot password?</h1>
            <p>Enter the email address associated with account.</p>
            <!-- Account Form -->
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            <!-- Account Form -->
            <form action="{{route('forget.password.post')}}" method="POST" class="">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-xl" name="email" placeholder="Enter Email">
                    @if($errors->has('email'))
                        <small class="d-block text-danger fw-bold">
                            {{$errors->first('email')}}
                        </small>
                    @endif
                </div>
                <p>Back to <a href="{{ route('login') }}">Sign in</a></p>
                <div class="form-group text-center">
                    <button class="btn btn-primary account-btn" type="submit">Send Password Reset Link</button>
                </div>
                <div class="account-footer">
                    <!-- Copyright -->
                    <p class="mb-0 mt-3">©2024 <a target="_blank" href="">Online Exam</a> All rights reserved</p>
                </div>

            </form>
            <!-- /Account Form -->
        </div>
    </div>
@endsection
