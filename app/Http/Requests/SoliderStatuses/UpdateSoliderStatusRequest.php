<?php

namespace App\Http\Requests\SoliderStatuses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSoliderStatusRequest extends FormRequest
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
            'go_date'=>'required|date',
            'return_date'=>'sometimes',
            'note'=>'nullable',
        ];
    }

    public function messages(){
        return [
            'solider_id.exists'=>'حقل الفرد غير صحيح',
            'go_date.required'=>'حقل معاد الذهاب مطلوب',
            'return_date.required'=>'حقل معاد العوده مطلوب',
            'return_date.after'=>'حقل معاد العوده يجب ان يكون تاريخ لاحقا لمعاد الذهاب',
        ];
    }
}
