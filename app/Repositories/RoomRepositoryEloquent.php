<?php

namespace App\Repositories;

use App\Models\Request;
use App\Models\Room;
use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\RoomRepositoryRepository;
use App\Models\RoomRepository;
use App\Validators\RoomRepositoryValidator;

/**
 * Class RoomRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoomRepositoryEloquent extends BaseRepository implements RoomRepositoryRepository
{

    protected $request;
    protected $room;
    protected $attachments;

    public function __construct (Request $request, Room $room,  AttachmentsRepositoryEloquent $attachments)
    {
        $this->request = $request;
        $this->room = $room;
        $this->attachments = $attachments;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomRepository::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
