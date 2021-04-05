<?php

namespace App\Criteria;

use App\Models\Leads;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class LeadCustomCriteria.
 *
 * @package namespace App\Criteria;
 */
class LeadCustomCriteria implements CriteriaInterface
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
        $model  = $model->where('lead','=', $leadId)->whereNotNull('lead');

        return $model;
    }
}
