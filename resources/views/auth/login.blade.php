<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login - Edusys360</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bundles/bootstrap-social/bootstrap-social.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href='{{ asset('') }}assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container py-4 mt-5">
        <div class="row">
          <div class="col-10 offset-1">
            <div class="card card-primary">
              <div class="row">
              <div class="col-5 mx-4 my-4">
                <img src="{{ asset('assets/img/banner/login-banner.png') }}" style="height:400px;" alt="">
              </div>
              <div class="col-6 px-4 py-2">
              <div class="card-header py-4">
                <h4 style="text-align: center;">EDUSYS 360 - COMPLETE COLLEGE MANAGEMENT SYSTEM</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf  
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                            <div class="float-right">
                                <a href="{{ route('password.request') }}" class="text-small">
                                Forgot Password?
                                </a>
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                        </button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
  </div>
  <!-- General JS Scripts -->{{ asset('') }}
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>