@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="{{route('admin-home')}}">
				<em class="fa fa-home"></em>
			</a></li>
			<li>Contact Us Manager</li>
			<li class="active">List Contact</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">List Contact</h1>
		</div>
	</div><!--/.row-->

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<form action="{{ route('Contact.Search') }}" method="GET">
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
								<th>Email</th>
								<th>Phone</th>
								<th>Mô Tả</th>
								<th>Thời Gian</th>
								<th>Phản Hồi</th>
							</tr>
						</thead>
						<tbody>
							@if($contacts->count() < 1)
							<tr>
								<td colspan="7">Không có liên hệ nào</td>
							</tr>
							@endif
							@foreach($contacts as $contact)
							<tr data-row="{{$contact->id}}">
								<td>{{$contact->id}}</td>
								<td>{{$contact->name}}</td>
								<td>{{$contact->email}}</td>
								<td>{{$contact->phone}}</td>
								<td class="describe">{{$contact->message}}</td>
								<td>{{$contact->created_at}}</td>
								<td><a href="javascript:void(0);" class="btn btn-sm btn-info contact-reply" data-id="{{$contact->id}}">Trả lời</a>
									<a href="javascript:void(0);" class="btn btn-sm btn-danger contact-remove" data-id="{{$contact->id}}">Bỏ qua</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="panel-footer">
					<center>
						{{ $contacts->links() }}
					</center>
				</div>
			</div>
		</div><!--/.col-->

	</div><!--/.row-->
</div>	<!--/.main-->

<!-- Reply Contact Modal -->
<div id="reply-Contact" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="panel panel-default">
			<div class="panel-heading">Contact</div>
			<div class="panel-body">
			</div>
		</div>
    </div>
  </div>
</div>
<!-- END Reply Contact Modal -->
@endsection
@section('javascript')
<script type="text/javascript">
    var api_domain = "{{ url('/admin') }}";
    var api_token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{ asset('admin_assets/js/main-app.js') }}"></script>
@endsection