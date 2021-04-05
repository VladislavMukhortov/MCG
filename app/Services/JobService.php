<?php

namespace App\Services;


use App\Models\EstimateRepository;
use App\Models\Job;
use App\Models\Request;

class JobService
{
    protected $job;
    protected $requestModel;
    protected $estimate;

    public function __construct (Job $job, Request $requestModel, EstimateRepository $estimate)
    {
        $this->job = $job;
        $this->requestModel = $requestModel;
        $this->estimate = $estimate;

    }

    /**
     * List all Jobs with Estimates
     *
     * @param array $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(array $request)
    {
        return $this->job->where(['deleted' => NULL])->with('estimates')->paginate($request['filter']);

    }

    /**
     * Create from Lead a Job with Requests as Estimates and Rooms as CsiLineItems
     *
     * @param array $request
     * @return
     */
    public function store(array $request)
    {

        if ($this->requestModel->findOrFail($request['request_id'])) {

            $jobId = $this->job->create($request)->id;

            $requests = $this->requestModel->with('Room')->find($request['request_id']);

            foreach ($requests->all() as $r) {

                $prepRequest = ['lead_id' => $r['lead'], 'job_id' => $jobId, 'job_name' => $r['request_information'], 'created_by' => auth('api')->user()->id,];

                $estimateId = $this->job->estimates()->insertGetId($prepRequest);

                foreach ($requests->pluck('Room')->toArray() as $rooms) {
                    foreach ($rooms as $room) {

                        $prepRoom = ['folder' => $room['stage_room'], 'csi_codes' => [$room['ceiling'], $room['walls'], $room['wall_partition'], $room['floor'], $room['baseboard'], $room['crown_molding'], $room['interior_door'], $room['closest_door'], $room['closest_organization'], $room['window'], $room['light_fixture'], $room['recessed_light'], $room['wall_fixture'], $room['ceiling_fixture'], $room['bathroom_current'], $room['bathroom_replace']]];

                        EstimateLineItemService::createLineItem($prepRoom, $estimateId);
                    }
                }
            }

            return $jobId;

        }
    }

    /**
     * Show Jobs with Estimates and LineItems
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function show(int $id)
    {
        return $this->job->where(['deleted' => NULL])->findOrFail($id);
    }

    /**
     * Show Jobs with Estimates
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function showWithEstimates(int $id)
    {
       return $this->job->where(['deleted' => NULL])->with('estimates')->findOrFail($id);
    }

    /**
     * Update Job details
     *
     * @param $request
     * @param int $id
     * @return int
     */
    public function update($request, int $id)
    {
        $this->job->findOrFail($id)->update($request);

        return $id;
    }

    /**
     * Add existing estimate to the Job
     *
     * @param array $request
     * @param int $id
     * @param int $estimateId
     * @return int
     */
    public function addEstimate(array $request, int $id, int $estimateId)
    {
        if ($this->job->findOrFail($id) && $this->estimate->findOrFail($estimateId))
        {
           $this->estimate->find($estimateId)->update(['job_id' => $request['job_id']]);

           return $id;
        }
    }

    /**
     * Make Job invisible
     *
     * @param int $id
     * @return int
     */
    public function destroy(int $id)
    {
        $this->job->findOrFail($id)->update(['deleted' => 1]);

        return $id;

    }

}