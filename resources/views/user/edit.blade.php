@extends('layouts.main')

@section('page-title','Edit Account')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/edit_user.css') }}">
@endsection

@section('page-content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{ route('home') }}">
		<i class="fas fa-home"></i>
	</a></li>
	<li class="breadcrumb-item"><a href="{{ route('account_profile') }}">Account</a></li>
	<li class="breadcrumb-item active">Edit</li>
</ol>
<div class="row accountcontainer">
	<div class="col-3">
		@include('user.layouts.menu')
	</div>
	<div class="col-9 infocontainer">
		<h1>Edit Account</h1>
		<div class="panel panel-default">
			<form class="form-horizontal" action="{{ route('account_update') }}" method="post">
				@csrf
				@if(session('class'))
				<div class="alert alert-{{session('class')}}">
					<li>{{session('message')}}</li>
				</div>
				@endif

				<div class="form-group">
					<label><i class="required">(*)</i>E-Mail</label>
					<input id="email" name="email" type="text" placeholder="Your name" class="form-control" readonly="readonly" value="{{ Auth::user()->email }}">
				</div>

				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label><i class="required">(*)</i>First Name</label>
							<input id="firstname" name="firstname" type="text" placeholder="Your FirstName" class="form-control" value="{{ Auth::user()->firstname }}">
							@if ($errors->has('firstname'))
							<span class="invalid-feedback" style="display: block" role="alert">
								<strong>{{ $errors->first('firstname') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label><i class="required">(*)</i>Last Name</label>
							<input id="lastname" name="lastname" type="text" placeholder="Your LastName" class="form-control" value="{{ Auth::user()->lastname }}">
							@if ($errors->has('lastname'))
							<span class="invalid-feedback" style="display: block" role="alert">
								<strong>{{ $errors->first('lastname') }}</strong>
							</span>
							@endif
						</div>
					</div>
				</div>

				<div class="form-group">
					<label><i class="required">(*)</i>Phone</label>
					<input id="phone" name="phone" type="text" placeholder="Your Phone" class="form-control" value="{{ Auth::user()->phone }}">
					@if ($errors->has('phone'))
					<span class="invalid-feedback" style="display: block" role="alert">
						<strong>{{ $errors->first('phone') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group">
					<label><i class="required">(*)</i>Address</label>
					<input id="address" name="address" type="text" placeholder="Your Address" class="form-control" value="{{ Auth::user()->address }}">
					@if ($errors->has('address'))
					<span class="invalid-feedback" style="display: block" role="alert">
						<strong>{{ $errors->first('address') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group">
					<label><i class="required">(*)</i>Gender</label>
					<label class="checkbox-inline">
						<input type="radio" name="gender"value="0" {{ Auth::user()->gender == 0 ? 'checked' : '' }}>Male
						<input type="radio" name="gender" value="1" {{ Auth::user()->gender == 1 ? 'checked' : '' }}>Female
					</label>
				</div>

				<div class="form-group">
					<label>Change password </label>
					<input id="newpass" type="checkbox" value="1">
					@if ($errors->has('password'))
					<span class="invalid-feedback" style="display: block" role="alert">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
					@endif
					@if ($errors->has('confirm_password'))
					<span class="invalid-feedback" style="display: block" role="alert">
						<strong>{{ $errors->first('confirm_password') }}</strong>
					</span>
					@endif
				</div>
				<div id="formnewpass" style="display: none;">
					<div class="form-group">
						<label>New password</label>
						<input name="password" id="password" value="" type="password" class="form-control">
					</div>
					<div class="form-group">
						<label>Confirm new password</label>
						<input name="confirm_password" id="confirm_password" value="" type="password" class="form-control">
						<span style="display: block"  id='message'></span>
					</div>
					<div id="pswd_info">
						<h4>Password must meet the following requirements:</h4>
						<ul>
							<li id="letter" class="invalid">At least <strong>one letter</strong></li>
							<li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
							<li id="number" class="invalid">At least <strong>one number</strong></li>
							<li id="special" class="invalid">At least  <strong>one special letter</strong></li>
							<li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
						</ul>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-default btn-md pull-right">Save Change</button>
				</div>
				<div>
					<p class="help"><i class="required">(*)</i> : Required Input !</p>
					<p class="help">Click avatar to change your avatar !</p>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript" src="{{ asset('js/edit_user.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/password.js') }}"></script>
@endsection