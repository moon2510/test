<!DOCTYPE html>
<html>
<head>
	<title>@yield('page-title')</title>
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Main Page CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<!-- Custom CSS -->
	@yield('custom-css')
</head>
<body>
	<div class="header-top">
		<div class="row justify-content-center">
			<div class="col-11 col-xl-9">
				<div class="d-sm-flex justify-content-between">
					<ul>
						<li><a href="tel:+01432152323"><span class="align-middle"><i class="fas fa-mobile-alt"></i></span>+01432152323</a></li>
						<li><a href="mailto:info@example.com"><span class="align-middle"><i class="fas fa-envelope-open-text"></i></span>info@example.com</a></li>
					</ul>
					<ul>
						<li><a href="{{ route('contact_us') }}">Contact Us</a></li>
						@if(Auth::check())
						@if(Auth::user()->roles == 1)
						<li><a href="{{ route('admin-home') }}">Admin Controll </a></li>
						@endif
						<li>
							<a href="{{ route('account_profile') }}">
								@if(Auth::user()->image == null)
								<img class="avatar" src="{{ asset('images/default.png') }}" class="img-responsive" alt="">
								@else
								<img class="avatar" src="{{ asset(Auth::user()->image) }}" class="img-responsive" alt="">
								@endif
								Hello , <?php echo Auth::user()->firstname ?>
							</a>
						</li>
						<li><a href="{{ route('logout') }}">Logout</a></li>
						@else
						<li><a href="{{ route('login') }}">Login</a></li>
						<li><a href="{{ route('register') }}">Register</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="header-middle">
		<div class="row justify-content-center">
			<div class="col-11 col-xl-10">
				<div class="row">
					<div class="col-12 col-xl-3">
						<a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="" height="100px" style="display:block;margin: 0 auto;"></a>
					</div>
					<div class="col-12 col-md-10 col-xl-6">
						<div class="wrap">
							<div class="search">
								<form class="input-group" action="{{ route('search') }}" method="get">
									<input type="text" name="keysearch" class="searchTerm search-inputt" placeholder="What are you looking for?">
									<button type="submit" class="searchButton">
										<i class="fas fa-search"></i>
									</button>
								</form>
							</div>
						</div>
					</div>
					<div class="d-none d-md-block col-md-2 col-xl-3 cartt">
						@if(!session()->get('cart'))
						<a href="{{ route('cart') }}"><i class="fas fa-shopping-cart carticon"></i>Cart : <p class="cartnumber">0</p></a>
						@else
						<a href="{{ route('cart') }}"><i class="fas fa-shopping-cart carticon"></i>Cart : <p class="cartnumber">{{count(session()->get('cart'))}}</p></a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	
	<div class="row d-flex justify-content-center">
		<div class="col-11 col-xl-9">
			@if(session('class_newsletter'))
			<div class="alert alert-{{session('class_newsletter')}} alert-dismissible fade show">
				<p>{{session('message')}}</p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			@yield('page-content')
		</div>
	</div>
	
	<!-- Footer -->
	<footer class="page-footer font-small unique-color-dark">
		<div style="background-color: #e74c3c;">
			<div class="row justify-content-center news_sletter">
				<div class="col-11 col-md-8">
					<div class="row">
						<div class="col-12 col-md-5">
							<p class="h3 text-white text-center">Sign up for our newsletter</p>
						</div>
						<div class="col-12 col-md-7">
							<form class="input-group" method="post" action="{{ route('newsletter_subscribe') }}">
								@csrf
								<input type="email" class="form-control" name="email" value="Input your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
								<button class="btn btn-default" type="submit">Submit</button> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row justify-content-center mt-5 text-center text-md-left">
			<div class="col-11 col-md-8 mb-4">
				<div class="row justify-content-center">
					<div class="col-12 col-md-6 col-xl-3 mx-auto mb-4">
						<h6 class="text-uppercase font-weight-bold title">Online Library</h6>
						<p>Welcome to the Online Library
						A service dedicated to students of all learning community. We provide online resources, professional support and guidance to all our students whenever, and from wherever they have chosen to study..</p>
					</div>

					<div class="d-none d-md-block col-md-6  col-xl-3 mx-auto mb-4">
						<h6 class="text-uppercase font-weight-bold title"> My Account</h6>
						<p>
							<a href="{{ route('account_profile') }}"><i class="fa fa-angle-double-right"></i> Your Account</a>
						</p>
						<p>
							<a href="{{ route('cart') }}"><i class="fa fa-angle-double-right"></i> Cart</a>
						</p>
						<p>
							<a href="{{ route('order_history') }}"><i class="fa fa-angle-double-right"></i> Order History</a>
						</p>
					</p>
					<p>
						<a href="{{ route('napthe') }}"><i class="fa fa-angle-double-right"></i> Nap The</a>
					</p>
				</div>

				<div class="d-none d-md-block col-md-6 col-xl-3 mx-auto mb-4">
					<h6 class="text-uppercase font-weight-bold title">Useful links</h6>
					<p>
						<a href="{{ route('contact_us') }}"><i class="fa fa-angle-double-right"></i> Contact Us</a>
					</p>
					<p>
						<a href="{{ route('search') }}"><i class="fa fa-angle-double-right"></i> Search</a>
					</p>
				</div>

				<div class="col-12 col-md-6 col-xl-3 mx-auto mb-4">
					<h6 class="text-uppercase font-weight-bold title">Contact</h6>
					<p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
					<p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
					<p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
					<p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-copyright text-center py-3">© 2019 Copyright:
		<a href="{{ route('home') }}"> OnlineLibrary.com</a>
	</div>
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<!-- Custom JS-->
<script type="text/javascript" src="{{ asset('js/search_main.js') }}"></script>
@yield('custom-js')	
</body>
</html>