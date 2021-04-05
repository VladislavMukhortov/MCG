<?php

namespace App\Observers;

use App\Models\Activities;
use App\Models\LeadActivities;
use App\Models\Leads;
use Illuminate\Support\Facades\Auth;

class LeadsObserver
{
    /**
     * Handle the Activities "created" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function created(Leads $activities)
    {
        $activitie = new Activities;
        $activitie->description = 'Created lead information';
        $activitie->user = auth('api')->user() ? auth('api')->user()->id : NULL;
        $activitie->lead = $activities->id;
        $activitie->save();

        $leadactivitie = new LeadActivities;
        $leadactivitie->activities_id = $activitie->id;
        $leadactivitie->lead_id = $activities->id;
        $leadactivitie->save();
    }

    /**
     * Handle the Activities "updated" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function updated(Leads $activities)
    {
        $activitie = new Activities;
        $activitie->description = 'Edited lead information';
        $activitie->user = auth('api')->user() ? auth('api')->user()->id : NULL;
        $activitie->lead = $activities->id;
        $activitie->save();

        $leadactivitie = new LeadActivities;
        $leadactivitie->activities_id = $activitie->id;
        $leadactivitie->lead_id = $activities->id;
        $leadactivitie->save();
    }

    /**
     * Handle the Activities "deleted" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function deleted(Leads $activities)
    {
        $activitie = new Activities;
        $activitie->description = 'Deleted lead information';
        $activitie->user = auth('api')->user();
        $activitie->lead = $activities->id;
        $activitie->save();

        $leadactivitie = new LeadActivities;
        $leadactivitie->activities_id = $activitie->id;
        $leadactivitie->lead_id = $activities->id;
        $leadactivitie->save();
    }

    /**
     * Handle the Activities "restored" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function restored(Leads $activities)
    {
        //
    }

    /**
     * Handle the Activities "force deleted" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function forceDeleted(Leads $activities)
    {
        //
    }
}
