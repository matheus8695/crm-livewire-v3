<?php

namespace Database\Seeders;

use App\Models\Opportunity;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    public function run(): void
    {
        $opps = [];

        for ($i = 1; $i < 50; $i++) {
            $opps[] = Opportunity::factory()
                ->make(['customer_id' => rand(1, 50)])->toArray();
        }

        Opportunity::query()->insert($opps);
    }
}
