<?php

namespace App\Http\Controllers\Api\v_1\Document;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Repositories\DocumentRepositoryEloquent;
use Illuminate\Http\Request;

class LeadDocumentController extends Controller
{
    protected $documentRepository;

    public function __construct(DocumentRepositoryEloquent $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function index(Request $request)
    {
        $lead       = optional($request->user())->lead;
        $documents  = DocumentResource::collection($this->documentRepository->getLeadDocuments($lead));

        return response()->json([
            'success' => true,
            'data' => [
                'documents' => $documents
            ]
        ], 200);

    }
}
