<?php

namespace App\Modules\Subscriptions\Enums;

use App\Helpers\Enums\Traits\ToArrayTrait;

enum Status: string
{
    use ToArrayTrait;

    case PENDING = 'pending';
    case ACTIVE = 'active';
    case CANCELED = 'canceled';
    case EXPIRED = 'expired';
}
