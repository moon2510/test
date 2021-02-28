<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Rating;
use App\Order;
use Auth;

class BookController extends Controller
{

	public function showBookDetailByID($id,Request $request)
	{
		$data = Book::find($id);
		if($data == null) abort(404);

		$user_rating = Auth::check() ? $data->ratings()->where('user_id','=',Auth::user()->id)->first() : null;
		$count_ratings = $data->ratings->count();
		$percentOfRatings = array();
		if ($count_ratings == 0) {
			for($i = 1;$i <= 5;$i++){
				array_push($percentOfRatings,0);
			}
		}else{
			for($i = 1;$i <= 5;$i++){
				array_push($percentOfRatings,round($data->ratings->where('star_number','=',$i)->count()*100/$count_ratings));
			}
		}
		$average_avalate = round($data->ratings()->avg('star_number'),1);

		$num_comment = $request->has('num_comment') ? $request->num_comment : 5;
		$num_star = $request->has('num_star') ? $request->num_star : 0;
		if($num_star == 0){
			$ratings = Rating::where('book_id','=',$id)->orderBy('ratings.updated_at','DESC')->paginate($num_comment);
		}else{
			$ratings = Rating::where('book_id','=',$id)->where('star_number','=',$num_star)->orderBy('ratings.updated_at','DESC')->paginate($num_comment);
		}

		$borrow_count = Order::whereHas('orderdetail' , function($query)  use ($id){
           $query->where('book_id','=',$id);
        })->wherein('status',[4,5])->count();
        
		return view('book',[
			'book' => $data,
			'ratings' => $ratings,
			'user_rating' => $user_rating,
			'percent_of_ratings' => json_encode($percentOfRatings),
			'average_evalate' => $average_avalate,
			'count_ratings' => $count_ratings,
			'num_comment' => $num_comment,
			'num_star' => $num_star,
			'borrow_count' => $borrow_count
		]);
	}
}
