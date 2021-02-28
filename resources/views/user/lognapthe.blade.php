@extends('layouts.main')

@section('page-title','Log Nap The')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('page-content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{ route('home') }}">
		<i class="fas fa-home"></i>
	</a></li>
	<li class="breadcrumb-item"><a href="{{ route('napthe') }}">Nap The</a></li>
	<li class="breadcrumb-item active">Log</li>
</ol>

<div class="row accountcontainer">
	<div class="col-3">
		@include('user.layouts.menu')
	</div>
	<div class="col-9 infocontainer">
		<h1>Log Nap The</h1>
		<table id="example" class="display text-center" style="width:100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Pin</th>
					<th>Seri</th>
					<th>Price</th>
					<th>Status</th>
					<th>Note</th>
					<th>Time</th>
				</tr>
			</thead>
			<tbody>
				@foreach($datas as $data)
				<tr>
					<td>{{ $data->id }}</td>
					<td>{{ $data->pin }} VND</td>
					<td>{{ $data->seri }}</td>
					<td>{{ $data->price }}</td>
					@switch($data->status)
					@case(1)
					<td><h5><span class="badge badge-pill badge-danger">Error</span></h5></td>
					@break
					@case(0)
					<td><h5><span class="badge badge-pill badge-success">Success</span></h5></td>
					@break
					@endswitch
					<td>{{ $data->message}}</td>
					<td>{{ $data->created_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('custom-js')
<script>
	$(document).ready(function() {
		$('#example').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		} );
	} );
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection