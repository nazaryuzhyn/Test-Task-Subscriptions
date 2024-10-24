<?php

namespace App\Modules\Auth\Data;

use App\Modules\Users\Models\User;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

class SignupData extends Data
{
    public function __construct(
        #[Min(3)]
        #[Max(60)]
        public string $name,

        #[Email]
        #[Unique(User::class, 'email')]
        public string $email,

        #[Min(8)]
        #[Max(50)]
        public string $password,
    ) {}
}
