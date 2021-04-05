<?php

namespace App\Criteria;

use App\Models\Leads;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class LeadCriteria.
 *
 * @package namespace App\Criteria;
 */
class LeadCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $lead   = Leads::whereUserId(\Auth::id())->first();
        $leadId = optional($lead)->id;
        $model  = $model->where('lead_id','=', $leadId)->whereNotNull('lead_id');

        return $model;
    }
}
