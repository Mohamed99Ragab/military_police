<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Http\Requests\Soliders\StoreSoliderRequest;
use App\Http\Requests\Soliders\UpdateSoliderRequest;

use App\Models\Solider;
use App\Models\Service;
use App\Models\Degree;
use App\Models\Shift;
use App\Models\ServicePlace;
use App\Traits\FileManagement;
use App\Models\SoliderServiceHistory;
use App\Models\SoliderService;



use Carbon\Carbon;


class SoliderController extends Controller
{

    use FileManagement;


    public function index()
    {

        $this->authorize('view-soliders');

        // return 'ok';
        $soliders = Solider::with(['createdBy','updatedBy','degree','soliderStatus'])
            ->orderBy('full_name')
            ->paginate(10);
        $degrees = Degree::get();


        return view('admin.soliders.index-list',compact('soliders','degrees'));
    }


    public function create()
    {
        $this->authorize('create-solider');

        $services = Service::get();
        $places = ServicePlace::get();

        $shifts = Shift::get();
        $degrees = Degree::get();

        return view('admin.soliders.create-solider',compact('degrees','services','places','shifts'));

    }


    public function store(StoreSoliderRequest $request)
    {

        // return $request;
        $this->authorize('create-solider');

        DB::beginTransaction();
        try{

            $data = $request->except(['service_id','service_place_id','shift_id']);
            $solider = Solider::create($data);
            // return $solider;

            if($request->service_id && $request->service_place_id && $request->shift_id){
                 SoliderService::create([
                    'solider_id'=>$solider->id,
                    'degree_id'=>$solider->degree_id ,
                    'service_id'=>$request->service_id ,
                    'service_place_id'=>$request->service_place_id ,
                    'shift_id'=>$request->shift_id ,
                    'service_assign_date'=>Carbon::now()->format('Y-m-d') ,
                ]);
            }

            if($request->hasFile('photo')){

                // return $request->file('photo');
                $file_name = $this->storeFile($request->file('photo'),'/uploads/soliders/');

                $solider->update(['photo'=>$file_name]);

            }

            DB::commit();
            notify()->success('تم اضافة البيانات بنجاح','عملية ناجحة');

            return redirect()->back();



        }

        catch(\Exception $e){

            DB::rollBack();
            return $e->getMessage();
            notify()->error('حدث خطاء ما');
            return redirect()->back();

    }





    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $this->authorize('edit-solider');

        $solider = Solider::findOrFail($id);

        $degrees = Degree::get();
        $services = Service::get();
        $places = ServicePlace::get();
        $shifts = Shift::get();

        return view('admin.soliders.edit-solider',compact('solider','degrees','services','places','shifts'));
    }


    public function update(UpdateSoliderRequest $request, $id)
    {
        $this->authorize('edit-solider');

        // return $request;
        $solider = Solider::findOrFail($id);

        DB::beginTransaction();
        try{



            $solider->update([
                'full_name'=>$request->full_name,
                'military_number'=>$request->military_number,
                'phone_number'=>$request->phone_number,
                'address'=>$request->address,
                'degree_id'=>$request->degree_id

            ]);

            SoliderService::updateOrCreate(['solider_id'=>$id],[
                'degree_id'=>$solider->degree_id ,
                'service_id'=>$request->service_id ,
                'service_place_id'=>$request->service_place_id ,
                'shift_id'=>$request->shift_id ,
                'service_assign_date'=>Carbon::now()->format('Y-m-d') ,
            ]);



            if($request->hasFile('photo')){

                $file_name = $this->storeFile($request->file('photo'),'/uploads/soliders/');

                // old file path
                $this->deleteFile($solider->photo);

                $solider->update(['photo'=>$file_name]);

            }


            notify()->success('تم تحديث البيانات بنجاح','عملية ناجحة');

            DB::commit();
            return redirect()->back();



        }

        catch(\Exception $e){

                DB::rollBack();

                return $e->getMessage();
                notify()->error('حدث خطاء ما');
                return redirect()->back();

        }

    }


    public function destroy($id)
    {
        $this->authorize('delete-solider');

        $solider = Solider::findOrFail($id);

        $this->deleteFile($solider->photo);

            $solider->delete();

            notify()->success('تم حذف الفرد بنجاح','عملية ناجحة');

            return redirect()->back();
    }



    public function bulkDelete(Request $request)
    {
        $request->validate([
            'soliders' => 'required|array',
            'soliders.*' => 'exists:soliders,id',
        ], [
            'soliders.required' => 'يرجى تحديد الجنود الذين ترغب في حذفهم.',
            'soliders.array' => 'قائمة الجنود المحددة غير صالحة.',
            'soliders.*.exists' => 'أحد الجنود المحددين غير موجود في النظام.',
        ]);

        Solider::destroy($request->input('soliders'));

        notify()->success('تمت عملية الحذف بنجاح','عملية ناجحة');

        return redirect()->back();
    }



}
