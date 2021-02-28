<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\LostBook;
use Validator;

class LostBookController extends Controller
{
    public function index(){
        $lostbooks = LostBook::orderBy('id', 'ASC')->paginate(50);
        return view('admin.lostbooks.index', compact(['lostbooks']));
    }

    public function store(Request $request){
    	$validator = Validator::make($request->all(), [
            'id'=>'required',
            'price'=>'required|integer|min:0'
        ],[
        	'id.required' => 'Không tìm thấy sách',
        	'price.min' => 'Tiền phạt tối thiểu là 0đ'
        ]);
        if($validator->passes()){
        	if(OrderDetail::find($request->id)){
	            if($LostBook = LostBook::create(['orderdetail_id' => $request->id, 'price' => $request->price, 'note' => $request->note])){
	                return response()->json(['error' => 0, 'message' => 'Báo mất thành công']);
	            }
	        }

        }else{
        	return response()->json(['error' => 1, 'message' => $validator->errors()->first()]);
        }
        return response()->json(['error' => 1, 'message' => 'Lỗi, thử lại sau']);
    }

    public function destroy(request $request){
        if($book = LostBook::find($request->id)){
            $book->delete();
            return response()->json(['error' => 0, 'message' => 'Đã xóa']);
        }
        return response()->json(['error' => 1, 'message' => 'Không tìm thấy sách']);
    }
}
