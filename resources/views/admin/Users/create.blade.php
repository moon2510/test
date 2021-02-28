@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li>User Manager</li>
			<li class="active">Add New User</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">User Manager</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Thêm thành viên mới
				</div>
				<div class="panel-body">
					<div class="row">
						<form action="{{route('User.Store')}}" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="col-lg-3">
								<div class="form-group">
	                                <label for="input-file">Hình Ảnh</label>
	                                <input type="file" id="input-file" name="img" class="dropify" data-height="275px" data-default-file="{{asset('images/default.png')}}" />
	                            </div>
							</div>
							<div class="col-lg-9">
								@if(session('class'))
								<div class="alert bg-{{session('class')}}" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{session('message')}}</div>
								@endif
								@if($errors->any())
								<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{$errors->first()}}</div>
								@endif
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
											<label>Họ <font color="red">*</font></label>
											<input class="form-control" type="text" name="firstname" value="{{old('firstname')}}" placeholder="Nhập họ (V/d: Trần)">
											@if ($errors->has('firstname'))
											<span class="text-danger">{{ $errors->first('firstname') }}</span>
											@endif
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
											<label>Tên <font color="red">*</font></label>
											<input class="form-control" type="text" name="lastname" value="{{old('lastname')}}" placeholder="Nhập tên (V/d: Long)">
											@if ($errors->has('lastname'))
											<span class="text-danger">{{ $errors->first('lastname') }}</span>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Giới tính <font color="red">*</font></label>
									<div class="radio">
										<label>
											<input type="radio" name="gender" value="0" {{ old('gender') == 0 ? 'checked' : '' }}>Nam
										</label>
										<label>
											<input type="radio" name="gender" value="1" {{ old('gender') != 0 ? 'checked' : '' }}>Nữ
										</label>
									</div>
								</div>
								<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
									<label>Email <font color="red">*</font></label>
									<input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="Địa chỉ email (V/d: longdeptrai@gmail.com)">
									@if ($errors->has('email'))
									<span class="text-danger">{{ $errors->first('email') }}</span>
									@endif
								</div>
								<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
									<label>Số điện thoại <font color="red">*</font></label>
									<input class="form-control" type="text" name="phone" value="{{old('phone')}}" placeholder="Số điện thoại liên hệ (V/d: 0969999999)">
									@if ($errors->has('phone'))
									<span class="text-danger">{{ $errors->first('phone') }}</span>
									@endif
								</div>
								<div class="form-group">
									<label>Chức vụ <font color="red">*</font></label>
									<div class="radio">
										<label>
											<input type="radio" name="roles" value="0" {{ old('roles') != 1 ? 'checked' : '' }}>Thành viên
										</label>
										<label>
											<input type="radio" name="roles" value="1" {{ old('roles') == 1 ? 'checked' : '' }}>Quản lý
										</label>
									</div>
								</div>
								<div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
									<label>Mật khẩu <font color="red">*</font></label>
									<input type="password" name="password" class="form-control" placeholder="Mật khẩu">
									@if ($errors->has('password'))
									<span class="text-danger">{{ $errors->first('password') }}</span>
									@endif
								</div>
								<div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
									<label>Xác nhận mật khẩu <font color="red">*</font></label>
									<input type="password" name="confirm_password" value="{{old('confirm_password')}}" class="form-control" placeholder="Xác nhận mật khẩu">
									@if ($errors->has('confirm_password'))
									<span class="text-danger">{{ $errors->first('confirm_password') }}</span>
									@endif
								</div>
								<div class="form-group">
									<label>Địa chỉ</label>
									<textarea class="form-control" name="address" rows="3" placeholder="Địa chỉ hiện tại (V/d: Đà Nẵng, Việt Nam,...)">{{old('address')}}</textarea>
								</div>
								<button type="submit" class="btn btn-primary">Thêm thành viên</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/.col-->

	</div><!--/.row-->
</div>	<!--/.main-->
@endsection
@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		$('.dropify').dropify();
	});
</script>
@endsection