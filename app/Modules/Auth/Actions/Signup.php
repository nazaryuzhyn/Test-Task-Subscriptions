<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Data\SignupData;
use App\Modules\Users\Models\User;
use App\Modules\Users\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class Signup
{
    public function handle(SignupData $data): JsonResponse
    {
        return DB::transaction(function () use ($data): JsonResponse {
            $user = User::query()->create($data->toArray());

            $token = $user->createToken($user->email);

            return response()->json([
                'data' => [
                    'access_token' => $token->plainTextToken,
                    'user' => new UserResource($user)
                ]
            ], 201);
        });
    }
}
