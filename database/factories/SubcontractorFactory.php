<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\SubContractors;
use App\Models\SubcontractorStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcontractorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubContractors::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'                   => User::factory()->create(),
            'company_name'              => $this->faker->company,
            'primary_contact_name'      => $this->faker->firstNameMale,
            'phone'                     => $this->faker->e164PhoneNumber,
            'address'                   => $this->faker->address,
            'website'                   => $this->faker->url,
            'type'                      => null,
            'vendor_source'             => null,

            'parent_vendor' => null,
            'status_id'     => null,
            'csi_code' => null,
            'entity_type' => null,
            'workers_compensation' => null,
            'licensed' => null,
            'general_liability' => null,

            'crew_size' => null,
            'languages' => null,
            'drivers_license' => null,
            'has_tools' => null,
            'has_vehicle' => null,
            'years_of_experience' => null,
            'w9_uploaded' => null,

            'coi_uploaded' => null,
            'license_uploaded' => null,

        ];
    }
}
