<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Solider;
use App\Models\Service;
use App\Models\Degree;
use App\Models\Shift;
use App\Models\ServicePlace;
use App\Enums\VacctionTypeEnum;
use Carbon\Carbon;
use App\Enums\SoliderStatusEnum;

class HomeController extends Controller
{


    public function index(){

        $soliders = Solider::with(['createdBy','updatedBy','degree','soliderStatus'])
        ->paginate(10);

        $totalSoliders = Solider::count();

        $today = Carbon::today();

        $solidersIsFound = Solider::whereDoesntHave('soliderStatus')
                ->orWhereHas('soliderStatus',function($query) use ($today){
                    $query->where('return_date','=',$today)
                    ->orWhere(function($query) use ($today){
                        $query->where('go_date','>',$today)
                        ->orWhere('return_date','<',$today);
                    });
                })->count();


        $solidersIsNotFound = Solider::whereHas('soliderStatus', function($query) use ($today) {
            $query->where(function($query) use ($today) {
                $query->where('go_date', '<=', $today)
                        ->where(function($query) use ($today) {
                            $query->where('return_date', '>', $today)
                                ->orWhereNull('return_date');
                        });
            });
        })->count();




        $solidersIsHospital = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where('return_date','>', $today);

           })->where('status',SoliderStatusEnum::Hospital);
        })
        ->count();


        $Absence = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where(function($query) use ($today) {
                    $query->where('return_date', '>', $today)
                        ->orWhereNull('return_date');
                });

           })->where('status',SoliderStatusEnum::Absence);
        })
        ->count();

        $Fleeing = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where(function($query) use ($today) {
                    $query->where('return_date', '>', $today)
                        ->orWhereNull('return_date');
                });

           })->where('status',SoliderStatusEnum::Fleeing);
        })
        ->count();


        $Prison = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where('return_date','>', $today);

           })->where('status',SoliderStatusEnum::Prison);
        })
        ->count();


        $CentralPrison = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where('return_date','>', $today);

           })->where('status',SoliderStatusEnum::CentralPrison);
        })
        ->count();


        $Mission = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where('return_date','>', $today);

           })->where('status',SoliderStatusEnum::Mission);
        })
        ->count();

        $OriginalVacation = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where('return_date','>', $today);

           })->where('status',SoliderStatusEnum::OriginalVacation);
        })
        ->count();

        $IndividualVacation = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where('return_date','>', $today);

           })->where('status',SoliderStatusEnum::IndividualVacation);
        })
        ->count();

        $ExceptionVacation = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where('return_date','>', $today);

           })->where('status',SoliderStatusEnum::ExceptionVacation);
        })
        ->count();

        $IllnessVacation = Solider::whereHas('soliderStatus',function($query) use ($today){
            $query->where(function($query) use ($today){
                $query->where('go_date','<=',$today)
                ->where('return_date','>', $today);

           })->where('status',SoliderStatusEnum::IllnessVacation);
        })
        ->count();


        $solidersDosntHaveService = Solider::whereDoesntHave('soliderService')
        ->count();





        $degrees = Degree::get();


        return view('admin.home',compact(
            'soliders',
            'degrees',
            'totalSoliders',
        'solidersIsFound',
        'solidersIsNotFound',
        'solidersIsHospital',
        'Absence',
        'Fleeing',
        'Prison',
        'CentralPrison',
        'Mission',
        'OriginalVacation',
        'IndividualVacation',
        'ExceptionVacation',
        'IllnessVacation',
        'solidersDosntHaveService'
    ));
    }



    public function getSolidersByStatus($status){

        $today = Carbon::today();

        if($status == 'total'){
            $soliders = Solider::with(['createdBy','updatedBy','degree','soliderStatus'])
                ->paginate(10);

        }elseif($status == SoliderStatusEnum::Absence || $status == SoliderStatusEnum::Fleeing){
            $soliders = Solider::with(['createdBy','updatedBy','degree','soliderStatus'])
            ->whereHas('soliderStatus',function($query) use ($today){
                $query->where(function($query) use ($today){
                    $query->where('go_date','<=',$today)
                    ->where(function($query) use ($today) {
                        $query->where('return_date', '>', $today)
                            ->orWhereNull('return_date');
                    });
    
               })->where('status',SoliderStatusEnum::Absence);
            })
            ->paginate(10);



        }elseif($status == 'notfound'){

            $soliders = Solider::with(['createdBy','updatedBy','degree','soliderStatus'])
            ->whereHas('soliderStatus', function($query) use ($today) {
                $query->where(function($query) use ($today) {
                    $query->where('go_date', '<=', $today)
                            ->where(function($query) use ($today) {
                                $query->where('return_date', '>', $today)
                                    ->orWhereNull('return_date');
                            });
                });
            })->paginate(10);

        }elseif($status == 'found'){
            $soliders = Solider::with(['createdBy','updatedBy','degree','soliderStatus'])
            ->whereDoesntHave('soliderStatus')
            ->orWhereHas('soliderStatus',function($query) use ($today){
                $query->where('return_date','=',$today)
                ->orWhere(function($query) use ($today){
                    $query->where('go_date','>',$today)
                    ->orWhere('return_date','<',$today);
                });
            })->paginate(10);

        }elseif($status == 'noservices'){

            $soliders = Solider::with(['createdBy','updatedBy','degree','soliderStatus'])
            ->whereDoesntHave('soliderService')
            ->paginate(10);


        }else{
            $soliders = Solider::with(['createdBy','updatedBy','degree','soliderStatus'])
            ->whereHas('soliderStatus',function($query) use ($today, $status){
                $query->where(function($query) use ($today){
                    $query->where('go_date','<=',$today)
                    ->where('return_date','>', $today);
    
               })->where('status',$status);
            })
            ->paginate(10);
        }




        return view('admin.reports.get-soliders-by-status',compact('soliders','status'));

    }


}
