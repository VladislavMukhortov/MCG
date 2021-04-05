<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $recipientable = null;
        return [
            'recipientable_type'    => null,
            'recipientable_id'      => null,
            'recipient_id'          => null, //todo
            'project_id'            => null, //todo
            'status_id'             => null, //todo
            'sender_id'             => User::factory()->create(), //todo
            'sent_at'               => $this->faker->dateTime,
            'name'                  => $this->faker->title,
            'url'                   => $this->faker->url,

        ];
    }

    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                'sender_id' => 'suspended',
            ];
        });
    }
}
