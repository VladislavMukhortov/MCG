<?php

namespace Database\Factories;

use App\Models\GeneralContractors;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class GeneralContractorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GeneralContractors::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'   => $this->createUser()->id,
            'phone'     => $this->faker->e164PhoneNumber,
            'address'   => $this->faker->address,
            'website'   => $this->faker->url,

        ];
    }

    /**
     * @return Collection|Model|mixed
     */
    protected function createUser()
    {
        $user = User::factory()->create();
        \Bouncer::assign(User::ROLE_GENERAL_CONTRACTOR)->to($user);

        return $user;
    }
}
