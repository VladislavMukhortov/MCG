<?php

namespace App\Http\Controllers\Api\v_1\Attachments;

use App\Http\Controllers\Controller;
use App\Models\Attachments;
use App\Repositories\AttachmentsRepositoryEloquent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class LeadAttachmentController extends Controller
{
    use AuthorizesRequests;

    protected $attachmentRepository;

    public function __construct(AttachmentsRepositoryEloquent $repository)
    {
        $this->attachmentRepository = $repository;
    }

    public function index(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'attachments' => $this->attachmentRepository->getLeadOwnAttachment($request->user()),
            ],
        ], 200);
    }
}
