<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaccationRequest extends FormRequest
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
            'drop_date'=>'required|date|after_or_equal:today',
            'return_date'=>'required|date|after_or_equal:today|after:drop_date',
            'note'=>'nullable',
            'type'=>'required'
        ];
    }

    public function messages(){
        return [
            'solider_id.exists'=>'حقل الفرد غير صحيح',
            'drop_date.required'=>'حقل معاد النزول مطلوب',
            'drop_date.after_or_equal'=>'حقل معاد النزول يجب ان يكون تاريخ حاضر او مستقبلي',
            'return_date.required'=>'حقل معاد العوده مطلوب',
            'return_date.after_or_equal'=>'حقل معاد العوده يجب ان يكون تاريخ حاضر او مستقبلي',
            'return_date.after'=>'حقل معاد العوده يجب ان يكون تاريخ لاحقا لمعاد النزول',
            'type.required'=>'يرجى تحديد نوع الاجازاة'
        ];
    }
}
