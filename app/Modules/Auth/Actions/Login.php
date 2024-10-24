<?php

namespace App\Modules\Auth\Actions;

use App\Modules\Auth\Data\LoginData;
use App\Modules\Users\Models\User;
use App\Modules\Users\Resources\UserResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Login
{
    /**
     * Handle the login.
     *
     * @throws AuthenticationException
     */
    public function handle(LoginData $data): JsonResponse
    {
        $user = $this->login($data->toArray());
        $token = $user->createToken($user->email);

        return response()->json([
            'data' => [
                'access_token' => $token->plainTextToken,
                'user' => new UserResource($user)
            ],
        ]);
    }

    /**
     * @throws AuthenticationException
     */
    private function login(array $data): User
    {
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            throw new AuthenticationException('Email or password is incorrect');
        }

        /** @var User $user */
        $user = request()->user();

        return $user;
    }
}
