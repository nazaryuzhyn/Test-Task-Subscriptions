<?php

declare(strict_types=1);

namespace App\Helpers\Enums\Traits;

trait ToArrayTrait
{
    public static function toArray(): array
    {
        return array_map(
            fn (self $enum) => $enum->value,
            self::cases()
        );
    }
}
