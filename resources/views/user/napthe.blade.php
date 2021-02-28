@extends('layouts.main')

@section('page-title','Nap the')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
@endsection

@section('page-content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{ route('home') }}">
		<i class="fas fa-home"></i>
	</a></li>
	<li class="breadcrumb-item"><a href="{{ route('account_profile') }}">Account</a></li>
	<li class="breadcrumb-item active">Nap The</li>
</ol>
<div class="row accountcontainer">
	<div class="col-3">
		@include('user.layouts.menu')
	</div>
	<div class="col-9 infocontainer">
		<div class="alert alert-info" id="message" style="display: none;">
			<p>
				<div class="label label-danger" id="msg_napthe"></div>
			</p>
		</div>
		<div class="row justify-content-center">
			<div class="col-7">
				<h3 class="text-center">Nap The</h3>
				<form action="#" method="post" id="fnapthe">
					@csrf
					<div class="form-group">
						<label for="">Name Card (*)</label>
						<select name="card_type_id" id="card_type_id" style="width: 100%;padding: 10px;border-radius: 15px;" required="">
							<option value="1">Viettel</option>
							<option value="2">Mobiphone</option>
							<option value="3">Vinaphone</option>
							<option value="4">Gate</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Price (*)</label>
						<select name="price_guest" id="price_guest" style="width: 100%;padding: 10px;border-radius: 15px;" required="">
							<option value="10000">10.000</option>
							<option value="20000">20.000</option>
							<option value="30000">30.000</option>
							<option value="50000">50.000</option>
							<option value="100000">100.000</option>
							<option value="200000">200.000</option>
							<option value="300000">300.000</option>
							<option value="500000">500.000</option>
							<option value="1000000">1.000.000</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Pin(*)</label>
						<input type="text" value="" name="pin" id="pin" style="width: 100%;padding: 10px;border-radius: 15px;" required />
					</div>
					<div class="form-group">
						<label for="">Seri(*)</label>
						<input type="text" value="" name="seri" id="seri" style="width: 100%;padding: 10px;border-radius: 15px;" required />
					</div>
					<div class="form-group">
						<input class="btn btn-info" type="submit" id="submit_napthe" value="Submit"/>
					</div>
				</form>
			</div>
			<div class="col-1"></div>
			<div class="col-4">
				<iframe src="https://sv.gamebank.vn/trang-thai-he-thong" alt="" style="height: 300px;border: 0"></iframe>
			</div>
		</div>
	</div>
</div>

@endsection

@section('custom-js')
<script>
	$(document).ready(function() {
		$("#fnapthe").submit(function(event) {
			event.preventDefault();
			let name_card = $('#card_type_id').val();
			let price = $('#price_guest').val();
			let pin = $('#pin').val();
			let seri = $('#seri').val();
			$.ajax({
				type:'POST',
				url:'napthe', 
				data: {
					_token: '{!! csrf_token() !!}',
					name_card: name_card,
					price: price,
					seri: seri,
					pin: pin
				},
				beforeSubmit : function() {
					$("#submit_napthe").val("Loadings...");
				},
				success:function(data){
					if(data.status == 0) {
						$("#msg_napthe").html(data.message);
						$("#message").show();
					}
					else {
						$("#msg_napthe").html(data.message);
						$("#message").show();
					}
					$("#submit_napthe").val("Submit");
				},
				error:function(jqXHR,exception){
					console.log(jqXHR.responseText);
				}
			});
		});
	});
</script>
@endsection