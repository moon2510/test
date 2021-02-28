@extends('layouts.main')

@section('page-title')
Cart
@endsection

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/TimeCircles.css') }}">
@endsection

@section('page-content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{ route('home') }}">
		<i class="fas fa-home"></i>
	</a></li>
	<li class="breadcrumb-item"><a href="{{ route('account_profile') }}">Account</a></li>
	<li class="breadcrumb-item active">Borrowing Books</li>
</ol>
<div class="row accountcontainer">
	<div class="col-3">
		@include('user.layouts.menu')
	</div>
	<div class="col-9 infocontainer">
		<h2>Borrowing Books</h2>
		@if($result == 0)
		<div class="alert alert-danger">
			<li>No data available in here</li>
		</div>
		@else
		<div class="alert alert-success">
			<p>When you read complete, go to library and order new books !</p>
		</div>
		@php
		$date = Auth::user()->account_expiry_date;
		@endphp
		@if($date <= now())
		<div class="alert alert-danger">
			<p>Your account has been expiry, please go to library to give back book or enewed your account!</p>
		</div>
		@else
		<div id="DateCountdown" data-date="{{$date}}" style="width: 100%;"></div>
		@endif
		<h4>Order number :{{ $order->id }}</h4>
		<p>Date borrow : {{ $order->date_borrow }}</p>
		<table id="cart" class="table table-hover table-condensed">
			<thead>
				<tr>
					<th style="width:60%">Book</th>
					<th style="width:20%">Category</th>
					<th style="width:20%" class="text-center">Price</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data as $orderdetails)
				<tr>
					<td>
						<div class="row">
							<div class="col-sm-2 hidden-xs"><img src="{{ $orderdetails->book->img }}" alt="..." class="img-responsive" height="100px" width="70px"/></div>
							<div class="col-sm-10">
								<h4><a class="nomargin" href="{{ route('book',$orderdetails->book->id) }}">{{ $orderdetails->book->name }}</a></h4>
								<p>Describes : {{substr($orderdetails->book->describes,0,90)}} ...</p>
							</div>
						</div>
					</td>
					<td><a href="{{ route('category',$orderdetails->book->category->id) }}">{{ $orderdetails->book->category->name }}</a></td>
					<td class="text-center">{{number_format($orderdetails->book->price)}} VND</td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2" style="font-weight: bold;text-align: right">Total :</td>
					<td class="text-center">{{ number_format($order->price) }} VND</td>
				</tr>
			</tfoot>
		</table>
		@endif
	</div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript" src="{{ asset('js/TimeCircles.js') }}"></script>
<script>
	$("#DateCountdown").TimeCircles({
		"animation": "smooth",
		"bg_width": 1.2,
		"fg_width": 0.1,
		"circle_bg_color": "#60686F",
		"time": {
			"Days": {
				"text": "Days",
				"color": "#FFCC66",
				"show": true
			},
			"Hours": {
				"text": "Hours",
				"color": "#99CCFF",
				"show": true
			},
			"Minutes": {
				"text": "Minutes",
				"color": "#BBFFBB",
				"show": true
			},
			"Seconds": {
				"text": "Seconds",
				"color": "#FF9999",
				"show": true
			}
		}
	});
</script>
@endsection