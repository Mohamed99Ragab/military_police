<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoliderServiceRequest extends FormRequest
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
            'service_id'=>'required|exists:services,id',
            'service_place_id'=>['required','exists:service_places,id'],
            'degree_id'=>'required|exists:degrees,id',
            'shift_id'=>'required|exists:shifts,id',
            'solider_id'=>'required|exists:soliders,id',
        ];
    }

    public function messages(){
        return [
            'service_id.required'=>'حقل الخدمة مطلوب',
            'service_place_id.required'=>'حقل مكان الخدمة مطلوب',
            'service_place_id.exists'=>'مكان الخدمة غير صحيح',
            'degree_id.required'=>'حقل الدرجة مطلوب',
            'shift_id.required'=>'حقل الشيفت مطلوب',
            'shift_id.exists'=>'حقل الشيفت غير صحيح',
            'service_id.exists'=>'هذه الخدمة غير صحيحة',
            'degree_id.exists'=>'حقل الدرجة غير صحيح',
            'degree_id.required'=>'حقل الدرجة مطلوب',
            'solider_id.exists'=>'حقل الفرد غير صحيح',
            'solider_id.required'=>'حقل الفرد مطلوب',



        ];
    }

    public function attributes(){
        return [
            'service_place_id'=>'حقل مكان الخدمة'
        ];
    }
}
