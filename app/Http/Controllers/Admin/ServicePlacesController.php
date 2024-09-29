<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServicePlaces\StoreServicePlaceRequest;
use App\Http\Requests\ServicePlaces\UpdateServicePlaceRequest;

use App\Models\ServicePlace;
use App\Models\Service;

class ServicePlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view-service-places');

        $places = ServicePlace::with(['createdBy','updatedBy','service'])->get();
        $services = Service::get();

        return view('admin.places.index',compact('places','services'));
    }


    public function getPlacesByServiceId($serviceId){
        
        $places = ServicePlace::where('service_id',$serviceId)->pluck('name', 'id');;

        return  response()->json($places, 200);

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
    public function store(StoreServicePlaceRequest $request)
    {
        $this->authorize('create-service-place');

        ServicePlace::create($request->validated());

        notify()->success('تم اضافة مكان الخدمة بنجاح','عملية ناجحة');

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
    public function update(UpdateServicePlaceRequest $request, $id)
    {
        $this->authorize('edit-service-place');

        $service = ServicePlace::findOrFail($id);

        $service->update($request->validated());

        notify()->success('تم تحديث مكان الخدمة بنجاح','عملية ناجحة');

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

        $this->authorize('delete-service-place');

        $service = ServicePlace::findOrFail($id);

            $service->delete();

            notify()->success('تم حذف مكان الخدمة بنجاح','عملية ناجحة');

            return redirect()->back();
    }
}
