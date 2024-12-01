<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeUpdateRequest extends FormRequest
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
            // 'codeupdate' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            // 'codeupdate.required' => 'Mã thể loại không được trống.',
            // 'codeupdate.max'  => 'Mã thể loại không được phép vượt quá 255 kí tự.',
            'nameupdate.required' => 'Tên thể loại không được trống.',
            'nameupdate.max'  => 'Tên thể loại không được phép vượt quá 255 kí tự.',
        ];
    }
}
