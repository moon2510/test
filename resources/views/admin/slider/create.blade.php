@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Slider Manager</li>
			<li class="active">Add new slider</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Slider Manager</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Thêm slider mới
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							@if(session('class'))
							<div class="alert bg-{{session('class')}}" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{session('message')}}</div>
							@endif
							@if($errors->has('img'))
							<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{$errors->first('img')}}</div>
							@endif
							<form action="{{ route('Slider.Store') }}" method="post" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="col-lg-4">
									<div class="form-group">
										<label for="input-file">Hình Ảnh</label>
	                    				<input type="file" id="input-file" name="img" class="dropify" data-height="230px" data-default-file="{{ asset('images/default.jpg') }}" accept="image/*"/>
									</div>
								</div>
								<div class="col-lg-8">
									<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
										<label>Tiêu đề <font color="red">*</font></label>
										<input class="form-control" type="text" name="title" value="{{old('title')}}" placeholder="Tiêu đề slider">
										@if ($errors->has('title'))
										<span class="text-danger">{{ $errors->first('title') }}</span>
										@endif
									</div>
									<div class="form-group {{ $errors->has('subtitle') ? 'has-error' : '' }}">
										<label>Mô tả thêm <font color="red">*</font></label>
										<textarea class="form-control" name="subtitle" rows="3" placeholder="Mô tả thêm">{{ old('subtitle') }}</textarea>
										@if ($errors->has('subtitle'))
										<span class="text-danger">{{ $errors->first('subtitle') }}</span>
										@endif
									</div>
									<div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
										<label>Link (url) <font color="red">*</font></label>
										<input class="form-control" type="text" name="link" value="{{old('link')}}" placeholder="Nhập url chuyển hướng (Định dạng: https://...)">
										@if ($errors->has('link'))
										<span class="text-danger">{{ $errors->first('link') }}</span>
										@endif
									</div>
									<div class="form-group {{ $errors->has('button_title') ? 'has-error' : '' }}">
										<label>Text Button <font color="red">*</font></label>
										<input class="form-control" type="text" name="button_title" value="{{old('button_title')}}" placeholder="Nhập tiêu đề nút chuyển (Ví dụ: Xem thêm,...)">
										@if ($errors->has('button_title'))
										<span class="text-danger">{{ $errors->first('button_title') }}</span>
										@endif
									</div>
									<button type="submit" class="btn btn-primary">Thêm slider</button>
								</div>
							</form>
						</div>
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
        // Basic
        $('.dropify').dropify();
    });
</script>
@endsection