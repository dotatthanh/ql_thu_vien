<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
            'name' => 'required|max:100',
            // 'code' => 'required|unique:books',
            'price' => 'required|min:1',
            'sale' => 'min:0',
            'content' => 'required',
            'size' => 'required',
            'page_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'size.required' => 'Kích thước sách không được trống.',
            'page_number.required' => 'Số trang không được trống.',
            'name.required' => 'Tên sách không được trống.',
            'name.max'  => 'Tên sách không được phép vượt quá 100 kí tự.',
            // 'code.required' => 'Mã sách không được trống.',
            // 'code.unique' => 'Mã sách đã tồn tại.',
            'price.required'  => 'Đơn giá không được trống.',
            'price.min'  => 'Đơn giá lớn hơn 0.',
            'sale.min'  => 'Giảm giá lớn hơn hoặc bằng 0.',
            'content.required'  => 'Tóm tắt nội dung không được trống.',
        ];
    }
}
