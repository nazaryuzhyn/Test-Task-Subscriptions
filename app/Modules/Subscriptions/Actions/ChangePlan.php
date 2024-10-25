<?php

namespace App\Modules\Subscriptions\Actions;

use App\Modules\Subscriptions\Data\UpdateSubscriptionData;
use App\Modules\Subscriptions\Enums\BillingCycleType;
use App\Modules\Subscriptions\Enums\Status;
use App\Modules\Subscriptions\Models\Plan;
use App\Modules\Subscriptions\Models\Subscription;
use App\Modules\Users\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ChangePlan
{
    public function handle(User $user, UpdateSubscriptionData $data): Subscription
    {
        /** @var Subscription $subscription */
        $subscription = $user->subscriptions()->create([
            'plan_id' => $data->plan_id,
            'status' => $user->activeSubscription ? Status::PENDING->value : Status::ACTIVE->value,
            'amount' => $this->calculateAmount($data),
            'users_count' => $data->users_count,
            'started_at' => $this->getActivePeriod($user, $data->billing_cycle)->getStartDate(),
            'ended_at' => $this->getActivePeriod($user, $data->billing_cycle)->getEndDate(),
        ]);

        return $subscription;
    }

    private function calculateAmount(UpdateSubscriptionData $data): float
    {
        /** @var Plan $plan */
        $plan = Plan::query()->findOrFail($data->plan_id);

        $amount = $plan->price * $data->users_count;
        if ($data->billing_cycle === BillingCycleType::YEARLY) {
            $amount = $amount - ($amount * $data->billing_cycle->getDiscount() / 100);
        }

        return round($amount, 2);
    }

    private function getActivePeriod(User $user, BillingCycleType $billingCycle): CarbonPeriod
    {
        $date = $user->activeSubscription?->ended_at ?? Carbon::now();

        return CarbonPeriod::create($date, $date->copy()->addMonths($billingCycle->getDuration()));
    }
}
