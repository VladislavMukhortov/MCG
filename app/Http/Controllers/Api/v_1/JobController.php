<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Requests\JobAddExistingEstimateRequest;
use App\Http\Requests\JobFormRequest;
use App\Http\Requests\JobListRequest;
use App\Http\Requests\JobRequest;
use App\Services\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{

    protected $jobService;

    public function __construct (JobService $jobService)
    {
        $this->jobService = $jobService;

    }

    /**
     * Display a listing of the resource.
     * @param JobListRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(JobListRequest $request)
    {
        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.jobs.create.success')
            ],
            'data' => [
                'job' => $this->jobService->index($request->all())
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JobFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(JobFormRequest $request)
    {
        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.jobs.create.success')
            ],
            'data' => [
                'job' => $this->jobService->store($request->all())
            ],
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'job' => $this->jobService->show($id)
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showWithEstimates($id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'job' => $this->jobService->showWithEstimates($id)
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JobRequest $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(JobRequest $request, $id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'job' => $this->jobService->update($request->all(), $id)
            ],
        ]);
    }

    /**
     * Check for Job and Estimate existence then changes Job ID according to the Request
     *
     * @param JobAddExistingEstimateRequest $request
     * @param $id
     * @param $estimateId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addExistingEstimate(JobAddExistingEstimateRequest $request, $id, $estimateId)
    {
        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.jobs.create.success')
            ],
            'data' => [
                'estimate' => $this->jobService->addEstimate($request->all(), $id, $estimateId)
            ],
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'job' => $this->jobService->destroy($id)
            ],
        ]);
    }
}
