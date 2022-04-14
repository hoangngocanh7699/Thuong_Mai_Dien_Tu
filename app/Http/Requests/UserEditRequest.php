<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'role_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được trống',
            'name.max' => 'Tên không được quá 255 kí tự',
            'email.required' => 'Email không được trống',
            'email.max' => 'Email không được quá 255 kí tự',
            'role_id.required' => 'Vai trò không được để trống',
        ];
    }
}
