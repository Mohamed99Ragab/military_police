<?php

namespace App\Http\Requests\Soliders;

use Illuminate\Foundation\Http\FormRequest;

class StoreSoliderRequest extends FormRequest
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
            'full_name'=>'required|string|min:15',
            'address'=>'required|string',
            'phone_number'=>'required|unique:soliders,phone_number|string|min:11|max:11',
            'military_number'=>'required|unique:soliders,military_number|string|min:13|max:13',
            'photo'=>'nullable|file|mimes:png,jpej,jpg',
            'degree_id'=>'required|exists:degrees,id',
            'service_id'=>['nullable','exists:services,id'],
            'service_place_id' => [
                function ($attribute, $value, $fail) {
                    if ($this->service_id) {
                        if (is_null($value)) {
                            $fail('يرجى تحديد مكان التواجد.');
                        } elseif (!\App\Models\ServicePlace::where('id', $value)->exists()) {
                            $fail('مكان التواجد المحدد غير موجود.');
                        }
                    }
                },
            ],
            'shift_id' => [
                function ($attribute, $value, $fail) {
                    if ($this->service_id && $this->service_place_id) {
                        if (is_null($value)) {
                            $fail('يرجى تحديد الوردية.');
                        } elseif (!\App\Models\Shift::where('id', $value)->exists()) {
                            $fail('الوردية المحددة غير موجودة.');
                        }
                    }
                },
            ],


        ];
    }


    public function messages(){
        return [
            'full_name.required'=>'حقل الاسم مطلوب',
            'full_name.min'=>'يرجى ادخال اسم رباعي كحد ادنى 15 حرف',
            'address.required'=>'حقل العنوان مطلوب',
            'phone_number.required'=>'حقل رقم الهاتف مطلوب',
            'phone_number.min'=>'حقل رقم الهاتف  غير صحيح',
            'phone_number.max'=>'حقل رقم الهاتف غير صحيح',
            'phone_number.unique'=>'حقل رقم الهاتف مسجل مسبقا لدى فرد اخر',
            'military_number.required'=>'حقل الرقم العسكري مطلوب',
            'military_number.unique'=>'حقل الرقم العسكري مسجل مسبقا لدى فرد اخر',
            'military_number.min'=>'يجب ان يكون الرقم العسكري مكون من 13 رقم',
            'military_number.max'=>'يجب ان يكون الرقم العسكري مكون من 13 رقم',
            'photo.mimes'=>'يجب ان يكون نوع الملف صورة فقط',
            'degree_id.exists'=>'حقل الدرجة غير صحيح',
            'degree_id.required'=>'حقل الدرجة مطلوب',



        ];
    }
}
