<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Actions\Login;
use App\Modules\Auth\Data\LoginData;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __invoke(LoginData $request, Login $login): JsonResponse
    {
        return $login->handle($request);
    }
}
