<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
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
            'titleupdate' => 'required|max:255',
            'summaryupdate' => 'required',
            'imgupdate' => 'required',
            'contentupdate' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'titleupdate.required' => 'Tiêu đề không được trống.',
            'titleupdate.max'  => 'Tiêu đề không được phép vượt quá 255 kí tự.',
            'summaryupdate.required' => 'Tóm tắt không được trống.',
            'imgupdate.required' => 'Ảnh là trường bắt buộc.',
            'contentupdate.required' => 'Nội dung không được trống.',
        ];
    }
}
