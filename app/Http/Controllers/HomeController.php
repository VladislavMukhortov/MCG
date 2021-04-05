<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Home\SubcontractorHomeController;
use App\Http\Traits\Authorizable;
use App\Repositories\RequestRepositoryEloquent;
use App\Repositories\TaskRepositoryEloquent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    use Authorizable, AuthorizesRequests;

    protected $subcontractorController;
    protected $taskRepository;
    protected $repository;

    
    public function __construct(RequestRepositoryEloquent $repository ,TaskRepositoryEloquent $taskRepository,
                                SubcontractorHomeController $subcontractorHomeController)
    {
        $this->subcontractorController  = $subcontractorHomeController;
        $this->taskRepository           = $taskRepository;
        $this->repository               = $repository;
    }

    public function index(Request $request)
    {
        if (optional($request->user())->is_admin || optional($request->user())->is_manager) { //todo change in future
            $requestslist = $this->repository->getRequestslist();
            $contactslist = $this->repository->getContactslist();
            $all_task = $this->taskRepository->all();

            return view('Admin.dashboard',compact('requestslist','contactslist','all_task'));
        }
        elseif ($request->user()->is_subcontractor) {
            return $this->subcontractorController->index($request);
        } else {
            return view('welcome');
        }
    }
}
