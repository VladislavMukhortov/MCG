<?php

namespace App\Http\Controllers\Attachments;

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
        $this->authorize('viewAny', new Attachments());

        $attachments = $this->attachmentRepository->getLeadOwnAttachment($request->user());
        return view('attachments.leads.index', compact('attachments'));
    }
}
