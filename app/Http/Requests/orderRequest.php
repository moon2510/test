<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class orderRequest extends FormRequest
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
            'readers' => 'required',
            'book.*.id' => 'required',
            'book.*.quantity' => 'min:1',
            'book' => 'required'
        ];
    }

    public function messages(){
        return [
            'readers.required' => 'Độc giả không được trống',
            'book.*.id.required' => 'Vui lòng chọn sách',
            'book.*.quantity.min' => 'Số lượng tối thiểu là 1',
            'book.required' => 'Vui lòng thêm sách'
        ];
    }
}
