<?php

namespace App\Http\Requests\Shifts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShiftRequest extends FormRequest
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
            'name'=>'required|unique:shifts,name,'.$this->id
        ];
    }

    public function messages(){
        return [
            'name.required'=>'حقل الشيفت مطلوب',
            'name.unique'=>'هذا الشيفت مسجل من قبل',

        ];
    }
}
