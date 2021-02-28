<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserRequest;
use App\User;
use App\Config;
use Validator;
use File;

class UserController extends Controller
{
    public function index(){
    	$users = User::orderBy('id', 'DESC')->paginate(50);
    	return view('admin.users.index', compact('users'));
    }

    public function create(){
    	return view('admin.users.create');
    }

    public function store(UsersRequest $request){
    	$data = $request->except('_token');
    	$data['password'] = bcrypt($data['password']);
        if($request->hasFile('img')){
            $file = $request->file('img');
            $filename = '/images/avatars/'.md5(time()).'.jpg';
            $file->move(public_path('/images/avatars/'), $filename);
            $data['image'] = $filename;
        }
    	if($user = User::create($data)){
    		return redirect()->route('User.Show', $user->id)->with(['class' => 'success', 'message' => 'Thêm thành viên thành công.']);
    	}
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Lỗi hệ thống, thử lại sau.']);
    }

    public function edit($id){
        if($user = User::find($id)){
            return view('admin.users.edit', compact('user'));
        }
        return redirect()->route('User.List');
    }

    public function update(UserUpdateRequest $request, $id){
    	$data = $request->except('_token', 'email');
    	if($user = User::find($id)){
            $data['password'] = isset($data['password']) ? bcrypt($data['password']) : $user->password;
            if($request->hasFile('img')) {
                $file = request()->file('img');
                $filename = '/images/avatars/'.md5(time()).'.jpg';
                $file->move(public_path('/images/avatars/'), $filename);
                $data['image'] = $filename;
                if(File::exists(public_path().$user->image)) {
                    File::delete(public_path().$user->image);
                }
            }
            if ($user->update($data)) {
                return redirect()->route('User.Show', $user->id)->with(['class' => 'success', 'message' => 'Thay đổi thông tin thành viên thành công.']);
            }else{
                return redirect()->route('User.Show', $user->id)->with(['class' => 'danger', 'message' => 'Lỗi, thử lại sau.']);
            }
    	}
    	return redirect()->route('User.List');
    }

    public function UpdateExpiry(request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'price' => 'integer|min:0'
        ],[
            'id.required' => 'Thành viên không được trống',
            'price.min' => 'Số tiền gia hạn tối thiểu là 0đ'
        ]);
        if($validator->passes()){
            $config = Config::where('name', 'price_per_day')->first();
            $price_per_day = ($config !== null) ? $config->value : 0;
            if($user = User::find($request->id)){
                $days = $request->price/$price_per_day;
                $user->account_expiry_date = date("Y-m-d H:i:s", strtotime('+'.$days.' day', strtotime($user->account_expiry_date)));
                if($user->save()){
                    return response()->json(['error' => 0, 'message' => 'Đã gia hạn thành công']);
                }
            }
            return response()->json(['error' => 1, 'message' => 'Lỗi, thử lại sau']);
        }
        else{
            return response()->json(['error' => 1, 'message' => $validator->errors()->first()]);
        }
    }

    public function show($id){
        if($user = User::find($id)){
            return view('admin.users.detail', compact('user'));
        }
        return redirect()->route('User.List');
    }

    public function destroy(Request $request){
        $data = $request->only('id');
        if($user = User::find($data['id'])){
            if($user->delete()){
                if(File::exists(public_path().$user->image)) {
                    File::delete(public_path().$user->image);
                }
                return response()->json(['error' => 0, 'message' => 'Xóa thành viên thành công']);
            }
        }
        return response()->json(['error' => 1, 'message' => 'Không tìm thấy thành viên']);
    }

    public function search(request $request){
        $users = User::WhereRaw("concat(firstname, ' ', lastname) like '%$request->key%' ")->orWhere('email', 'like', "%$request->key%")->orWhere('phone', 'like', "%$request->key%")->paginate(50);
        return view('admin.users.index', compact('users'));
    }

    public function apiSearch(request $request){
        $key = ($request->q !== null) ? $request->q : '';
        $users = User::WhereRaw("concat(firstname, ' ', lastname) like '%$key%' ")->orWhere('email', 'like', "%$key%")->orWhere('phone', 'like', "%$key%")->get();
        return response()->json($users->map(function($item){
            $data = [
                'id' => $item->id,
                'text' => $item->firstname.' '.$item->lastname.' - '.$item->email
            ];
            return $data;
        }));
    }
}
