<?php

namespace App\Observers;

use App\Models\SoliderStatus;
use App\Models\SoliderStatusHistory;


class SoliderStatusObserver
{
    /**
     * Handle the SoliderStatus "created" event.
     *
     * @param  \App\Models\SoliderStatus  $soliderStatus
     * @return void
     */
    public function created(SoliderStatus $soliderStatus)
    {
        //
    }

    /**
     * Handle the SoliderStatus "updated" event.
     *
     * @param  \App\Models\SoliderStatus  $soliderStatus
     * @return void
     */
    public function updated(SoliderStatus $soliderStatus)
    {
        if($soliderStatus->isDirty('status') || $soliderStatus->isDirty('go_date') || $soliderStatus->isDirty('return_date'))
        {
            SoliderStatusHistory::create([
                'solider_id'=>$soliderStatus->getOriginal('solider_id'),
                'go_date'=>$soliderStatus->getOriginal('go_date'),
                'return_date'=>$soliderStatus->getOriginal('return_date'),
                'note'=>$soliderStatus->getOriginal('note'),
                'status'=>$soliderStatus->getOriginal('status'),
            ]);
        }
    }

    /**
     * Handle the SoliderStatus "deleted" event.
     *
     * @param  \App\Models\SoliderStatus  $soliderStatus
     * @return void
     */
    public function deleted(SoliderStatus $soliderStatus)
    {
        //
    }

    /**
     * Handle the SoliderStatus "restored" event.
     *
     * @param  \App\Models\SoliderStatus  $soliderStatus
     * @return void
     */
    public function restored(SoliderStatus $soliderStatus)
    {
        //
    }

    /**
     * Handle the SoliderStatus "force deleted" event.
     *
     * @param  \App\Models\SoliderStatus  $soliderStatus
     * @return void
     */
    public function forceDeleted(SoliderStatus $soliderStatus)
    {
        //
    }
}
