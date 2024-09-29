<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Traits\FileManagement;

class EditProfileController extends Controller
{
    use FileManagement;

    public function index(){

        return view('admin.auth.edit-profile');
    }

    public function editProfile(EditProfileRequest $request){

        $user = User::findOrFail(auth()->id());

        $user->update([
            'username'=>$request->username,
            'phone_number'=>$request->phone_number,
            'full_name'=>$request->full_name,

        ]);

        if($request->has('password') && !empty($request->password)){
            $user->update(['password'=>Hash::make($request->password),]);
        }

        if($request->hasFile('photo')){
            $file_name = $this->storeFile($request->file('photo'),'/uploads/users/');

            // old file path
            $this->deleteFile($user->photo);
           
            $user->update(['photo'=>$file_name]);

        }

        notify()->success('تم تحديث بيانات الحساب بنجاح');

        return redirect()->back();

    }
}
