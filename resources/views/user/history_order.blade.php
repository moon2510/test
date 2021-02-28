@extends('layouts.main')

@section('page-title','History Order')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('page-content')
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="{{ route('home') }}">
		<i class="fas fa-home"></i>
	</a></li>
	<li class="breadcrumb-item"><a href="{{ route('account_profile') }}">Account</a></li>
	<li class="breadcrumb-item active">Cancelled Order</li>
</ol>

<div class="row accountcontainer">
	<div class="col-3">
		@include('user.layouts.menu')
	</div>
	<div class="col-9 infocontainer">
		<h1>History Orders</h1>
		<table id="example" class="display text-center" style="width:100%">
			<thead>
				<tr>
					<th>ID Order</th>
					<th>Price</th>
					<th>Borrow Date</th>
					<th>Give Back Date</th>
					<th>Status</th>
					<th>Note</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
				<tr>
					<td>{{ $order->id }}</td>
					<td>{{ number_format($order->price)}} VND</td>
					<td>{{ $order->date_borrow }}</td>
					<td>{{ $order->date_give_back }}</td>
					@switch($order->status)
					@case(3)
					<td><h5><span class="badge badge-pill badge-danger">Cancelled</span></h5></td>
					@break
					@case(4)
					<td><h5><span class="badge badge-pill badge-info">Borrowing</span></h5></td>
					@break
					@case(5)
					<td><h5><span class="badge badge-pill badge-success">Success</span></h5></td>
					@break
					@endswitch
					<td>{{ $order->note}}</td>
					<td><a href="javascript:detail_order({{ $order->id }})"><button type="button" class="btn btn-warning">View Details</button></a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<!-- Modal -->
		<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Details Order</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
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
	function detail_order(id){
		$.ajax({
			url: "{{ route('detail_order') }}",
			method: "GET",
			data: {
				id: id
			},
			dataType: "json",
			success: function(data){
				let show = '<div class="orderdetails"><p>OrderID: '+ data['0'].id+'</p>'
				switch(data['0'].status){
					case 3:
					show += '<p>Status : <span class="btn-sm btn-danger">Cancelled<span></span></span></p>'
					break;
					case 4:
					show += '<p>Status : <span class="btn-sm btn-info">Borrow<span></span></span></p>'
					break;
					case 5:
					show += '<p>Status : <span class="btn-sm btn-success">Success<span></span></span></p>'
					break;
				}
				if(data['0'].date_borrow != null){
					show += '<p>Date Borrow: '+data['0'].date_borrow +'</p>';
				}
				if(data['0'].date_give_back != null){
					show += '<p>Date Give Back: '+data['0'].date_give_back +'</p>';
				}
				if(data['0'].note != null){
					show += '<p>Note: '+data['0'].note +'</p>';
				}
				show += '<table class="table"><thead><tr><th>Book</th><th>Category</th><th>Price</th></tr></thead><tbody>';
				$.each(data['1'], function( i, l ) {
					show += '<tr><td>'+l.name+'</td><td>'+l.category+'VND</td><td>'+l.price+'VND</td></tr>';
				});
				show += '</tbody><tfoot><tr><td colspan="2">Total: '+data['2']+'VND</td></tr></tfoot></table></div>';
				$('#detailModal .modal-body').html(show);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				$('#detailModal .modal-body').html("Status: " + textStatus +" <br>Error: " + errorThrown);
			}   
		});
		$('#detailModal').modal('show');
	}
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection