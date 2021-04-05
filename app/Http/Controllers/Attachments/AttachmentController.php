<?php

namespace App\Http\Controllers\Attachments;

use App\Criteria\LeadCustomCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentRequest;
use App\Http\Resources\AttachmentResource;
use App\Models\Attachments;
use Illuminate\Http\Request;
use App\Repositories\AttachmentsRepositoryEloquent;

class AttachmentController extends Controller
{
    protected $leadController;
    protected $repository;

    public function __construct(AttachmentsRepositoryEloquent $repository, LeadAttachmentController $leadAttachmentController)
    {
        $this->authorizeResource(Attachments::class, 'attachment');
        $this->leadController   = $leadAttachmentController;
        $this->repository       = $repository;
    }

    public function index(Request $request)
    {
        //todo policy
        if($request->user()->is_lead) {
            return  $this->leadController->index($request);
        } else {
            return abort(403);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attachment = $this->repository->store($request->all());
//        return redirect()->back();
    }

    public function storeJson(AttachmentRequest $request)
    {
        //$this->authorize();// todo
        $attachment = $this->repository->store($request->validated());

        return AttachmentResource::make($attachment);
    }

    public function show(Attachments $attachment)
    {
        //
    }

    public function edit(Attachments $attachment)
    {
        //
    }

    public function update(Request $request, Attachments $attachment)
    {
        //
    }

    public function destroy(Attachments $attachment)
    {
        $this->repository->delete($attachment->id);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param AttachmentsRepositoryEloquent $attachment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attachmentEmail(Request $request, AttachmentsRepositoryEloquent $attachment)
    {

        $attachment->sendAttachmentLink($request);

        return redirect()->back()->with('email-success', 'Message sent.');

    }
}
