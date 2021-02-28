<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->except('_token');
        if (\Auth::attempt($data)) {
        	//dd(\Auth::user());
        	if (\Auth::user()->roles == 1) {
        		return redirect()->route('admin-home'); //return to admin page
         	}
            //$request->session()->regenerate();
            return redirect()->route('home'); //return to home page
        }
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Đăng nhập thất bại.']); // todo:  make error when login
    }

    public function logout(){
        \Auth::logout();
        return redirect()->route('AdminLoginForm');
    }
}
