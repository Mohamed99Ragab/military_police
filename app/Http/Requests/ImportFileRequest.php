<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportFileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file'=>'required|mimes:xlsx,xls'
        ];
    }


    public function messages()
    {
        return [
            'file.required'=>'يرجى رفع الملف',
            'file.mimes'=>'يجب ان يكون الملف المرفوع من اكسيل فقط'
        ];
    }
}
