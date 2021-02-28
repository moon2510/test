@extends('admin.layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/select2.min.css')}}">
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Order Manager</li>
			<li class="active">Add Order</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Order Manager</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Thêm đơn sách mới
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							@if($errors->any())
							<div class="alert bg-danger" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>{{$errors->first()}}</div>
							@endif
							<form action="{{ route('Order.Store') }}" method="post" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group {{ $errors->has('name') ? '' : '' }}">
									<label>Độc giả</label>
									<select class="readers" style="width:100%" name="readers"></select>
								</div>
								<div class="form-group">
									<table class="table table-bordered" id="tbl_posts">
										<thead>
											<tr>
												<th>#</th>
												<th>Tên Sách</th>
												<th>Số Lượng</th>
												<th>Xóa</th>
											</tr>
										</thead>
										<tbody id="tbl_posts_body">
										</tbody>
									</table>
									<div class="well clearfix">
								        <a class="btn btn-info add-record" data-added="0"><i class="glyphicon glyphicon-plus"></i> Thêm sách</a>
									</div>
								</div>

								<button type="submit" class="btn btn-primary">Thêm đơn hàng	</button>
							</form>
							<div style="display:none;">
							    <table id="sample_table">
							    	<tr id="">
							    	<td><span class="sn"></span>.</td>
							        <td><select class="form-control book-record" style="width:100%"></select></td>
									<td><input type="number" class="form-control quantity-record" value="1"></td>
							        <td><a class="btn btn-lg btn-danger delete-record" data-id="0"><i class="glyphicon glyphicon-trash"></i></a></td>
							     </tr>
							   </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.col-->

	</div><!--/.row-->
</div>	<!--/.main-->
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('admin_assets/js/select2.min.js')}}"></script>
<script type="text/javascript">
	var api_domain = "{{ url('/admin') }}";
    var api_token = "{{ csrf_token() }}";
	$(document).ready(function(){
		$('.readers').select2({
	        placeholder: 'Chọn thành viên',
	        ajax: {
	          url: api_domain+'/users/api/search',
	          dataType: 'json',
	          delay: 250,
	          processResults: function (data) {
	            return {
	              results: data
	            };
	          },
	          cache: true
	        }
      	});

	});
</script>
<script type="text/javascript" src="{{asset('admin_assets/js/main-app.js')}}"></script>
@endsection