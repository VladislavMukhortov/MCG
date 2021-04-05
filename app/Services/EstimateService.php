<?php
namespace App\Services;


use App\Models\EstimateRepository;
use App\Models\EstimateRepositoryLineItems;
use App\Models\EstimateTemplateLineItemsRepository;
use App\Models\Leads;

class EstimateService
{

    protected $estimateModel;

    public function __construct (EstimateRepository $estimateModel)
    {
        $this->estimateModel = $estimateModel;
    }

    /**
     * Store method for Estimate Model
     *
     * @param $request
     * @return mixed
     */
    public function store(array $request)
    {
        $request['created_by'] = auth('api')->user()->id;

        return EstimateRepository::create($request)->id;
    }

    /**
     * Show method for Estimate Model
     *
     * @param $id
     * @param EstimateRepository $estimateModel
     * @return mixed
     */
    public function show($id)
    {
        $estimate = $this->estimateModel->with(['leads','estimateTemplate'])->find($id);

        return $estimate;
    }

    /**
     * Update Estimate by ID
     *
     * @param array $request
     * @param $id
     * @return mixed
     */
    public function update(array $request, $id)
    {
        if (isset($request['cover_photo'])) {

            $request['cover_photo'] = Storage::disk('public')->put('cover photo/', $request['cover_photo']);
        }

        $this->estimateModel->find($id)->update($request);

        return $id;

        /*if ($request['status'] != 1 && !$estimate['date_sent']) {
            $request['date_sent'] = date('Y-m-d H:i:s');
            $userData = UserController::createLeadUser($lead);
           UserController::sendUserPassword($userData['password'], $userData['email']);
        } */

    }

}