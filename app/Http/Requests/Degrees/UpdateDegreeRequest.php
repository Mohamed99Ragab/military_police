<?php

namespace App\Http\Requests\Degrees;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDegreeRequest extends FormRequest
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
            'name'=>'required|unique:degrees,name,'.$this->id
        ];
    }

    public function messages(){
        return [
            'name.required'=>'حقل الدرجة مطلوب',
            'name.unique'=>'الدرجة مسجلة من قبل',

        ];
    }
}
