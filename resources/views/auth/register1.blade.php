<!DOCTYPE html>
<html lang="en">
<head>
	<title>I-Seuramoe | Register</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome.min.css') }}"> 
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/material-design-iconic-font.min.css') }}">
	
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"> -->
<!--===============================================================================================-->	
	<!-- <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css"> -->
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css"> -->
<!--===============================================================================================-->	
	<!-- <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"> -->
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
	
<!--===============================================================================================-->
</head>
<body>
	


	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/Home.png');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                    @csrf


					<span class="login100-form-title p-b-34 p-t-27">
						Registrasi
					</span>

					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
									<span class="font-medium">Warning alert!</span> {{ $error }}.
								  </div>
							@endforeach
						</ul>
					</div>
				@endif

					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" id="email" type="email" name="email" placeholder="">
						<span class="focus-input100" data-placeholder="Email"></span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" id="name" type="text" name="name" placeholder="">
						<span class="focus-input100" data-placeholder="Nama"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" id="password" type="password" name="password" placeholder="">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" id="password_confirmation" type="password" name="password_confirmation" placeholder="">
						<span class="focus-input100" data-placeholder="Konfirmasi Password"></span>
					</div>

					{{-- <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div> --}}

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Register
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="/login">
							Sudah Punya Akun?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	{{-- <script src="vendor/animsition/js/animsition.min.js"></script> --}}
<!--===============================================================================================-->
	<script src="{{ asset('js/popper.js') }}"></script>
	{{-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> --}}
<!--===============================================================================================-->
	{{-- <script src="vendor/select2/select2.min.js"></script> --}}
<!--===============================================================================================-->
	{{-- <script src="vendor/daterangepicker/moment.min.js"></script> --}}
	{{-- <script src="vendor/daterangepicker/daterangepicker.js"></script> --}}
<!--===============================================================================================-->
	{{-- <script src="vendor/countdowntime/countdowntime.js"></script> --}}
<!--===============================================================================================-->
	<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>