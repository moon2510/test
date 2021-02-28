@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{route('admin-home')}}">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Slider Manager</li>
			<li class="active">List Slider</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh sách Slider</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			@if(session('class'))
            <div class="alert bg-{{session('class')}}" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{session('message')}}</div>
            @endif
			<div class="panel panel-default">
				<div class="panel-heading">
					<form action="{{ route('Slider.Search') }}" method="GET">
						<div class="input-group">
							<input type="text" class="form-control input-md" name="key" placeholder="Search for..." />
							<span class="input-group-btn"><button type="submit" class="btn btn-primary btn-md" >Search</button></span>
						</div>
					</form>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Hình Ảnh</th>
								<th>Tiêu Đề</th>
								<th>Mô Tả</th>
								<th>Thời Gian Tạo</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@if($sliders->count() < 1)
							<tr>
								<td colspan="6">Không có Slider nào</td>
							</tr>
							@endif
							@foreach($sliders as $slider)
							<tr data-row="{{$slider->id}}">
								<td>{{$slider->id}}</td>
								<td><img src="{{asset($slider->path)}}" width="200px" height="100px"></td>
								<td>{{$slider->title}}</td>
								<td>{{$slider->subtitle}}</td>
								<td>{{$slider->created_at}}</td>
								<td><a href="{{route('Slider.Edit', $slider->id)}}" class="btn btn-sm btn-primary">Chỉnh sửa</a>
									<a href="javascript:void(0);" class="btn btn-sm btn-danger slider-remove" data-id="{{$slider->id}}">Xoá</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>
						{{ $sliders->links() }}
					</center>
				</div>
			</div>
		</div><!--/.col-->

	</div><!--/.row-->
</div>	<!--/.main-->

@endsection
@section('javascript')
<script type="text/javascript">
    var api_domain = "{{ url('/admin') }}";
    var api_token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{ asset('admin_assets/js/main-app.js') }}"></script>
@endsection