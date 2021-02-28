@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Order Manager</li>
			<li class="active">List Orders By Book</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Đơn hàng cuả sách "<font color="red">{{$book->name}}</font>"</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>Mã Đơn Hàng</th>
								<th>Tên Độc Giả</th>
								<th>Thời Gian Đăng Ký Thuê</th>
								<th>Tình trạng</th>
								<th>Xem Chi Tiết</th>
								<th>Xử Lý</th>
							</tr>
						</thead>
						<tbody>
							@if($details->count() < 1)
							<tr><td colspan="6">Không có đơn hàng nào</td></tr>
							@endif
							@foreach($details as $detail)<tr data-row="{{$detail->order->id}}">
								<td>{{$detail->order->id}}</td>
								<td>{{$detail->order->user->firstname.' '.$detail->order->user->lastname}}</td>
								<td>{{$detail->order->created_at}}</td>
								<td>
									@switch($detail->order->status)
									@case(1)
									<span class="btn-sm btn-warning">Chờ xử lý</span>
									@break
									@case(2)
									<span class="btn-sm btn-warning">Chờ nhận sách</span>
									@break
									@case(3)
									<span class="btn-sm btn-danger">Đã hủy</span>
									@break
									@case(4)
									<span class="btn-sm btn-primary">Đang thuê</span>
									@break
									@case(5)
									<span class="btn-sm btn-success">Đã trã</span>
									@break
									@endswitch
								</td>
								<td><a href="javascript:void(0);" class="btn btn-sm btn-info order-show" data-id="{{$detail->order->id}}">Xem chi tiết</a></td>
								<td class="table-button">
									@switch($detail->order->status)
									@case(1)
									<a href="javascript:void(0);" class="btn btn-sm btn-success allow-order" data-id="{{$detail->order->id}}">Duyệt</a>
									<a href="javascript:void(0);" class="btn btn-sm btn-danger refused-order" data-id="{{$detail->order->id}}">Từ chối</a>
									@break
									@case(2)
									<a href="javascript:void(0);" class="btn btn-sm btn-success received-book" data-id="{{$detail->order->id}}">Đã nhận sách</a>
									<a href="javascript:void(0);" class="btn btn-sm btn-danger refused-order" data-id="{{$detail->order->id}}">Hủy</a>
									@break
									@case(3)
									<a href="javascript:void(0);" class="btn btn-sm btn-danger order-remove" data-id="{{$detail->order->id}}">Xóa</a>
									@break
									@case(4)
									<a href="javascript:void(0);" class="btn btn-sm btn-success return-book" data-id="{{$detail->order->id}}">Trã sách</a>
									@break
									@case(5)
									<a href="javascript:void(0);" class="btn btn-sm btn-danger order-remove" data-id="{{$detail->order->id}}">Xóa</a>
									@break
									@endswitch
									
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>
						{{ $details->links() }}
					</center>
				</div>
			</div>
		</div><!--/.col-->

	</div><!--/.row-->
</div>	<!--/.main-->

<!-- Detail Order Modal -->
<div id="detail-order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="panel panel-default">
			<div class="panel-heading">Xem Chi Tiết Đơn Đặt Hàng</div>
			<div class="panel-body"></div>
		</div>
    </div>
  </div>
</div>
<!-- END Detail Order Modal -->
@endsection
@section('javascript')
<script type="text/javascript">
    var api_domain = "{{ url('/admin') }}";
    var api_token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{ asset('admin_assets/js/main-app.js') }}"></script>
@endsection