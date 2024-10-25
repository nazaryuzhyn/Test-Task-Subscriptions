<?php

namespace App\Modules\Subscriptions\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Subscriptions\Actions\ChangePlan;
use App\Modules\Subscriptions\Data\UpdateSubscriptionData;
use App\Modules\Subscriptions\Models\Plan;
use App\Modules\Subscriptions\Resources\PlanResource;
use App\Modules\Subscriptions\Resources\SubscriptionResource;
use App\Modules\Users\Models\User;

class SubscriptionController extends Controller
{
    public function plans()
    {
        $plans = Plan::query()->get();

        return PlanResource::collection($plans);
    }

    public function changePlan(UpdateSubscriptionData $request, ChangePlan $changePlan): SubscriptionResource
    {
        /** @var User $user */
        $user = auth()->user();

        $subscription = $changePlan->handle($user, $request);
        $subscription->load(['plan']);

        return new SubscriptionResource($subscription);
    }
}
