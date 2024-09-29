<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Solider;
use App\Models\Service;
use App\Models\Degree;
use App\Models\Shift;
use App\Models\ServicePlace;
use App\Models\SoliderServiceHistory;

use App\Models\SoliderService;
 use App\Http\Requests\SoliderServiceRequest;

 use Carbon\Carbon;

class SoliderServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today()->format('Y-m-d');

        $soliders = Solider::whereDoesntHave('soliderStatus')
                ->orWhereHas('soliderStatus',function($query) use ($today){
                    $query->where('return_date','=',$today)
                    ->orWhere(function($query) use ($today){
                        $query->where('go_date','>',$today)
                        ->orWhere('return_date','<',$today);
                    });
                })->get();

        $services = Service::get();
        $places = ServicePlace::get();

        $degrees = Degree::get();
        $shifts = Shift::get();

        $soliderServices = SoliderService::with(['createdBy','updatedBy','service','servicePlace','degree','shift','solider.soliderStatus'])
        ->paginate(10);

        return view('admin.solider-service.index',compact('soliderServices','soliders','services','degrees','shifts','places'));

        
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
    // SoliderServiceRequest
    public function store(SoliderServiceRequest $request)
    {
       
    //   dd($request);

        DB::beginTransaction();
        try{

         
         

            $record = SoliderService::updateOrCreate(['solider_id'=>$request->solider_id],[
                'service_id'=>$request->service_id ,
                'service_place_id'=>$request->service_place_id ,
                'degree_id'=>$request->degree_id ,
                'shift_id'=>$request->shift_id ,
                'service_assign_date'=>Carbon::now()->format('Y-m-d') ,
        
            ]);
    



            notify()->success('تم تحديث البيانات بنجاح','عملية ناجحة');

            DB::commit();
            return redirect()->back();



        }

        catch(\Exception $e){

                DB::rollBack();

                // return $e->getMessage();
                notify()->error('حدث خطاء ما');
                return redirect()->back();

        }


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
        $today = Carbon::today()->format('Y-m-d');

        $soliders = Solider::whereDoesntHave('soliderStatus')
        ->orWhereHas('soliderStatus',function($query) use ($today){
            $query->where('return_date','=',$today)
            ->orWhere(function($query) use ($today){
                $query->where('go_date','>',$today)
                ->orWhere('return_date','<',$today);
            });
        })->get();

        $services = Service::get();
        $places = ServicePlace::get();

        $degrees = Degree::get();
        $shifts = Shift::get();

       $soliderService = SoliderService::findOrFail($id);
        
        return view('admin.solider-service.edit',compact('soliders','services','places','degrees','shifts','soliderService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SoliderServiceRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $soliderService = SoliderService::findOrFail($id);


            $soliderService->delete();

            notify()->success('تم حذف الفرد بنجاح','عملية ناجحة');

            return redirect()->back();
    }
}
