@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{route('admin-home')}}">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Transaction Manager</li>
			<li class="active">List Transaction</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Lịch sử gia hạn tài khoản qua thẻ viễn thông</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<form action="{{ route('Transaction.Search') }}" method="GET">
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
								<th>Tên Độc Giả</th>
								<th>Mã Thẻ</th>
								<th>Số Seri</th>
								<th>Mệnh Giá</th>
								<th>Trạng Thái</th>
								<th>Ghi Chú</th>
								<th>Thời Gian</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@if($logcard->count() < 1)
							<tr>
								<td colspan="9">Không có giao dịch nào</td>
							</tr>
							@endif
							@foreach($logcard as $log)
							<tr data-row="{{$log->id}}">
								<td>{{$log->id}}</td>
								<td>{{$log->user->firstname}} {{$log->user->lastname}}</td>
								<td>{{$log->pin}}</td>
								<td>{{$log->seri}}</td>
								<td>{{number_format($log->price)}}đ</td>
								<td>{!!($log->status == 0) ? '<span class="btn-sm btn-success">Thành công</span>' : '<span class="btn-sm btn-danger">Thất bại</span>'!!}</td>
								<td>{{$log->message}}</td>
								<td>{{$log->created_at}}</td>
								<td><a href="javascript:void(0);" class="btn btn-sm btn-danger transaction-remove" data-id="{{$log->id}}">Xoá</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>
						{{ $logcard->links() }}
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