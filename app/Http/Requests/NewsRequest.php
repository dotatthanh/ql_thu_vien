<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => 'required|unique:news|max:255',
            'summary' => 'required',
            'img' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề không được trống.',
            'title.unique' => 'Tin tức đã tồn tại.',
            'title.max'  => 'Tiêu đề không được phép vượt quá 255 kí tự.',
            'summary.required' => 'Tóm tắt không được trống.',
            'img.required' => 'Ảnh là trường bắt buộc.',
            'content.required' => 'Nội dung không được trống.',
        ];
    }
}
