<?php

namespace App\Observers;

use App\Models\Activities;
use App\Models\EstimateActivities;
use App\Models\EstimateRepository;
use Illuminate\Support\Facades\Auth;

class EstimateObserver
{
    /**
     * Handle the Activities "created" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function created(EstimateRepository $activities)
    {
        $activitie = new Activities;
        $activitie->description = 'Created estimate information';
        $activitie->user = auth('api')->user()->id;
        $activitie->estimate = $activities->id;
        $activitie->save();

        $estactivitie = new EstimateActivities;
        $estactivitie->activities_id = $activitie->id;
        $estactivitie->estimate_id = $activities->id;
        $estactivitie->save();
    }

    /**
     * Handle the Activities "updated" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function updated(EstimateRepository $activities)
    { 
        $activitie = new Activities;
        $activitie->description = 'Edited estimate information';
        $activitie->user = auth('api')->user()->id;
        $activitie->estimate = $activities->id;
        $activitie->save();

        $estactivitie = new EstimateActivities;
        $estactivitie->activities_id = $activitie->id;
        $estactivitie->estimate_id = $activities->id;
        $estactivitie->save();
        
    }

    /**
     * Handle the Activities "deleted" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function deleted(EstimateRepository $activities)
    {
        $activitie = new Activities;
        $activitie->description = 'Deleted estimate information';
        $activitie->user = Auth::id();
        $activitie->estimate = $activities->id;
        $activitie->save();

        $estactivitie = new EstimateActivities;
        $estactivitie->activities_id = $activitie->id;
        $estactivitie->estimate_id = $activities->id;
        $estactivitie->save();
    }

    /**
     * Handle the Activities "restored" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function restored(EstimateRepository $activities)
    {
        //
    }

    /**
     * Handle the Activities "force deleted" event.
     *
     * @param  \App\Models\Activities  $activities
     * @return void
     */
    public function forceDeleted(EstimateRepository $activities)
    {
        //
    }
}
