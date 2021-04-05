<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Requests\InitialFormRequest;
use App\Models\Leads;
use App\Services\InitialFormService;
use Illuminate\Http\Request;

class InitialFormController extends Controller
{

    protected $initialFormService;

    public function __construct (InitialFormService $initialFormService)
    {
        $this->initialFormService = $initialFormService;
    }

    public function index ()
    {
//
    }

    public function create()
    {
        //
    }

    /**
     * Store new lead with request and room(s) inside the request
     *
     * @param InitialFormRequest $request
     * @param InitialFormService $initialFormService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store (InitialFormRequest $request)
    {
        $this->initialFormService->store($request);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.initial_request.store.success')
            ],
        ], 200);

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    /**
     * Email validation on fly
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateEmail (Request $request)
    {
        $val = $this->initialFormService->validateEmail($request->email);

        if ($val != NULL) {
            return response()->json(['success' => true, 'messages' => [__('pages.initial_request.email.success')],], 200);
        }
        return response()->json(['success' => true, 'messages' => [__('pages.initial_request.email.fail')],], 200);
    }

}
