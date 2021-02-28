@if($count_ratings > 0)
@foreach($data as $rating)
<div class="other-user-comment">
	<div class="row">
		<div class="col-1">
			<div class="user-info-comment">
				<div>
					<div>
						@if($rating->user->image)
						<img src="{{ $rating->user->image }}" class="user-avatar-comment">
						@else
						<img src="{{ asset('images/default.png') }}" class="user-avatar-comment">
						@endif
					</div>
				</div>
			</div>
		</div>
		<div class="col-11 comment">
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

			<div style="width: 100%;" class="mt-2">
				<textarea class="user-comment-textarea" readonly>{{ $rating->comment }}</textarea>
			</div>
		</div>
	</div>
</div>
<br>
@endforeach
<div style="width: 100%;display: flex;justify-content: center;align-items: center">
	{!! $data->appends(['num_comment' => $num_comment,'num_star' => $num_star])->links() !!}
</div>
@else
<div class="alert alert-warning">
	<li>No Comment!</li>
</div>
@endif