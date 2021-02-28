@extends('admin.layouts.master')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-home"></em>
			</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</div><!--/.row-->
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
	</div><!--/.row-->
	
	<div class="panel panel-container">
		<div class="row">
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<div class="panel panel-teal panel-widget border-right">
					<div class="row no-padding"><em class="fa fa-xl fa-book color-blue"></em>
						<div class="large">{{$books->count()}}</div>
						<div class="text-muted">Books</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<div class="panel panel-blue panel-widget border-right">
					<div class="row no-padding"><em class="fa fa-xl fa-comments color-blue"></em>
						<div class="large">{{$comments->count()}}</div>
						<div class="text-muted">Comments</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<div class="panel panel-orange panel-widget border-right">
					<div class="row no-padding"><em class="fa fa-xl fa-users color-blue"></em>
						<div class="large">{{$users->count()}}</div>
						<div class="text-muted">Users</div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<div class="panel panel-red panel-widget ">
					<div class="row no-padding"><em class="fa fa-xl fa-clipboard color-blue"></em>
						<div class="large">{{$orders->count()}}</div>
						<div class="text-muted">Orders</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>
	<div class="row">
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Đơn hàng chưa duyệt</h4>
					<div class="easypiechart" id="easypiechart-orange" data-percent="{!!percent($orders->count(), $orders->where('status', 1)->count())!!}" ><span class="percent">{!!$orders->where('status', 1)->count()!!}/{!!$orders->count()!!}</span></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Đơn hàng đang mượn</h4>
					<div class="easypiechart" id="easypiechart-blue" data-percent="{!!percent($orders->count(), $orders->where('status', 4)->count())!!}" ><span class="percent">{!!$orders->where('status', 4)->count()!!}/{!!$orders->count()!!}</span></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Đơn hàng đã trã</h4>
					<div class="easypiechart" id="easypiechart-teal" data-percent="{!!percent($orders->count(), $orders->where('status', 5)->count())!!}" ><span class="percent">{!!$orders->where('status', 5)->count()!!}/{!!$orders->count()!!}</span></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Đơn hàng bị hủy</h4>
					<div class="easypiechart" id="easypiechart-red" data-percent="{!!percent($orders->count(), $orders->where('status', 3)->count())!!}" ><span class="percent">{!!$orders->where('status', 3)->count()!!}/{!!$orders->count()!!}</span></div>
				</div>
			</div>
		</div>
	</div><!--/.row-->
	<div class="row">


		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Calendar</div>
				<div class="panel-body">
					<div id="calendar"></div>
				</div>
			</div>
		</div>
						
	</div>
				
</div>	<!--/.main-->
@endsection
@section('javascript')
@endsection