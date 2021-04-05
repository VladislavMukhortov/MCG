<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Repositories\RoomRepositoryEloquent;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    protected $room;

    public function __construct (RoomRepositoryEloquent $room)
    {
        $this->room = $room;
    }

    /**
     * Update room details
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update (Request $request)
    {


        $this->room->update($request, $request->id);

        return redirect()->back();
    }

}
