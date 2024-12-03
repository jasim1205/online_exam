@extends('layout.appAuth')
@section('content')
    <div class="account-box shadow-lg">
        <div class="account-wrapper">
             <!-- Title -->
            <h1 class="mb-2">Reset Password</h1>
            <p>Enter the email address associated with account.</p>
            @if (Session::has('message'))
              <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
              </div>
            @endif
            <!-- form Start -->
            <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <!-- Input group -->
                    <div class="input-group input-group-lg">
                      <input class="form-control w-100" type="email" name="email" placeholder="Enter Email" required>
                      @if ($errors->has('email'))
                        <p><span class="text-danger">{{ $errors->first('email') }}</span></p>
                      @endif
                    </div>
                </div>
                <div class="mb-3">
                    <!-- Input group -->
                    <div class="input-group input-group-lg">
                      <input class="form-control w-100" type="text" name="password" placeholder="Enter Pasword" required>
                      @if ($errors->has('password'))
                        <p><span class="text-danger">{{ $errors->first('password') }}</span></p>
                      @endif
                    </div>
                </div>
                <div class="mb-3">
                    <!-- Input group -->
                    <div class="input-group input-group-lg">
                      <input class="form-control w-100" type="text" name="password_confirmation" placeholder="Enter Confirm Pasword" required>
                      @if ($errors->has('password_confirmation'))
                        <p><span class="text-danger">{{ $errors->first('password_confirmation') }}</span></p>
                      @endif
                    </div>
                </div>
                <!-- Button -->
                <div class="d-grid"><button type="submit" class="btn btn-lg btn-primary">Reset Password</button></div>
            </form>
            <!-- form END -->
        </div>
    </div>
@endsection
