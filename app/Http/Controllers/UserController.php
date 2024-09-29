<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UdateUserRequest;

use Illuminate\Support\Facades\Hash;
use App\Traits\FileManagement;

class UserController extends Controller
{
    use FileManagement;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manage-users');
        $users = User::get();

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('manage-users');

    
        return view('admin.users.create-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('manage-users');

        $file_name = null;
        if($request->hasFile('photo')){
            $file_name = $this->storeFile($request->file('photo'),'/uploads/users/');
        }

        User::create([
            'username'=>$request->username,
            'full_name'=>$request->full_name,
            'phone_number'=>$request->phone_number,
            'password'=>Hash::make($request->password),
            'photo'=>$file_name,
            'role'=>$request->role
        ]);

        notify()->success('تم اضافة المستخدم بنجاح','عملية ناجحة');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->authorize('manage-users');

        $user = User::findOrFail($id);

        return view('admin.users.edit-user',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UdateUserRequest $request, $id)
    {
        $this->authorize('manage-users');


        // return $request->file('photo');
        $user = User::findOrFail($id);

        $user->update([
            'username'=>$request->username,
            'phone_number'=>$request->phone_number,
            'full_name'=>$request->full_name,
            'role'=>$request->role
        ]);

        if($request->has('password') && !empty($request->password)){
            $user->update(['password'=>Hash::make($request->password),]);
        }

        if($request->hasFile('photo')){

            // return $request->file('photo');
            $file_name = $this->storeFile($request->file('photo'),'/uploads/users/');

            // old file path
            $this->deleteFile($user->photo);
           
            $user->update(['photo'=>$file_name]);

        }

        notify()->success('تم تحديث بيانات الحساب بنجاح');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('manage-users');

            $user = User::findOrFail($id);
            $this->deleteFile($user->photo);

            $user->delete();

            notify()->success('تم حذف المستخدم بنجاح','عملية ناجحة');

            return redirect()->back();
    }
}
