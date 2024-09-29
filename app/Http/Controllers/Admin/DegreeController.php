<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Degrees\StoreDegreeRequest;
use App\Http\Requests\Degrees\UpdateDegreeRequest;

use App\Models\Degree;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-degrees');
        $degrees = Degree::with(['createdBy','updatedBy'])->get();

        return view('admin.degrees.index',compact('degrees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDegreeRequest $request)
    {

        $this->authorize('create-degree');

        Degree::create($request->validated());

        notify()->success('تم اضافة الدرجة بنجاح','عملية ناجحة');

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDegreeRequest $request, $id)
    {
        $this->authorize('edit-degree');

        $degree = Degree::findOrFail($id);

        $degree->update($request->validated());

        notify()->success('تم تحديث الدرجة بنجاح','عملية ناجحة');

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
        $this->authorize('delete-degree');

        $degree = Degree::findOrFail($id);

            $degree->delete();

            notify()->success('تم حذف الدرجة بنجاح','عملية ناجحة');

            return redirect()->back();
    }
}
