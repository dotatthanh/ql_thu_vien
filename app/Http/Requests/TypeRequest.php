<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
            'name' => 'required|unique:types|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên thể loại không được trống.',
            'name.unique' => 'Tên thể loại đã tồn tại.',
            'name.max'  => 'Tên thể loại không được phép vượt quá 255 kí tự.',
        ];
    }
}
