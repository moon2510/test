<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'password' => 'nullable|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'confirm_password' => 'same:password',
        ];
    }

    public function messages(){
        return [
            'firstname.required' => 'Firstname must be filled !.',
            'lastname.required' => 'Lastname must be filled.',
            'phone.required' => 'Phone must be filled',
            'address.required' => 'Address must be filled',
            'password.min' => 'Your password must be more than 8 characters long.',
            'password.regex' => 'Your password should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.',
            'confirm_password.same' => 'Confirm password does not same password.'
        ];
    }
}
