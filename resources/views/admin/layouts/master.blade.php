<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Online Library - Administrator</title>
	<link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('admin_assets/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('admin_assets/css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('admin_assets/css/styles.css') }}" rel="stylesheet">
	<!-- alertify -->
	<link href="{{ asset('admin_assets/css/alertify.css') }}" rel="stylesheet">
	<!-- dropify -->
	<link rel="stylesheet" href="{{ asset('admin_assets/css/dropify.min.css') }}">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="{{url('')}}"><span>Home</span></a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="{{(Auth::user()->image == '') ? asset('images/default.png') : asset(Auth::user()->image)}}" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Administrator</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li><a href="{{ route('admin-home') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="parent "><a data-toggle="collapse" href="#slider-item">
				<em class="fa fa-image">&nbsp;</em> Slider <span data-toggle="collapse" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="slider-item">
					<li><a class="" href="{{ route('Slider.Create') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Add New Slider
					</a></li>
					<li><a class="" href="{{ route('Slider.List') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> List Slider
					</a></li>
				</ul>
			</li>
			<li><a href="{{ route('Category.List') }}"><em class="fa fa-folder-open">&nbsp;</em> Category</a></li>
			<li class="parent "><a data-toggle="collapse" href="#books-item">
				<em class="fa fa-book">&nbsp;</em> Books <span data-toggle="collapse" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="books-item">
					<li><a class="" href="{{ route('Book.Create') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Add New Book
					</a></li>
					<li><a class="" href="{{ route('Book.List') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> List Books
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#user-item">
				<em class="fa fa-user">&nbsp;</em> User <span data-toggle="collapse" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="user-item">
					<li><a class="" href="{{ route('User.Create') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Add New User
					</a></li>
					<li><a class="" href="{{ route('User.List') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> List Users
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#order-item">
				<em class="fa fa-clipboard">&nbsp;</em> Order <span data-toggle="collapse" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="order-item">
					<li><a class="" href="{{ route('Order.List', 1) }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Order Wait
					</a></li>
					<li><a class="" href="{{ route('Order.List', 2) }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Order Confirmed
					</a></li>
					<li><a class="" href="{{ route('Order.List', 4) }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Order Borrowing
					</a></li>
					<li><a class="" href="{{ route('Order.List', 5) }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Order History
					</a></li>
					<li><a class="" href="{{ route('Order.List', 3) }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Order Cancelled
					</a></li>
					<li><a class="" href="{{ route('Order.Create') }}">
						<span class="fa fa-arrow-right">&nbsp;</span> Add New Order
					</a></li>
				</ul>
			</li>
			<li><a href="{{ route('LostBook.List') }}"><em class="fa fa-book">&nbsp;</em> Lost Books</a></li>
			<li><a href="{{ route('Comment.List') }}"><em class="fa fa-comment">&nbsp;</em> Comments</a></li>
			<li><a href="{{ route('Transaction.List') }}"><em class="fa fa-dollar">&nbsp;</em> Transaction</a></li>
			<li><a href="{{ route('Contact.List') }}"><em class="fa fa-envelope-square">&nbsp;</em> Contact us</a></li>
			<li><a href="{{route('logout')}}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	@yield('content')
	  

	<script src="{{ asset('admin_assets/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/chart.min.js') }}"></script>
	<script src="{{ asset('admin_assets/js/chart-data.js') }}"></script>
	<script src="{{ asset('admin_assets/js/easypiechart.js') }}"></script>
	<script src="{{ asset('admin_assets/js/easypiechart-data.js') }}"></script>
	<script src="{{ asset('admin_assets/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('admin_assets/js/custom.js') }}"></script>

	<!-- alertify -->
	<script src="{{ asset('admin_assets/js/alertify.js') }}"></script>
	<!-- dropify -->
	<script src="{{ asset('admin_assets/js/dropify.min.js') }}"></script>

	@yield('javascript')
	
</body>
</html>
