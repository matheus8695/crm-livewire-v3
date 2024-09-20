<?php

namespace Database\Seeders;

use App\Models\{Customer, Task};
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Customer::all()
            ->each(
                fn (Customer $c) => Task::factory()
                ->count(rand(4, 10))
                ->create(['customer_id' => $c->id])
            );
    }
}
