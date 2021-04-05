<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait Roleable
{
    public function getRoleNamesAttribute()
    {
        return $this->getRoles();
    }

    public function getRoleNameAttribute()
    {
        return $this->getRoles()->implode(', ');
    }

    public function getIsAdminAttribute()
    {
        return $this->isA(self::ROLE_ADMIN);
    }

    public function getIsManagerAttribute()
    {
        return $this->isA(self::ROLE_MANAGER);
    }

    public function getIsLeadAttribute()
    {
        return $this->isA(self::ROLE_LEAD) && $this->lead()->exists();
    }

    public function getIsSubcontractorAttribute()
    {
        return $this->isA(self::ROLE_SUBCONTRACTOR) && $this->subcontractor()->exists();
    }

    public function getIsGeneralContractorAttribute()
    {
        return $this->isA(self::ROLE_SUBCONTRACTOR) && $this->generalContractor()->exists();
    }

    public function getIsRepresentativeAttribute()
    {
        return $this->isA(self::ROLE_REPRESENTATIVE);
    }


    public function scopeGeneralContractors(Builder $query)
    {
        return $query->has('generalContractor')->whereIs(User::ROLE_GENERAL_CONTRACTOR);
    }
}