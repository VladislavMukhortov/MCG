<?php

namespace App\Services;

use Carbon\Carbon;

class BossTimer
{
    /** @var Carbon */
    protected $start;

    /**
     * @return \Illuminate\Support\Carbon
     */
    public function take()
    {
        return $this->start = now();
    }

    /**
     * @return string
     */
    public function difference()
    {
        return $this->start->diffForHumans(null, true);
    }

    /**
     * @return Carbon
     */
    public function carbon()
    {
        return $this->start->copy();
    }
}