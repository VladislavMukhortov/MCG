<?php

namespace App\Http\Controllers\Home;

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
        $this->authorize('viewHome', new SubContractors);
        $user               = $request->user();
        $subcontractor      = $user->subcontractor;
        $subcontractor->load('pendingDocuments', 'user');

        return view('Users.subcontractors.home', compact('subcontractor'));
    }
}
