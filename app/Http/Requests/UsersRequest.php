<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'same:password',
            'phone' => 'required'
        ];
    }

    public function messages(){
        return [
            'firstname.required' => 'Họ không được trống.',
            'lastname.required' => 'Tên không được trống.',
            'email.required' => 'Email không được trống.',
            'password.required' => 'Mật khẩu không được trống.',
            'password.min' => 'Mật khẩu tối thiểu 6 ký tự.',
            'confirm_password.same' => 'Nhập lại mật khẩu không trùng khớp.',
            'phone.required' => 'Số điện thoại không được trống.',
            'email.unique' => 'Email đã tồn tại.'
        ];
    }
}
