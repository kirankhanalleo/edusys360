<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/assets/css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Login | EDUSYS360</title>
    </head>
    <body>
        <div class="loginPage">
            <div class="container">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row loginPage__contents">
                        <div class="col-lg-6 col-md-5 col-left">
                            <img src="{{ asset('assets/assets/images/banner/login-banner.png') }}" alt="banner" class="banner-img">
                        </div>
                        <div class="col-lg-6 col-md-7 p-3 col-right">
                            <img src="{{ asset('assets/assets/images/logo/logo-row.png') }}" alt="edusys360" class="logo-img">
                            <h1 class="loginpage-h1">You're back! Ready to get started?</h1>
                            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                              @csrf 
                              <div class="login-form">
                                    <div class="form-input">
                                        <span class="icon">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" id="email" placeholder="Enter your email address" autofocus>
                                    </div>
                                    @error('email')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                    <div class="form-input">
                                        <span class="icon">
                                            <i class="fa-solid fa-lock"></i>
                                        </span>
                                        <input type="password" name="password" id="password" placeholder="Enter your password">
                                    </div>
                                    @error('email')
                                        <span class="text-danger error-text">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-remember-forget">
                                  <div class="form-remember">
                                  <input type="checkbox">   Remember me
                                </div>
                                <div class="forgot-password">
                                    <a href="{{ route('password.request') }}">Forgot password?</a>
                                </div>
                              </div>
                              <div class="form-bottom">
                                <button type="submit" class="login-btn">Login</button>
                              </div>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <script src="{{ asset('assets/assets/js/bootstrap.min.js') }}"></script>        
    </body>
</html>