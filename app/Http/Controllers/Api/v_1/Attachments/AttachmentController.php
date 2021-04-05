<?php

namespace App\Http\Controllers\Api\v_1\Attachments;

use App\Criteria\LeadCustomCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentFileRequest;
use App\Http\Requests\AttachmentRequest;
use App\Http\Resources\AttachmentResource;
use App\Models\Attachments;
use App\Models\Request;
use App\Services\AttachmentService;
use App\Repositories\AttachmentsRepositoryEloquent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AttachmentController extends Controller
{
    protected $attachments;
    protected $leadController;
    protected $attachmentService;

    public function __construct(AttachmentService $attachmentService, LeadAttachmentController $leadAttachmentController)
    {
        $this->leadController   = $leadAttachmentController;
        $this->attachmentService       = $attachmentService;
    }

    public function index()
    {
 //
    }

    /**
     * Store file in the storage
     *
     * @param AttachmentFileRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AttachmentFileRequest $request)
    {
        $attachment = $this->attachmentService->store($request);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.attachments.create.success'),
            ],
            'data' => [
                'attachment' => $attachment,
            ],
        ], 200);
    }

    /**
     * Store incoming link in the DB with params
     *
     * @param AttachmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLink(AttachmentRequest $request)
    {
        $attachmentId = Attachments::create($request->all())->id;

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.attachments.create.success'),
            ],
            'data' => [
                'attachmentId' => $attachmentId,
            ],
        ], 200);


    }

    /**
     * Show attachment by ID
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
            return response()->json(['success' => true, 'data' => ['attachment' => $this->attachmentService->show($id)]], 200);
    }

    public function update($id, AttachmentRequest $request)
    {
        return response()->json(['success' => true, 'data' => ['attachment' => $this->attachmentService->update($id, $request->all())]], 200);
    }

    /**
     * Remove file from DB and storage
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->attachmentService->destroy($id);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.attachments.delete.success'),
            ],
        ], 200);
    }

    public function attachmentEmail(Request $request)
    {
        $this->attachmentService->sendAttachmentLink($request);

        return response()->json([
            'success' => true,
            'messages' => [
                __('pages.attachments.attachment_email.success'),
            ],
        ], 200);

    }
}
