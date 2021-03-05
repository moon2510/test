<div class="all-products-container" id="product-container">
	@foreach ($data as $book)
	<div class="product-container container shadow-hover" id="#example">
		<div class="row">
			<div class="col-md-6 col-12">
				<div class="product-image">
					<img src="{{$book->img}}">
				</div>
				<div class="rate">
					@if(!is_null($book->ratings->avg('star_number')))
					@php
					$average_evalate = $book->ratings->avg('star_number');
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
							Remaining: {{$book->quantity}} 
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
	{!! $data->appends(['paginate'=>$page_selection,'orderby'=>$orderby])->links() !!}
</div>