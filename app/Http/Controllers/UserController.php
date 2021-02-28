<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\EditUserRequest;
use App\User;

class UserController extends Controller
{
	public function account(){
		return view('user.account');
	}

	public function edit_show(){
		return view('user.edit');
	}

	public function update(EditUserRequest $request){
		//dd($request);
		if($request->password === null){
			$data = $request->only('gender', 'phone', 'firstname', 'lastname', 'address');
		}
		else{
			$data = $request->only('gender', 'phone', 'firstname', 'lastname', 'address', 'password');
			$data['password'] = bcrypt($data['password']);
		}
		$user = User::where('email',$request->email);
		if ($user->update($data)) {
			return redirect()->back()->with(['class' => 'success', 'message' => 'Update Success.']);
		}else{
			return redirect()->back()->with(['class' => 'danger', 'message' => 'Error Database.']);
		}
	}

	public function upload(Request $request)
	{
		$rules = [ 'image' => 'image|max:1024' ]; 
		$posts = [ 'image' => $request->file('image') ];
		$valid = Validator::make($posts, $rules);
		if ($valid->fails()) {
			return redirect()->back()->with(['avaclass' => 'danger', 'message' => 'Avatar max size is 1024KB|1MB']);
		}else {
			$user = User::find(\Auth::user()->id);
			if($request->hasFile('image')) 
			{
				$item = request()->file('image');
				$name= $item->getClientOriginalName();
				$newName= '/images/avatars/'.md5(time()).$name;
                //upload ảnh vào thư mục public/images/product/
				$item->move(public_path('/images/avatars/'), $newName);
				$oldName = $user->image;
				if ($user->update(['image' => $newName])) {
					($oldName == null) ? "" : unlink(public_path().$oldName);
					return redirect()->back()->with(['avaclass' => 'success', 'message' => 'Update Success.']);
				}else{
					return redirect()->back()->with(['avaclass' => 'danger', 'message' => 'Error Database.']);
				}
			}
		}
	}
}
