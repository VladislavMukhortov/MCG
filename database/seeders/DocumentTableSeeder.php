<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Leads;
use App\Models\SubContractors;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $start = now();
        $this->command->info('Documents Seeder Started...');
        try {
            $this->seedModelDocuments(new SubContractors, 'subcontractor',User::ROLE_SUBCONTRACTOR, 12);
            $this->seedModelDocuments(new Leads, 'lead',User::ROLE_LEAD, 12);
        } catch (\Throwable $exception) { dump($exception->getMessage());}

        $this->command->info('Time completed:   ' . $start->diffForHumans(null, true));
    }

    private function seedModelDocuments(Model $model, string $userRelationName,string $role, ?int $count = null)
    {
        $users = $this->getRoledUsers($role);
        $users->each( function (User $user) use ($model, $userRelationName) {
            if (!is_null($modelObject = $user->{$userRelationName})) {
                Document::factory()->count(random_int(3,9))->state(function (array $attributes) use ($modelObject) {
                    return ['recipientable_id' => $modelObject->id, 'recipientable_type' => $modelObject->getMorphClass()];
                })->create();
            } else {
                Document::factory()->count(random_int(3,9))->for($model::factory()->state(function (array $attributes) use ($user) {
                    return ['user_id' => $user->id];
                }), 'recipientable')->create();
            }
        });
    }

    protected function getRoledUsers(string $roleName)
    {
        return User::whereIs($roleName)->get();
    }
}
