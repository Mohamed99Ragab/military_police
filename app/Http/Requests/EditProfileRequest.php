<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'username'=>'required|unique:users,username,'.auth()->id(),
            'password'=>'nullable',
            'phone_number'=>'nullable',
            'password-confirm'=>'nullable|same:password',
            'photo'=>'nullable|file|mimes:png,jpg'
        ];
    }


    public function messages(){
        return [
            'username.required'=>'حقل اسم المستخدم مطلوب',
            'username.unique'=>'اسم المستخدم مسجل لدى حساب اخر',
            'password-confirm.same'=>'يجب ان يطابق حقل تأكيد كلمة السر مع كلمة السر',

        ];
    }
}
