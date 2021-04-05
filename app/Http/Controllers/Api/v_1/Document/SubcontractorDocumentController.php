<?php

namespace App\Http\Controllers\Api\v_1\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubcontractorDocumentController extends Controller
{
    //

    public function index(Request $request)
    {
        return response()->json([
            'success' => false,
        ], 200);
    }
}
