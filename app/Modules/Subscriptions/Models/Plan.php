<?php

namespace App\Modules\Subscriptions\Models;

use App\Modules\Subscriptions\Enums\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'currency',
    ];

    protected function casts(): array
    {
        return [
            'currency' => Currency::class,
        ];
    }
}
