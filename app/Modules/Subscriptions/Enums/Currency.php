<?php

namespace App\Modules\Subscriptions\Enums;

use App\Helpers\Enums\Traits\ToArrayTrait;

enum Currency: string
{
    use ToArrayTrait;

    case EUR = 'EUR';
}
