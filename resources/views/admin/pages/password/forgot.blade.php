@extends('layouts.login')
@section('content')
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <h4>Forgot Password</h4>
            <h6 class="font-weight-light">Reset your admin password.</h6>
            @if (session('message'))
              <div class="alert alert-{{ session('alert-type') }} alert-dismissible fade show">{{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <form class="pt-3" method="post" action="/admin/forgot-password">
              @csrf
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Registered email" value="{{ old('email') }}" required>
              </div>
              @error('email')<div class="text-danger">{{ $message }}</div>@enderror
              <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="New password" required>
              </div>
              @error('password')<div class="text-danger">{{ $message }}</div>@enderror
              <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation" placeholder="Confirm password" required>
              </div>
              <div class="mt-3">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Reset Password</button>
              </div>
              <div class="text-center mt-4 font-weight-light">
                Remembered? <a href="/admin" class="text-primary">Back to Sign In</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection