<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\RepresentativesRepository;
use App\Validators\UsersValidator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


/**
 * Class RepresentativesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RepresentativesRepositoryEloquent extends BaseRepository implements RepresentativesRepository
{
    protected $userRepository;
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $User;

    public function __construct(User $User, UserRepositoryEloquent $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->User = $User;
    }


    public function model()
    {
        return User::class;
    }

    public function index()
    {
        return $this->userRepository->getAllByRole(User::ROLE_REPRESENTATIVE);
    }

    public function store($data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $account = $this->User->create($data);
    }

    public function show($id)
    {
        return $this->User->find($id);
    }

    public function update($data, $id)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->User->find($id)->update($data);
    }

    public function delete($id)
    {
        $reads = $this->User->find($id)->delete();
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
