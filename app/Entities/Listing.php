<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Listing.
 *
 * @package namespace App\Entities;
 */
class Listing extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'address',
        'street',
        'city',
        'state',
        'zip',
        'home_owner_id',
        'cleaning_fee',
        'pool_heating_fee',
        'avg_daily_rent',
        'deposit',
        'early_checkin_fee',
        'late_checkout_fee',
        'listing_complete',
        'inspection_id',
        'registration_number',
        'description',
        'brochure',
        'house_manual',
        'check_in_instructions',
        'inventory',
        'highlights'
    ];


    public function getFullAddressAttribute(){
        return $this->street. " ". $this->city.", ".$this->state." ". $this->zip;
    }

}
