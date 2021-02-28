<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use Auth;
use DB;

class RatingController extends Controller
{
    public function getRatingPaginate(Request $request)
    {
        $data = Rating::where('book_id','=',$request->book_id)->orderBy('updated_at','DESC');
        $num_comment = $request->num_comment;
        $num_star = $request->num_star;
        $returned_data = null;
        if($num_star == 0){
            $returned_data = $data->paginate($num_comment);
        }else{
            $returned_data = $data->where('star_number','=',$num_star)->paginate($num_comment);
        }
        $count = $returned_data->toArray()['total'];
        return view('layouts.user_comment_section',[
            'count_ratings'=>$count,
            'data' => $returned_data,
            'num_comment' => $num_comment,
            'num_star' => $num_star
        ]);
    }

    public function Rating(Request $request)
    {
        $data = $request->only('comment','star_number','user_id','book_id');
        if ($request->rating_id == null) {
            if(Rating::create($data)){
                return redirect()->back()->with(['class' => 'success', 'message' => 'Rating Success.']);
            }else{
                return redirect()->back()->with(['class' => 'danger', 'message' => 'Rating error.']);
            }
        }
        $result = Rating::find($request->rating_id)->update($data);
        if ($result) {
            return redirect()->back()->with(['class' => 'success', 'message' => 'Update Success.']);
        }else{
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Rating error.']);
        }
    }

    public function destroy(Request $request)
    {
        $rating = Rating::where('user_id','=',Auth::user()->id)->where('book_id','=',$request->id)->first();
        if ($rating->delete()) {
            return redirect()->back()->with(['class' => 'success', 'message' => 'Delete success']);
        }else{
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Rating error.']);
        }
    }
}
