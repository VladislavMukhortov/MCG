<?php

namespace App\Repositories;

use App\Contracts\GeneralContractorsRepository;
use App\Models\GeneralContractors;
use App\Models\User;
use App\Validators\GeneralContractorsValidator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;


/**
 * Class GeneralContractorsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GeneralContractorsRepositoryEloquent extends BaseRepository implements GeneralContractorsRepository
{
    public function model()
    {
        return GeneralContractors::class;
    }

    public function index()
    {
        return User::generalContractors()->get();
    }

    public function store(Collection $data) //todo refactor legacy
    {
        $user = User::create([
            'name'  => \Str::of($data->get('first'))->when($data->get('last'), function ($string) use ($data) {
                return $string->append(' ' . $data->get('last'));
            })->__toString(),
            'email'         => $data->get('email'),
            'password'      => Hash::make($data->get('password')),
            'user_status'   => true,
        ]);

        $address = $this->getAddressArray($data->only(['address', 'street_address', 'state', 'city', 'zip']));

        $user->generalContractor()->create([
            'website'   => $data->get('website'),
            'phone'     => $data->get('phone'),
            'address'   => $address,

        ]);

        \Bouncer::assign(User::ROLE_GENERAL_CONTRACTOR)->to($user);
    }

    public function show($id)
    {
        return User::has('generalContractor')->find($id);
    }

    public function updateWithUser(GeneralContractors $generalContractor, Collection $data)
    {
        if ($data->get('password')) {
            $generalContractor->user()->update(['password' => Hash::make($data->get('password'))]);
        }
        if($data->has('first') || $data->has('last')) {
            $generalContractor->user()->update([
                'name' => \Str::of($data->get('first'))->when($data->get('last'), function ($string) use ($data) {
                    return $string->append(' ' . $data->get('last'));
                })->__toString(),
            ]);
        }
        if( $data->has('address')) {
            $address = $this->getAddressArray($data->only(['address', 'street_address', 'state', 'city', 'zip']));
            $generalContractor->update(['address' => $address]);
        }

        if ($data->has('phone')) {
            $generalContractor->update(['address' => $data->get('phone')]);
        }

        if ($data->has('website')) {
            $generalContractor->update(['address' => $data->get('website')]);
        }

    }

    public function deleteGeneralContractor(GeneralContractors $generalContractor, bool $withUser = false)
    {
        return collect([
            'generalContractor' => $generalContractor->delete(),
            'user' => $withUser ? $generalContractor->user->delete() : false,
        ]);
    }

    /**
     * @param Collection $data
     * @return array
     */
    protected function getAddressArray(Collection $data): array
    {
        return [
            'location'  => $data->get('address'),
            'street'    => $data->get('street_address'),
            'state'     => $data->get('state'),
            'city'      => $data->get('city'),
            'zip'       => $data->get('zip'),
        ];
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
