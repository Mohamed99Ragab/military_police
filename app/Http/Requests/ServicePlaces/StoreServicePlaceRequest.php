<?php

namespace App\Http\Requests\ServicePlaces;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicePlaceRequest extends FormRequest
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
            'name'=>'required|unique:service_places,name',
            'service_id'=>'required|exists:services,id'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'حقل مكان الخدمة مطلوب',
            'name.unique'=>'مكان الخدمة مسجل من قبل',
            'service_id.required'=>'حقل الخدمة مطلوب',
            'service_id.exists'=>'حقل الخدمة غير صحيح',

        ];
    }
}
