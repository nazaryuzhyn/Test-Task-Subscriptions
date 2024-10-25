<?php

namespace App\Modules\Users\Resources;

use App\Modules\Subscriptions\Resources\SubscriptionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'subscription' => new SubscriptionResource($this->activeSubscription),
        ];
    }
}
