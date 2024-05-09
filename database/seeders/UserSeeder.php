<?php

namespace Database\Seeders;

use App\Enum\Can;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()
            ->withPermission(Can::BE_AN_ADMIN)
            ->create([
                'name'  => 'Admin do CRM',
                'email' => 'admin@crm.com',
            ]);
    }
}
