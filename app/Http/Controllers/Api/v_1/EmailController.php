<?php

namespace App\Http\Controllers\Api\v_1;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\EmailRequestList;
use App\Services\EmailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    protected $emailService;

    public function __construct (EmailService $emailService)
    {
        $this->emailService = $emailService;

    }

    /**
     * Display a listing of the Email entities
     *
     * @param EmailRequestList $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(EmailRequestList $request)
    {
        return response()->json(['success' => true, 'messages' => [__('pages.email.send.success')], 'data' => ['email' => $this->emailService->index($request->paginate, 200)]], 200);
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
     * Store Email details in DB and send Email using Google API
     *
     * @param EmailRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Google\Exception
     */
    public function store(EmailRequest $request)
    {
        return response()->json(['success' => true, 'messages' => [__('pages.email.send.success')], 'data' => ['email' => $this->emailService->store($request->all())]], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove Email record by ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json(['success' => true, 'messages' => [__('pages.email.destroy.success')], 'data' => ['email' => $this->emailService->destroy($id)]], 200);
    }
}
