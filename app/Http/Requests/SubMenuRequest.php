<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubMenuRequest extends FormRequest
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
            'title' => 'required',
            'menu' => 'required',
            'check' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'برجاء ادخال عنوان الصفحة',
            'menu.required' => 'برجاء اختيار قائمة رئيسية',
            'check.required' => 'برجاء اختيار محتوي الصفحه',
        ];
    }
}
