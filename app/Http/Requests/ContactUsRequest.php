<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required|max:300'
        ];
    }


    public function messages(){
        return [
            'name.required' => 'Name must be filled',
            'email.required' => 'Email must be filled',
            'phone.required' => 'Phone must be filled',
            'phone.numeric' => 'Phone must be numberic',
            'message.required' => 'Message must be filled'
        ];
    }
}
