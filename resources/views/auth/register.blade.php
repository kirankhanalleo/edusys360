<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Edusys360 - Register</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bundles/jquery-selectric/selectric.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header" style="padding-top:20px;">
                <h4><span >REGISTER NEW ACCOUNT !</span></h4>
                <span>EDUSYS360 - COMPLETE COLLEGE MANAGEMENT SYSTEM </span>
              </div>
              <div class="card-body">
                <form method="POST" action={{ route('register') }}>
                @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name">
                    @error('name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email">
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <label style="float:right;">(Must be 8 characters long, contain atleast one uppercase, one lowercase and one numeric value)</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator"
                        name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                      @error('password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                      <br>
                    <div class="form-group">
                      <label for="password_confirmation" >Confirm Password</label>
                      <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                      @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
              <div class="mb-4 text-muted text-center">
                Already Registered? <a href="{{ route('login') }}">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
  <script src="{{ asset('assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>