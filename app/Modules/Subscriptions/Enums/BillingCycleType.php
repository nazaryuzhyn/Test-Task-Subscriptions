<?php

namespace App\Modules\Subscriptions\Enums;

use App\Helpers\Enums\Traits\ToArrayTrait;

enum BillingCycleType: string
{
    use ToArrayTrait;

    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';

    public function getDuration(): int
    {
        return match ($this) {
            self::MONTHLY => 1,
            self::YEARLY => 12,
        };
    }

    public function getDiscount(): float
    {
        return match ($this) {
            self::MONTHLY => 0,
            self::YEARLY => 20,
        };
    }
}
