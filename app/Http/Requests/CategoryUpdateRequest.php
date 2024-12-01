<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'nameupdate' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nameupdate.required' => 'Tên danh mục không được trống.',
            'nameupdate.max'  => 'Tên danh mục không được phép vượt quá 255 kí tự.',
        ];
    }
}
