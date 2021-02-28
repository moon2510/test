@extends('layouts.main')

@section('page-title','Search')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css') }}">
@endsection

@section('page-content')

<div class="row accountcontainer">
	<div class="col-3">
		<div id="sidebar-collapse" class="sidebar">
			<p class="list-group-item cat-item text-left" style="background-color: #e74c3c;color: white">Options</p>
			<form id="options_search" style="padding: 23px;">
				<div class="form-group has-search">
					<span class="fa fa-search form-control-feedback"></span>
					<input type="text" id="keysearch" class="form-control" placeholder="search" value={{ (isset($key)) ? $key : ""}}>
				</div>
				<div class="form-group">
					<label for="category-select">Category</label>
					<select class="form-control" id="category-select">
						<option {{ ($category == -1) ? 'selected' : "" }} value="-1">All</option>
						@foreach($categories as $cate)
						<option {{ ($category == $cate->id) ? 'selected' : "" }} value="{{$cate->id}}">{{$cate->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">Group By</label>
					<select class="form-control" id="groupby-select">
						<option {{ ($orderby == 0) ? 'selected' : "" }} value="0">Rating down</option>
						<option {{ ($orderby == 1) ? 'selected' : "" }} value="1">Rating up</option>
					</select>
				</div>
				<div class="form-group">
					<label for="">Count Books</label>
					<select class="form-control" id="paginate-select">
						<option {{ ($paginate == 10) ? 'selected' : "" }} value="10">Show 10 books</option>
						<option {{ ($paginate == 15) ? 'selected' : "" }} value="15">Show 15 books</option>
						<option {{ ($paginate == 20) ? 'selected' : "" }} value="20">Show 20 books</option>
						<option {{ ($paginate == 25) ? 'selected' : "" }} value="25">Show 25 books</option>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">search</button>
			</form>
		</div>
	</div>
	<div class="col-9 infocontainer">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">
				<i class="fas fa-home"></i>
			</a></li>
			<li class="breadcrumb-item active">search</li>
		</ol>
		<div id="paginate">		
			@if($data != null)
			<div class="alert alert-success alert-dismissible fade show">
				<li>Found {{$data->toArray()['total']}} results with " {{ $key }} "</li>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="all-products-container" id="product-container">
				@foreach ($data as $book)
				<div class="product-container container shadow-hover" id="#example">
					<div class="row">
						<div class="col-md-6 col-12">
							<div class="product-image">
								<img src="{{$book->img}}">
							</div>
							<div class="rate">
								@if($book->average_rating > 0)
								@php
								$average_evalate = $book->average_rating;
								$remain = 5  - $average_evalate;
								@endphp

								@for($i = 0; $i < (int)$average_evalate;$i++)
								<i class="fas fa-star" style="color: #f1c40f;font-size: 15px"></i>
								@endfor
								@if(($average_evalate + (int)$remain) != 5)
								<i class="fas fa-star-half-alt" style="color: #f1c40f;font-size: 15px"></i>
								@endif

								@for($i = 0; $i < (int)$remain;$i++)
								<i class="far fa-star" style="font-size: 15px;color: #f1c40f"></i>
								@endfor
								<p>Rating : {{ round($average_evalate,1) }}/5</p>
								@endif
							</div>
						</div>
						<div class="col-md-6 col-12">
							<div class="product-info">
								<div class="book-name">
									<a href="{{ route('book',$book->id) }}"><b></b>{{$book->name}}</a>
								</div>
								<div class="book-info-panel">
									<div class="book-quantity">
										Remaining: {{$book->quantity}} books
									</div>
									<div class="book-describes">
										Describes : {{substr($book->describes,0,40)}}...
									</div>
									<button class="get-book-btt" data-book-id="{{$book->id}}">
										Get it now
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<hr>
			<div style="width: 100%;" class="d-flex justify-content-center">
				{!! $data->appends(request()->query())->links() !!}
			</div>
			@else
			<div class="alert alert-warning alert-dismissible fade show">
				<li>Nothing to show, please input key to search more books !</li>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endsection