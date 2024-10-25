<?php

namespace Database\Seeders;

use App\Modules\Subscriptions\Actions\ChangePlan;
use App\Modules\Subscriptions\Data\UpdateSubscriptionData;
use App\Modules\Subscriptions\Enums\BillingCycleType;
use App\Modules\Subscriptions\Enums\Status;
use App\Modules\Subscriptions\Models\Plan;
use App\Modules\Users\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        /** @var User $user */
        $user = User::query()->where('email', '=', 'user@gmail.com')->first();

        /** @var Plan $plan */
        $plan = Plan::query()->where('name', '=', 'Lite')->first();

        (new ChangePlan)->handle($user, UpdateSubscriptionData::from([
            'plan_id' => $plan->getKey(),
            'users_count' => 7,
            'billing_cycle' => BillingCycleType::MONTHLY->value,
        ]));
    }
}
