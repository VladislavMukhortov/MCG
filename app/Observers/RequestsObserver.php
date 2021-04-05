<?php

namespace App\Observers;

use App\Models\Activities;
use App\Models\Request;
use App\Models\RequestActivities;
use App\Models\RequestNotes;
use Illuminate\Support\Facades\Auth;


class RequestsObserver
{
    /**
     * Handle the Activities "created" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */

    public function created(Request $activities)
    {
        $activitie = new Activities;
        $activitie->description = 'Created request information';
        $activitie->user = auth('api')->user() ? auth('api')->user()->id : NULL;
        $activitie->request = $activities->id;
        $activitie->save();

        $reqactivitie = new RequestActivities;
        $reqactivitie->activities_id = $activitie->id;
        $reqactivitie->save();

    }

    /**
     * Handle the Activities "updated" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function updated(Request $activities)
    {
        $activitie = new Activities;
        $activitie->description = 'Edited request information';
        $activitie->user = auth('api')->user() ? auth('api')->user()->id : NULL;
        $activitie->request = $activities->id;
        $activitie->save();

        $reqactivitie = new RequestActivities;
        $reqactivitie->activities_id = $activitie->id;
        $reqactivitie->save();
    }

    /**
     * Handle the Activities "deleted" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function deleted(Request $activities)
    {
        $activitie = new Activities;
        $activitie->description = 'Deleted request information';
        $activitie->user = auth('api')->user()->id;
        $activitie->request = $activities->id;
        $activitie->save();

        $reqactivitie = new RequestActivities;
        $reqactivitie->activities_id = $activitie->id;
        $reqactivitie->save();
    }

    /**
     * Handle the Activities "restored" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function restored(Request $activities)
    {
        //
    }

    /**
     * Handle the Activities "force deleted" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function forceDeleted(Request $activities)
    {
        //
    }
}
