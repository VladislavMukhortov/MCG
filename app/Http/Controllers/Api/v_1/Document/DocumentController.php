<?php

namespace App\Http\Controllers\Api\v_1\Document;

use App\Http\Controllers\Controller;
use App\Http\Traits\Authorizable;
use App\Models\Document;
use App\Repositories\DocumentRepositoryEloquent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    use AuthorizesRequests, Authorizable;

    protected $subcontractorController;
    protected $leadController;
    protected $repository;

    public function __construct(SubcontractorDocumentController $subcontractorDocumentController,
                                DocumentRepositoryEloquent  $documentRepository,
                                LeadDocumentController $leadDocumentController)
    {
//        $this->authorizeResource(Document::class, 'document');
        $this->subcontractorController  = $subcontractorDocumentController;
        $this->leadController           = $leadDocumentController;
        $this->repository               = $documentRepository;
    }

    public function index(Request $request)
    {
        if ($request->user()->is_lead) {
            return $this->leadController->index($request);
        }
        if ($request->user()->is_subcontractor) {
            return $this->subcontractorController->index($request);
        }

        return response()->json([
            'success' => false,
        ], 200);
    }
}
