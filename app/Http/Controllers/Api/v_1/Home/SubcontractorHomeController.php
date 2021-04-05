<?php

namespace App\Http\Controllers\Api\v_1\Home;

use App\Http\Controllers\Controller;
use App\Models\SubContractors;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class SubcontractorHomeController extends Controller
{
    use AuthorizesRequests;

    protected $repository;

    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => [
                'subcontractor' => $user->subcontractor->load('pendingDocuments', 'user'),
            ],
        ], 200);
    }
}
