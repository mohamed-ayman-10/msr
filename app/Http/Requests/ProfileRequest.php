<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $this->id,
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'برجاء ادخال الاسم',
            'username.required' => 'برجاء ادخال اسم المستخدم',
            'username.unique' => 'اسم المستخدم موجود',
            'email.required' => 'برجاء ادخال البريد الالكتروني',
            'email.unique' => 'البريد الالكتروني موجود',

        ];
    }
}
