@extends('layouts.main')

@section('page-title','Contact US')

@section('custom-css')
<style>
	.contact-form{
		background: #fff;
		margin-top: 5%;
		margin-bottom: 5%;
		width: 70%;
	}
	.contact-form .form-control{
		border-radius:1rem;
	}
	.contact-image{
		text-align: center;
	}
	.contact-image img{
		margin-top: 90px;
		border-radius: 6rem;
		width: 100%;
	}
	.contact-form form{
		padding: 14%;
	}
	.contact-form h3{
		margin-bottom: 8%;
		margin-top: -10%;
		text-align: center;
		color: #dc3545;;
	}
	.contact-form .btnContact {
		width: 50%;
		border: none;
		border-radius: 1rem;
		padding: 1.5%;
		background: #dc3545;
		font-weight: 600;
		color: #fff;
		cursor: pointer;
	}
	.btnContactSubmit
	{
		width: 50%;
		border-radius: 1rem;
		padding: 1.5%;
		color: #fff;
		background-color: #0062cc;
		border: none;
		cursor: pointer;
	}
</style>
@endsection

@section('page-content')
<div class="container contact-form">
	@if(session('class_contact'))
	<div class="alert alert-{{session('class_contact')}} alert-dismissible fade show">
		<p>{{session('message')}}</p>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif
	<div class="row">
		<div class="col-3">
			<div class="contact-image">
				<img src="http://redrocket.co.uk/test/RedRocket/wp-content/uploads/2018/10/RR-Contact-Icons-Equiries-300x276.png" alt="rocket_contact"/>
			</div>
		</div>
		<div class="col-9">
			<form method="post" action="{{ route('contact_us_post') }}">
				@csrf
				<h3>Drop Us a Message</h3>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Your Name *" value="{{ old('name') }}" required />
							@if ($errors->has('name'))
							<span class="invalid-feedback" role="alert" style="display: block;padding-left: 15px">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Your Email *" value="{{ old('email') }}" required/>
							@if ($errors->has('email'))
							<span class="invalid-feedback" role="alert" style="display: block;padding-left: 15px">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<input type="text" name="phone" class="form-control" placeholder="Your Phone Number *" value="{{ old('phone') }}" required/>
							@if ($errors->has('phone'))
							<span class="invalid-feedback" role="alert" style="display: block;padding-left: 15px">
								<strong>{{ $errors->first('phone') }}</strong>
							</span>
							@endif
						</div>
						<div class="form-group">
							<input type="submit"class="btnContact" value="Send Message" required/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<textarea name="message" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;" value="{{ old('message') }}"></textarea>
							@if ($errors->has('message'))
							<span class="invalid-feedback" role="alert" style="display: block;padding-left: 15px">
								<strong>{{ $errors->first('message') }}</strong>
							</span>
							@endif
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
@endsection