<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'name' => 'required|unique:authors|max:50',
            'sex' => 'required',
            'birthday' => 'required',
            'story' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên tác giả không được trống.',
            'name.unique' => 'Tên tác giả đã tồn tại.',
            'name.max'  => 'Tên tác giả không được phép vượt quá 50 kí tự.',
            'sex.required'  => 'Giới tính không được trống.',
            'birthday.required'  => 'Ngày sinh không được trống.',
            'story.required'  => 'Tiểu sử không được trống.',
        ];
    }
}
