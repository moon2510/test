<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rating;

class RatingController extends Controller
{
    public function index(){
    	$comments = Rating::orderBy('id', 'DESC')->paginate(50);
    	return view('admin.comments.index', compact('comments'));
    }

    public function destroy(Request $request){
        $data = $request->only('id');
        if($comment = Rating::find($data['id'])){
            if($comment->delete()){
                return response()->json(['error' => 0, 'message' => 'Xóa bình luận thành công']);
            }
        }
        return response()->json(['error' => 1, 'message' => 'Không tìm thấy bình luận']);
    }

    public function search(request $request){
        $comments = Rating::whereHas('user', function ($query) use ($request){
            return $query->WhereRaw("concat(firstname, ' ', lastname) like '%$request->key%' ");
        })->orWhere('id', 'like', "%$request->key%")->orWhereHas('book', function ($query) use ($request){
        	return $query->where('name', 'like', "%$request->key%");
        })->orWhere('comment', 'like', "%$request->key%")->orderBy('id', 'DESC')->paginate(50);
        return view('admin.comments.index', compact('comments'));
    }
}
