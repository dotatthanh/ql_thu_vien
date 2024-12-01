<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorUpdateRequest extends FormRequest
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
            'nameupdate' => 'required|max:50',
            'sexupdate' => 'required',
            'birthdayupdate' => 'required',
            'storyupdate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nameupdate.required' => 'Tên tác giả không được trống.',
            'nameupdate.max'  => 'Tên tác giả không được phép vượt quá 50 kí tự.',
            'sexupdate.required'  => 'Giới tính không được trống.',
            'birthdayupdate.required'  => 'Ngày sinh không được trống.',
            'storyupdate.required'  => 'Tiểu sử không được trống.',
        ];
    }
}
