<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubContractors;
use Illuminate\Http\Request;
use App\Repositories\SubContractorsRepositoryEloquent;


class SubContractorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $repository;

    public function __construct(SubContractorsRepositoryEloquent $repository)
    {
        $this->authorizeResource(SubContractors::class, 'subcontractor');
        $this->repository = $repository;
    }

    public function index()
    {
        $subcontractors = $this->repository->index();
        $vendors = $this->repository->getVendorslist();

        return view('Admin.Subcontractors.Subcontractor.index', compact('subcontractors', 'vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request = $this->repository->store($request->all());
        return redirect()->route('subcontractors.index');
    }

    public function show(SubContractors $subContractor)
    {
        $reads = $this->repository->show($subContractor->id);
        $vendors = $this->repository->getVendorslist();
        $notelist = $this->repository->getNoteslist($subContractor->id);
        $attachmentlist = $this->repository->getAttachmentslist($subContractor->id);
        $contactlist = $this->repository->getContactslist($subContractor->id);

        // dd($vendors);

        return view('Admin.Subcontractors.Subcontractor.view-edit', compact('reads', 'vendors', 'notelist', 'attachmentlist', 'contactlist'));

    }

    public function edit(SubContractors $subContractor)
    {
        //
    }

    public function update(Request $request, SubContractors $subContractor)
    {
        $reads = $this->repository->update($request->all(), $subContractor->id);
        return redirect()->route('subcontractors.show', $subContractor);
    }

    public function destroy(SubContractors $subContractor)
    {
        $reads = $this->repository->delete($subContractor->id);
        return redirect()->route('subcontractors.index');
    }
}
