<?php

namespace App\Http\Controllers\Admin;

use App\Models\SoliderStatus;
use App\Models\Solider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Requests\SoliderStatuses\StoreSoliderStatusRequest;
use App\Http\Requests\SoliderStatuses\UpdateSoliderStatusRequest;


class SoliderStatusController extends Controller
{
    
    public function index()
    {
        $today = Carbon::today()->format('Y-m-d');
        $SoliderStatues = SoliderStatus::with(['solider','updatedBy','createdBy'])
        ->paginate(10);

        // هذا الاستعلام لجب فقط الجنود الموجودين بالقطاع
        $soliders = Solider::whereDoesntHave('soliderStatus')
        ->orWhereHas('soliderStatus',function($query) use ($today){
            $query->where('return_date','=',$today)
            ->orWhere(function($query) use ($today){
                $query->where('go_date','>',$today)
                ->orWhere('return_date','<',$today);
            });
        })->get();

        return view('admin.solider-statues.index',compact('SoliderStatues','soliders'));

    }

   
    public function create()
    {
        //
    }

    public function store(StoreSoliderStatusRequest $request)
    {

       $record =  SoliderStatus::updateOrCreate(['solider_id'=>$request->solider_id],
       $request->validated());


        notify()->success('تم حفظ البيانات بنجاح','عملية ناجحة');

        return redirect()->back();

    }

    
    public function show(SoliderStatus $soliderStatus)
    {
        //
    }

   
    public function edit(SoliderStatus $soliderStatus)
    {
        //
    }

   
    public function update(UpdateSoliderStatusRequest $request,$id)
    {
        $soliderStatus = soliderStatus::findOrFail($id);

        $soliderStatus->update($request->validated());

        notify()->success('تم تحديث البيانات بنجاح','عملية ناجحة');

        return redirect()->back();
    }

    
    public function destroy($id)
    {
        $soliderStatus = soliderStatus::findOrFail($id);

            $soliderStatus->delete();

            notify()->success('تم حذف البيانات بنجاح','عملية ناجحة');

            return redirect()->back();
    }
}
