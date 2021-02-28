<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'confirm_password' => 'same:password',
            'phone' => 'required',
            'img'=>'mimes:jpeg,jpg,png,gif'
        ];
    }

    public function messages(){
        return [
            'firstname.required' => 'Họ không được trống.',
            'lastname.required' => 'Tên không được trống.',
            'confirm_password.same' => 'Nhập lại mật khẩu không trùng khớp.',
            'phone.required' => 'Số điện thoại không được trống.',
            'img.mimes' => 'File tải lên phải là một hình ảnh.'
        ];
    }
}
