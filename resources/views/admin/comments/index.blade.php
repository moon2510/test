@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{route('admin-home')}}">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Comment Manager</li>
			<li class="active">List Comments</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Danh sách bình luận</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<form action="{{ route('Comment.Search') }}" method="GET">
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
								<th>Tên Sách</th>
								<th>Mô Tả Nội Dung</th>
								<th>Thời Gian</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@if($comments->count() < 1)
							<tr>
								<td colspan="6">Không có bình luận nào</td>
							</tr>
							@endif
							@foreach($comments as $comment)
							<tr data-row="{{$comment->id}}">
								<td>{{$comment->id}}</td>
								<td>{{$comment->user->firstname.' '.$comment->user->lastname}}</td>
								<td>{{$comment->book->name}}</td>
								<td class="describe-comment">{{$comment->comment}}</td>
								<td>{{$comment->created_at}}</td>
								<td><a href="javascript:void(0);" class="btn btn-sm btn-danger comment-remove" data-id="{{$comment->id}}">Xoá</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>
						{{ $comments->links() }}
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