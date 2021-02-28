@extends('layouts.main')

@section('page-title','Home')

@section('custom-css')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
@endsection

@section('page-content')

<div class="category-container">
	<div class="row">
		<div class="col-lg-3 col-sm-12col-12">
			<div class="category-list">
				<p class="list-group-item cat-item text-left" style="background-color: #e74c3c;color: white">Categories</p>
				<ul class="list-group">
					
					@foreach($categories as $category)
					<a href="{{ route('category', $category->id) }}">
						<li class="list-group-item cat-item">
							{{$category->name}}
						</li>
					</a>
					@endforeach

				</ul>
			</div>
		</div>
		<div class="col-lg-9 d-none d-lg-block">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					@for($i = 1;$i <= count($ImageSlider) - 1;$i++)
					<li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
					@endfor
				</ol>
				<div class="carousel-inner">
					@php
					$i = 0;
					@endphp
					@foreach($ImageSlider as $image)
					<div class="carousel-item {{($i == 0) ? 'active' : ''}}">
						<img class="d-block w-100" src="{{ asset($image->path) }}" alt="Second slide" height="500">
						<div class="carousel-caption d-none d-md-block">
							@if($image->title != null)
							<h4>{{ $image->title }}</h4>
							@endif
							@if($image->subtitle != null)
							<p>{{ $image->subtitle }}</p>
							@endif
							@if($image->button_title != null)
							<a href="{{ $image->link }}" class="btn btn-success" role="button">{{ $image->button_title}}</a>
							@endif
						</div>
					</div>
					@php
					$i = 1;
					@endphp
					@endforeach
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="product-container">
	<div class="row d-flex justify-content-center">
		<div class="col-12">
			@foreach($databooks as $key => $books)
			<div class="product-by-category-container">
				<div class="category-name">
					@switch($key)
					@case(0)
					<a>Newest Books</a>
					@break
					@case(1)
					<a>Top Rating Books</a>
					@break
					@default
					<a href="{{ route('category', $books[0]->category->id) }}">Category : {{$books[0]->category->name}}</a>
					@break
					@endswitch
				</div>
				<div class="book-container">
					<div class="row d-flex justify-content-center">
						<div class="col-md-11 col-12 book-list">
							@foreach ($books as $book)
							<div class="book-item">
								<figure class="book-cover">
									<a href="{{ route('book',$book->id) }}">
										@if($book->img == null)
										<img src="{{ asset('images/default.jpg') }}"  alt="Book Image" hr>
										@else
										<img src="{{$book->img}}" alt="Book Image" hr>
										@endif
									</a>
								</figure>

								<div class="book-info">
									<div class="book-name">
										<a href="{{ route('book',$book->id) }}">{{$book->name}}</a>
									</div>
									<div class="book-quantity">
										<p>Remaining: {{$book->quantity}} books</p>
									</div>
									<!-- <div class="book-price">
										<p>{{number_format($book->price)}} VND</p>
									</div> -->
									<div class="book-buy">
										<button class="get-book-btt" data-book-id="{{$book->id}}">Get it now</button>
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
										@endif
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			<hr>
			@endforeach
		</div>
	</div>
</div>

<div class="top-user-container">
	<div class="row d-flex justify-content-center">
		<div class="col-8">
			<div class="title_comment">
				<a>Top Comments</a>
			</div>
			<div>
				<div class="slider-for">
					@foreach($top_rating as $rating)
					<div class="row d-flex justify-content-center item">
						<div class="col-4">
							<img class="book_rating_image" src="{{ asset($rating->book->img) }}" alt="" height="300px" style="float: right">
						</div>
						<div class="col-8">
							<div class="row avatar_comment">
								<div class="col-3">
									<img src="{{ asset($rating->user->image) }}" alt="">
								</div>
								<div style="padding-top: 20px">
									<div style="width: 100%" class="mt-2">
										<p style="font-weight: bold">{{ $rating->user->firstname }}</p> Commented at {{ get_timeago($rating->updated_at) }} 
									</div>
									<div style="width: 100%;font-weight: bold" class="mt-2">
										@php
										$remaining_rating = 5 - $rating->star_number;
										@endphp

										@for($i = 1; $i <= $rating->star_number; $i++)
										<i class="fas fa-star" style="color: #f1c40f"></i>
										@endfor

										@for($i = 1; $i <= $remaining_rating; $i++)
										<i class="fas fa-star" style="color: darkgray"></i>
										@endfor

										@if($rating->star_number == 1) <b> Angry</b>
										@elseif ($rating->star_number == 2) <b> Disappointed</b>
										@elseif ($rating->star_number == 3) <b> Neutral</b>
										@elseif ($rating->star_number == 4) <b> Good</b>
										@elseif ($rating->star_number == 5) <b> Excellent</b>
										@endif					
									</div>
								</div>
							</div>
							<div class="col-12 text-center mt-4">
								<textarea readonly>&ldquo;{{$rating->comment}}&bdquo;</textarea>
							</div>
							<div class="col-12">
								<p class="book_comment">Book : <a href="{{ route('book',$rating->book->id) }}">{{$rating->book->name}}</a></p>
							</div>
						</div>
					</div>
					@endforeach
				</div>

				<div class="row d-flex justify-content-center">
					<div class="col-10">
						<div class="slider-nav" style="padding-top: 20px">
							@foreach($top_rating as $rating)
							<div class="item">
								@if($rating->user->image !== null)
								<img src="{{ asset($rating->user->image) }}" alt=""  class="center">
								@else
								<img src="{{ asset('images/default.png') }}" alt=""  class="center">
								@endif
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-4">
			<div class="title_comment">
				<a>Top Users In {{ date("m") }} - {{ date("Y")}}</a>
			</div>
			<div class="top_table">
				<table class="table table-striped">
					<thead>
						<tr>
							<th class="text-center">Top</th>
							<th>Name</th>
							<th class="text-center">Count Order</th>
						</tr>
					</thead>
					<tbody>
						@foreach($top_user as $key => $user)
						<tr>
							<td class="text-center">{{$key + 1}}</td>
							<td>{{$user->firstname}}</td>
							<td class="text-center">{{$user->count_order}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
@endsection