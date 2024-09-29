<?php

namespace App\Observers;

use App\Models\SoliderService;
use App\Models\SoliderServiceHistory;
class SoliderServiceObserver
{
    /**
     * Handle the SoliderService "created" event.
     *
     * @param  \App\Models\SoliderService  $soliderService
     * @return void
     */
    public function created(SoliderService $soliderService)
    {
        //
    }

    /**
     * Handle the SoliderService "updated" event.
     *
     * @param  \App\Models\SoliderService  $soliderService
     * @return void
     */
    public function updated(SoliderService $soliderService)
    {
        if($soliderService->isDirty('service_id') || $soliderService->isDirty('service_place_id') || $soliderService->isDirty('shift_id'))
        {
            SoliderServiceHistory::create([
                'solider_id'=>$soliderService->getOriginal('solider_id'),
                'service_id'=>$soliderService->getOriginal('service_id'),
                'service_place_id'=>$soliderService->getOriginal('service_place_id'),
                'degree_id'=>$soliderService->getOriginal('degree_id'),
                'shift_id'=>$soliderService->getOriginal('shift_id'),
                'assign_date'=>$soliderService->getOriginal('service_assign_date'),

            ]);
        }
    }

    /**
     * Handle the SoliderService "deleted" event.
     *
     * @param  \App\Models\SoliderService  $soliderService
     * @return void
     */
    public function deleted(SoliderService $soliderService)
    {
        //
    }

    /**
     * Handle the SoliderService "restored" event.
     *
     * @param  \App\Models\SoliderService  $soliderService
     * @return void
     */
    public function restored(SoliderService $soliderService)
    {
        //
    }

    /**
     * Handle the SoliderService "force deleted" event.
     *
     * @param  \App\Models\SoliderService  $soliderService
     * @return void
     */
    public function forceDeleted(SoliderService $soliderService)
    {
        //
    }
}
