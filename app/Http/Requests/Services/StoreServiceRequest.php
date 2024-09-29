<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'name'=>'required|unique:services,name'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'حقل اسم الخدمة مطلوب',
            'name.unique'=>'الخدمة مسجلة من قبل',

        ];
    }
}
