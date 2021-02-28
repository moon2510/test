@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Books Manager</li>
			<li class="active">List Lost Books</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">List Lost Books</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Tên Sách</th>
								<th>Độc Giả</th>
								<th>Tiền Phạt</th>
								<th>Ghi Chú</th>
								<th>Hoàn Trã</th>
							</tr>
						</thead>
						<tbody>
							@if($lostbooks->count() < 1)
							<tr>
								<td colspan="6">Không có sách nào</td>
							</tr>
							@endif
							@foreach($lostbooks as $book)
							<tr data-row="{{$book->id}}">
								<td>{{$book->id}}</td>
								<td>{{$book->orderdetail->book->name}}</td>
								<td>{{$book->orderdetail->order->user->firstname}} {{$book->orderdetail->order->user->lastname}}</td>
								<td>{{ number_format($book->price) }}đ</td>
								<td>{{$book->note}}</td>
								<td>
									<a href="javascript:void(0);" class="btn btn-sm btn-success report-remove" data-id="{{$book->id}}">Đã Trã</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>
						{{ $lostbooks->links() }}
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