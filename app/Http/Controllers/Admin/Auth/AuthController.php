<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    

    public function viewLogin(){

        return view('admin.auth.login');
    }


    public function login(LoginRequest $request){

        $remember = $request->has('remember');
        if(auth()->attempt(['username' => $request->username, 'password' => $request->password],$remember)){
           
            notify()->success('تم تسجيل الدخول بنجاح','نجاح');

            return redirect()->route('admin.home');
        }
        notify()->error('بيانات الدخول غير صحيحة');

        return redirect()->back();


    }

    public function logout(){

        auth()->logout();

        notify()->success('تم تسجيل الخروج بنجاح');

        return redirect()->route('login');

    }



}
