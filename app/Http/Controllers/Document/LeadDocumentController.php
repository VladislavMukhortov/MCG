<?php

namespace App\Http\Controllers\Document;

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

        return view('documents.leads.index', [
            'documents' => $documents,
        ]);
    }
}
