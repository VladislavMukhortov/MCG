<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralContractors;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\GeneralContractorsRepositoryEloquent;


class GeneralContractorsController extends Controller
{
    protected $repository;

    public function __construct(GeneralContractorsRepositoryEloquent $repository)
    {
        $this->authorizeResource(GeneralContractors::class, 'general_contractor');
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAny', new GeneralContractors);

        $generals = $this->repository->index();

        return view('Admin.General-Contractor.index', compact('generals'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request) //todo GeneralContractorStoreRequest
    {
        $admins = $this->repository->store(collect($request->all()));
        return redirect()->route('general-contractors.index');

    }

    /**
     * @param GeneralContractors $generalContractor
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(GeneralContractors $generalContractor)
    {
        $this->authorize('view', $generalContractor);

        return view('Admin.General-Contractor.view-edit', compact('generalContractor'));
    }

    public function edit(GeneralContractors $generalContractor)
    {
        //
    }

    public function update(Request $request, GeneralContractors $generalContractor) //todo GeneralContractorUpdateRequest
    {
        $this->authorize('update', $generalContractor);

        $this->repository->updateWithUser($generalContractor, collect($request->all()));
        $generalContractor->refresh();

        return redirect()->route('general-contractors.show', $generalContractor);
    }

    public function destroy(GeneralContractors $generalContractor)
    {
        $this->authorize('delete', $generalContractor);

        $this->repository->deleteGeneralContractor($generalContractor);

        return redirect()->route('general-contractors.index');
    }
}
