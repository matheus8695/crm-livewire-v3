<?php

namespace Database\Seeders;

use App\Enum\Can;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->withPermission(Can::BE_AN_ADMIN)
            ->create([
                'name'  => 'Admin do CRM',
                'email' => 'admin@crm.com',
            ]);

        $admin = User::where('email', 'admin@crm.com')->first();

        $this->normalUsers();
        $this->deletedUsers($admin);
    }

    public function normalUsers(): void
    {
        User::query()->insert(
            array_map(fn () => (new UserFactory())->definition(), range(1, 50))
        );
    }

    public function deletedUsers(User $admin): void
    {
        User::query()->insert(
            array_map(
                fn () => array_merge(
                    (new UserFactory())->definition(),
                    [
                        'deleted_at' => now(),
                        'deleted_by' => $admin->id,
                    ]
                ),
                range(1, 50)
            )
        );
    }
}
