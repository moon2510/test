<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'title'=>'string|required',
            'subtitle'=>'string|required',
            'link' => 'required|url',
            'button_title' => 'string|required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề Slider không được trống',
            'subtitle.required' => 'Mô tả thêm không được trống',
            'link.required' => 'Liên kết chuyển hướng không được trống',
            'link.url' => 'Liên kết không hợp lệ',
            'button_title.required' => 'Tiêu đề nút chuyển hướng không được trống'
        ];
    }
}
