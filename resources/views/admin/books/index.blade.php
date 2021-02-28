@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Books Manager</li>
			<li class="active">List Books</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">List Books</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<form action="{{ route('Book.Search') }}" method="GET">
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
								<th>Tên Sách</th>
								<th>Tác Giả</th>
								<th>Năm Xuất Bản</th>
								<th>Danh Mục</th>
								<th>Số lượng</th>
								<th>Giá Thuê</th>
								<th>Chỉnh Sửa/Xóa</th>
							</tr>
						</thead>
						<tbody>
							@if($books->count() < 1)
							<tr>
								<td colspan="8">Không có sách nào</td>
							</tr>
							@endif
							@foreach($books as $book)
							<tr data-row="{{$book->id}}">
								<td>{{$book->id}}</td>
								<td><a href="{{route('Order.Book', $book->id)}}">{{$book->name}}</a></td>
								<td>{{$book->author}}</td>
								<td>{{$book->published_year}}</td>
								<td>{{$book->Category->name}}</td>
								<td>{{$book->quantity}}</td>
								<td>{{ number_format($book->price) }}đ</td>
								<td>
									<a href="{{ route('Book.Edit', $book->id) }}" class="btn btn-sm btn-primary">Chỉnh sửa</a>
									<a href="javascript:void(0);" class="btn btn-sm btn-danger book-remove" data-id="{{$book->id}}">Xóa</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>
						{{ $books->links() }}
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