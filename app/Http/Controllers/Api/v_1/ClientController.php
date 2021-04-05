<?php

namespace App\Http\Controllers\Api\v_1;

use Illuminate\Http\Request;
use App\Repositories\ClientRepositoryEloquent;
use App\Repositories\ContactRepositoryEloquent;

class ClientController extends Controller
{

    protected $clientRepository;

    protected $contactRepository;

    public function __construct(ClientRepositoryEloquent $clientRepository, ContactRepositoryEloquent $contactRepository){
        $this->clientRepository=$clientRepository;
        $this->contactRepository=$contactRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_clients=$this->clientRepository->with('contact')->all();

        return response()->json([
            'success' => true,
            'data' => [
                'all_clients' => $all_clients,
            ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_contacts=$this->contactRepository->all();

        return response()->json([
            'success' => true,
            'data' => [
                'all_contacts' => $all_contacts,
            ]
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
