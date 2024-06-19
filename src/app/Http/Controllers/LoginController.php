<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\UseCases\LoginUseCase;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Resources\Login\UserResource;

class LoginController extends Controller
{
    private $loginUseCase;
    public function __construct(LoginUseCase $loginUseCase)
    {
        $this->loginUseCase = $loginUseCase;
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $userEntity = $this->loginUseCase->execute($request->validated());

        return $this->createResponse(
            'Successfully logged in',
            (new UserResource($userEntity))->toArray($request)
        );
    }
}
