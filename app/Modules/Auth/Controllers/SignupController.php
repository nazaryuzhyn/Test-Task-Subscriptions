<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Actions\Signup;
use App\Modules\Auth\Data\SignupData;
use Illuminate\Http\JsonResponse;

class SignupController extends Controller
{
    public function __invoke(SignupData $request, Signup $signup): JsonResponse
    {
        return $signup->handle($request);
    }
}
