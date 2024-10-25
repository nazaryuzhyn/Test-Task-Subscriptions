<?php

namespace Database\Seeders;

use App\Modules\Subscriptions\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    private array $plans = [
        [
            'name' => 'Lite',
            'price' => 4,
        ],
        [
            'name' => 'Starter',
            'price' => 6,
        ],
        [
            'name' => 'Premium',
            'price' => 10,
        ],
    ];

    public function run(): void
    {
        foreach ($this->plans as $plan) {
            Plan::query()->firstOrCreate($plan);
        }
    }
}
