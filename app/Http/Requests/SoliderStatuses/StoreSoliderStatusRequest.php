<?php

namespace App\Http\Requests\SoliderStatuses;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoliderStatusRequest extends FormRequest
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
            'solider_id'=>'required|exists:soliders,id',
            'go_date'=>'required|date',
            'return_date'=>'sometimes',
            'note'=>'nullable',
            'status'=>'required'
        ];
    }

    public function messages(){
        return [
            'solider_id.exists'=>'حقل الفرد غير صحيح',
            'go_date.required'=>'حقل معاد الذهاب مطلوب',
            'go_date.after_or_equal'=>'حقل معاد الذهاب يجب ان يكون تاريخ حاضر او مستقبلي',
            'return_date.required'=>'حقل معاد العوده مطلوب',
            'return_date.after_or_equal'=>'حقل معاد العودة يجب ان يكون تاريخ حاضر او مستقبلي',
            'return_date.after'=>'حقل معاد العوده يجب ان يكون تاريخ لاحقا لمعاد الذهاب',
            'status.required'=>'يرجى تحديد الحالة'
        ];
    }
}
