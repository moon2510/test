<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUs;
use Validator;
use App\Mail\ContactReplyMail;

class ContactUsController extends Controller
{
    public function index(){
    	$contacts = ContactUs::orderBy('id', 'ASC')->paginate(50);
    	return view('admin.contact.index', compact(['contacts']));
    }

    public function show(request $request){
    	if($contact = ContactUs::find($request->id)){
    		return response()->json(['error' => 0, 'message' => '', 'data' => $contact]);
    	}
    	return response()->json(['error' => 1, 'message' => 'Không tìm thấy liên hệ']);
    }

    public function reply(request $request){
    	$validator = Validator::make($request->all(), [
    		'id' => 'required|integer',
    		'message' => 'required|string'
    	],[
    		'id.required' => 'Liên hệ không hợp lệ',
    		'message.required' => 'Nội dung phản hồi không được trống'
    	]);
    	if($validator->passes()){
    		if($contact = ContactUs::find($request->id)){
                $data = [
                    'contact' => $contact,
                    'reply' => $request->message
                ];
		        \Mail::to($contact->email)->send( new ContactReplyMail($data));
		        $contact->delete();
		        return response()->json(['error' => 0, 'message' => 'Đã phản hồi liên hệ']);
    		}
    		return response()->json(['error' => 1, 'message' => 'Không tìm thấy liên hệ']);
    	}
    	else{
    		return response()->json(['error' => 1, 'message' => $validator->errors()->first()]);
    	}
    }

    public function destroy(request $request){
    	if($contact = ContactUs::find($request->id)){
    		if($contact->delete()){
    			return response()->json(['error' => 0, 'message' => 'Xóa liên hệ thành công']);
    		}
    		else{
    			return response()->json(['error' => 1, 'message' => 'Lỗi hệ thống, thử lại sau']);
    		}
    	}
    	return response()->json(['error' => 1, 'message' => 'Không tìm thấy liên hệ']);
    }

    public function search(request $request){
    	$contacts = ContactUs::where('name', 'like', "%$request->key%")->orWhere('email', 'like', "%$request->key%")->orWhere('message', 'like', "%$request->key%")->orWhere('id', 'like', "%$request->key%")->orderBy('id', 'ASC')->paginate(50);
    	return view('admin.contact.index', compact(['contacts']));
    }
}
