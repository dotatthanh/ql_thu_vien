<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'birthday' => 'required',
            'sex' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|unique:customers',
            'password' => 'required|min:6|max:32',
        ];
    }

    public function messages() {
        return [
            'email.unique' => 'Địa chỉ email đã tồn tại!',
        ];
    }
}
