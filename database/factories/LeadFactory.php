<?php

namespace Database\Factories;

use App\Models\Leads;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Leads::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        \Bouncer::assign(User::ROLE_LEAD)->to($user);
        return [
            'title'     => $this->faker->name,
            'user_id'   => $user->id,
            'email'     => $this->faker->email,
            'name'      => $this->faker->name,
        ];
    }

    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                //
            ];
        });
    }
}
