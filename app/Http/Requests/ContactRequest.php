<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'namecontact' => 'required|max:100',
            'emailcontact' => 'required|email',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'namecontact.required' => 'Họ và tên là trường bắt buộc.',
            'namecontact.max'  => 'Họ và tên không được phép vượt quá 100 kí tự.',
            'emailcontact.required' => 'Email là trường bắt buộc.',
            'emailcontact.email' => 'Email không đúng định dạng.',
            'content.required' => 'Nội dung là trường bắt buộc.',
        ];
    }
}
