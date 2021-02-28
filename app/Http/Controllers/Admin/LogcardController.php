<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\log_nap_the;

class LogcardController extends Controller
{
    public function index(){
    	$logcard = log_nap_the::orderBy('id', 'ASC')->paginate(50);
    	return view('admin.transaction.index', compact(['logcard']));
    }

    public function search(Request $request){
    	$logcard = log_nap_the::whereHas('user', function($query) use ($request){
    		return $query->whereRaw("concat(firstname, ' ', lastname) like '%$request->key%' ");
    	})->orWhere('id', "LIKE", "%$request->key%")->orWhere('seri', "LIKE", "%$request->key%")->orWhere('pin', "LIKE", "%$request->key%")->orWhere('price', "LIKE", "%$request->key%")->orWhere('message', "LIKE", "%$request->key%")->orWhere('created_at', "LIKE", "%$request->key%")->paginate(50);
    	return view('admin.transaction.index', compact(['logcard']));
    }

    public function destroy(Request $request){
    	if($logcard = log_nap_the::find($request->id)){
    		if($logcard->delete()){
    			return response()->json(['error' => 0, 'message' => 'Đã xóa thành công']);
    		}
    		else{
    			return response()->json(['error' => 1, 'message' => 'Lỗi, thử lại lần sau']);
    		}
    	}
    	return response()->json(['error' => 1, 'message' => 'Không tìm thấy giao dịch']);
    }
}
