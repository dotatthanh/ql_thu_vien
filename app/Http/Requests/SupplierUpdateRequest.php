<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
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
            // 'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|min:10',
            'email' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'name.string' => 'Tên nhà cung cấp không được chứa các ký tự đặc biệt.',
            'name.max' => 'Tên nhà cung cấp không được phép quá 255 ký tự.',
            'name.required' => 'Tên nhà cung cấp là trường bắt buộc.',
            // 'code.string' => 'Tên nhà cung cấp không được chứa các ký tự đặc biệt.',
            // 'code.max' => 'Tên nhà cung cấp không được phép quá 255 ký tự.',
            // 'code.required' => 'Tên nhà cung cấp là trường bắt buộc.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'address.max' => 'Địa chỉ không được phép quá 255 ký tự.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.min' => 'Số điện thoại phải có 10 số.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email không được phép quá 255 ký tự.',
        ];
    }
}
