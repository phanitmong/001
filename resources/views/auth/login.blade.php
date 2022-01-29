{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


<!doctype html>
<html lang="en-US">
<head>
   <!-- Required meta tags -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>ចូលគណនី</title>
   <!-- Favicon -->
   <link rel="shortcut icon" href="images/favicon.ico"/>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="{{asset('logins/css/bootstrap.min.css')}}"/>
   <!-- Typography CSS -->
   <link rel="stylesheet" href="{{asset('logins/css/typography.css')}}">
   <!-- Style -->
   <link rel="stylesheet" href="{{asset('logins/css/style.css')}}"/>
   <!-- Responsive -->
   <link rel="stylesheet" href="{{asset('logins/css/bootstrap.min.css')}}"/>
   <style>
       *
       {
           font-family: koulen;
       }
   </style>
</head>
<body>

<!-- loader Start -->
<!-- <div id="loading">
   <div id="loading-center">
   </div>
</div> -->
<!-- loader END -->
<!-- MainContent -->
<section class="sign-in-page">
   <div class="container">
      <div class="row justify-content-center align-items-center height-self-center">
         <div class="col-lg-5 col-md-12 align-self-center">
            <div class="sign-user_card ">
               <div class="sign-in-page-data">
                  <div class="sign-in-from w-100 m-auto">
                     <h3 class="mb-3 text-center " style="color: rgb(4, 114, 4)">ប្រព័ន្ធគ្រប់គ្រង អាជីវកម្ម</h3>
                     <h6 class="text-center text-white">សរសេរដោយ មោង ផានិត ទំនាក់ទំនង  096 453 6660</h6>
                     <form class="mt-4" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                           <input type="text" class="form-control mb-0"  name="username" placeholder="បញ្ចូលឈ្មោះគណនី" autocomplete="off" required style="color: white">

                           @error('username')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror
                        </div>
                        <div class="form-group">
                           <input type="password"  name='password' class="form-control mb-0" id="exampleInputPassword2" placeholder="បញ្ចូលពាក្យសម្ងាត់" required style="color: white">
                           @error('password')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror
                        </div>

                        @if ($errors->any())
                           <small class="text-center text-warning">គណនីមិនត្រឹមត្រូវ សូមមេត្តាពិនិត្យ អោយបានត្រឹមត្រូវម្តងទៀត</small>
                        @endif

                           <div class="sign-info mt-2">
                              <button type="submit" class="btn btn-hover">ចូលគណនី</button>
                              <div class="custom-control custom-checkbox d-inline-block">
                                 <input type="checkbox" class="custom-control-input" id="customCheck">
                                 {{-- <label class="custom-control-label" for="customCheck"></label> --}}
                              </div>
                           </div>

                     </form>
                  </div>
               </div>
               <div class="mt-3">

               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- MainContent End-->
<div class="rtl-box">
   <button type="button" class="btn btn-light rtl-btn">
         <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 20 20" fill="white">
         <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
         </svg>
   </button>
   <div class="rtl-panel">
      <ul class="modes">
         <li class="dir-btn"  data-mode="rtl" data-active="false" data-value="ltr"><a href="#">LTR</a></li>
         <li class="dir-btn" data-mode="rtl" data-active="true"   data-value="rtl"><a href="#">RTL</a></li>
      </ul>
   </div>
</div>

<!-- back-to-top End -->
<!-- jQuery, Popper JS -->
<script src="{{asset('logins/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('logins/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('logins/js/bootstrap.min.js')}}"></script>
<!-- Slick JS -->
<script src="{{asset('logins/js/slick.min.js')}}"></script>
<!-- owl carousel Js -->
<script src="{{asset('logins/js/owl.carousel.min.js')}}"></script>
<!-- select2 Js -->
<script src="{{asset('logins/js/select2.min.js')}}"></script>
<!-- Magnific Popup-->
<script src="{{asset('logins/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Slick Animation-->
<script src="{{asset('logins/js/slick-animation.min.js')}}"></script>
<!-- Custom JS-->
{{-- <script src="{{asset('logins/js/custom.js')}}"></script> --}}
 <!-- rtl -->
 <script src="{{asset('logins/js/rtl.js')}}"></script>
</body>
</html>
