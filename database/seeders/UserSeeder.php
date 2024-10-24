<?php

namespace Database\Seeders;

use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => 'Pa$$w0rd',
        ]);
    }
}
