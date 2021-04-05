<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\ProjectRepository;
use App\Models\Project;
use App\Validators\ProjectValidator;

/**
 * Class ProjectRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    protected $fieldSearchable = ['name' => 'like',];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function storePayment(Project $project, Collection $data)
    {
        return $project->payments()->create($data->toArray());
    }

    public function storePayout(Project $project, Collection $data)
    {

        return $project->payouts()->create($data->toArray());
    }

    public function storePayoutEdit(Project $project, Collection $data, $id)
    {


        return $project->payouts()->updateOrCreate(
            ['id' => $id],
            ['amount' => $data['amount'],
             'date' => $data['date'],
              'status_id' => $data['status_id'],
                'subcontractor_id' => $data['subcontractor_id']
            ]
        );
    }

    public function storePaymentEdit(Project $project, Collection $data, $id)
    {

        return $project->payments()->updateOrCreate(
            ['id' => $id],
            ['amount' => $data['amount'],
                'status_id' => $data['status_id'],
                'due_date' => $data['due_date']
            ]
        );
    }

    public function storePaymentDelete(Project $project, $id){

        $payment = $project->payments()->find($id);

        return $payment->delete();
    }

}
