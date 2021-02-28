<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
use App\ContactUs;

class ContactUsController extends Controller
{
    public function index(){
    	return view('contact_us');
    }

    public function write_contact(ContactUsRequest $request){
    	$data = $request->only('name','email','phone','message');
    	if(ContactUs::create($data)){
    		return redirect()->back()->with(['class_contact' => 'success', 'message' => 'Write message success, wait admin reply in your email !']);
    	}
    	else{
    		return redirect()->back()->with(['class_newsletter' => 'danger', 'message' => 'Something wrong, try again later']);
    	}
    }
}
