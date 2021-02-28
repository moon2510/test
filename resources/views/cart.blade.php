@extends('layouts.main')

@section('page-title')
Cart
@endsection

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/cart.css') }}">
@endsection

@section('page-content')
<div>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">
			<i class="fas fa-home"></i>
		</a></li>
		<li class="breadcrumb-item active">Cart</li>
	</ol>
</div>
@if(session('class'))
<div class="alert alert-{{session('class')}} alert-dismissible fade show">
	<li>{{session('message')}}</li>
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
@if(session()->get('cart') == null)
<div class="row d-flex justify-content-center text-center">
	<figure>
		<img src="//pwa.scdn.vn/static/media/cart-empty.e2664e0f.svg" alt="Cart Image"><br>
		<p>Empty Cart</p>
		<a href="{{ route('home') }}"><button class="btn center-block cart">Continue to home !</button></a>
	</figure>
</div>
@else
<h3>Your cart :</h3>
<table id="cart" class="table table-hover table-condensed">
	<thead>
		<tr>
			<th style="width:50%">Book</th>
			<th style="width:10%">Category</th>
			<th style="width:10%" class="text-center">Quantity</th>
			<th style="width:15%" class="text-center">Price</th>
			<th style="width:15%"></th>
		</tr>
	</thead>
	<tbody>
		@foreach (session()->get('cart') as $key => $book)
		<tr>
			<td>
				<div class="row">
					<div class="col-sm-2 hidden-xs"><img src="{{$book['photo']}}" alt="..." class="img-responsive" height="100px" width="70px"/></div>
					<div class="col-sm-10">
						<h4><a class="nomargin" href="{{ route('book',$book['id']) }}">{{ $book['name'] }}</a></h4>
						<p>Describes : {{substr($book['des'],0,90)}} ...</p>
					</div>
				</div>
			</td>
			<td><a class="nomargin" href="{{ route('category',$book['category_id']) }}">{{$book['category']}}</a></td>
			<td class="text-center">1</td>
			<td class="text-center top50">{{number_format($book['price'])}} VND</td>
			<td class="text-center">
				<form id="myForm" data-book-id="{{ $book['id'] }}">
					<button type="submit" class="btn btn-danger deletebutton">Delete</button>
				</form>
				<div class="modal fade" tabindex="-1" role="dialog" id="myModal{{ $book['id'] }}">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Delete {{ $book['name'] }}</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>You submit delete this book ?&hellip;</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<form action="{{ route('remove-cart') }}" method="post">
									@csrf
									<input type="hidden" name="id" value="{{ $book['id'] }}">
									<input type="hidden" name="_method" value="delete" />
									<button type="submit" class="btn btn-danger">Submit Delete</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2"></td>
			<td class="text-center" style="font-weight: bold">Total :</td>
			<td class="text-center">{{ number_format(session()->get('total')) }}VND</td>
		</tr>
		<tr>
			<td><a href="{{ route('home') }}"><button class="btn center-block cart">Continue to home !</button></a></td>
			<td colspan="2" class="hidden-xs"></td>
			@if(Auth::check())
			<td class="hidden-xs text-center">
				<form id="myForm2">
					<button class="btn btn-success">Checkout</button>
				</form>
				<div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Submit!</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>Confirm submit cart&hellip;</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<a href="{{ route('submit_cart') }}"><button type="button" class="btn btn-success">Submit Cart</button></a>
							</div>
						</div>
					</div>
				</div>
			</td>
			@else
			<td class="hidden-xs text-center">
				<form id="myForm2">
					<button class="btn btn-success">Checkout</button>
				</form>
				<div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">You are not login !</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<p>Please login to submit this cart !&hellip;</p>
								<p>If not have account , <a href="{{ route('register') }}">Register here</a></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<a href="{{ route('login') }}"><button type="button" class="btn btn-success">Login</button></a>
							</div>
						</div>
					</div>
				</div>
			</td>
			@endif
		</tr>
	</tfoot>
</table>
@endif
@endsection

@section('custom-js')
<script type="text/javascript" src="{{ asset('js/cart.js') }}"></script>
@endsection