<?php

namespace App\Modules\Subscriptions\Data;

use App\Modules\Subscriptions\Enums\BillingCycleType;
use App\Modules\Subscriptions\Models\Plan;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class UpdateSubscriptionData extends Data
{
    public function __construct(
        #[Exists(Plan::class, 'id')]
        public int $plan_id,

        #[Min(1)]
        public int $users_count,

        public BillingCycleType $billing_cycle,
    ) {}
}
