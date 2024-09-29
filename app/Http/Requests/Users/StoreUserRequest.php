<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username'=>'required|unique:users,username',
            'password'=>'nullable',
            'phone_number'=>'nullable',
            'password-confirm'=>'nullable|same:password',
            'photo'=>'nullable|file|mimes:png,jpg',
            'role'=>'required|in:ادمن,جندي,صف ظابط',
            'full_name'=>'required|string'
        ];
    }

    public function messages(){
        return [
            'username.required'=>'حقل اليوزنيم مطلوب',
            'full_name.required'=>'حقل اسم المستخدم مطلوب',
            'username.unique'=>'اسم المستخدم مسجل لدى حساب اخر',
            'password-confirm.same'=>'يجب ان يطابق حقل تأكيد كلمة السر مع كلمة السر',
            'role.required'=>'حقل الصلاحية مطلوب'

        ];
    }
}
