<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request){
    	if(Newsletter::where('email','=',$request->email)->first()){
			return redirect()->back()->with(['class_newsletter' => 'warning', 'message' => $request->email .' have subcribed before !']);
    	}
    	$data = ['email' => $request->email,'uuid' => $this->uuid()];
    	if(Newsletter::create($data)){
    		return redirect()->back()->with(['class_newsletter' => 'success', 'message' => 'Subcribe successfully with email ' . $request->email . ', You will receive mail when library have new book !']);
    	}
    	else{
    		return redirect()->back()->with(['class_newsletter' => 'danger', 'message' => 'Something wrong, try again later']);
    	}
    }

    private function uuid(){
    	$data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
