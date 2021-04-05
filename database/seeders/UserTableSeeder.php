<?php

namespace Database\Seeders;

use App\Models\GeneralContractors;
use App\Models\Leads;
use App\Models\SubContractors;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    protected $users = [
        [
            'email'     => 'admin@site.com',
            'roles'     => [User::ROLE_ADMIN],
            'password'  => 'password'
        ],
        [
            'email'     => 'representative@site.com',
            'roles'     => [User::ROLE_REPRESENTATIVE],
            'password'  => 'password'
        ],
        [
            'email'     => 'lead@site.com',
            'roles'     => [User::ROLE_LEAD],
            'password'  => 'password'
        ],
        [
            'email'     => 'manager@site.com',
            'roles'     => [User::ROLE_MANAGER],
            'password'  => 'password'
        ],
        [
            'email'     => 'subcontractor@site.com',
            'roles'     => [User::ROLE_SUBCONTRACTOR],
            'password'  => 'password'
        ],
        [
            'email'     => 'worker@site.com',
            'roles'     => [User::ROLE_WORKER],
            'password'  => 'password'
        ],
        [
            'email'     => 'general_contractor@site.com',
            'roles'     => [User::ROLE_GENERAL_CONTRACTOR],
            'password'  => 'password'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $start = now();
        $this->command->info('Users with Roles Seeder Started...');

        \Bouncer::allow(User::ROLE_ADMIN)->everything();

        $user = User::whereEmail('admin@indiviar.com')->first();

        if (!is_null($user)) \Bouncer::assign(User::ROLE_ADMIN)->to($user);

        foreach ($this->users as $user) {
            $user = collect($user);
            try {
                $eloquentUser = User::factory()->create([
                    'email'     => $user->get('email'),
                    'password'  => Hash::make($user->get('password'))
                ]);
                $this->addRelations($user, $eloquentUser);
            } catch (\Throwable $exception) { dump($exception->getMessage()); }
        }

        $this->command->info('Time completed:   ' . $start->diffForHumans(null, true));
    }

    /**
     * @param Collection $user
     * @param User $eloquentUser
     */
    private function addRelations(Collection $user, User $eloquentUser)
    {
        if (count($roles = collect($user->get('roles')))) {
            $roles->each( function ($role) use ($eloquentUser) {

                \Bouncer::assign($role)->to($eloquentUser);
                $this->delegateCreatingUserRelationByRole($role, $eloquentUser);
            });
        }
    }

    private function delegateCreatingUserRelationByRole($role, User $user)
    {
        switch ($role) {
            case User::ROLE_LEAD:
                return $this->createUserRelatedModel($user, new Leads);
            case User::ROLE_SUBCONTRACTOR:
                return $this->createUserRelatedModel($user, new SubContractors);
            case User::ROLE_GENERAL_CONTRACTOR:
                return $this->createUserRelatedModel($user, new GeneralContractors);
            default:
                return null;
        }
    }

    private function createUserRelatedModel($user, $model)
    {
        $relation = $model::userId($user)->first();
        if (is_null($relation)) {
            return $model::factory()->state(function (array $attributes) use ($user) {
                return ['user_id' => $user->id];
            })->create();
        } else { return $relation; }
    }
}