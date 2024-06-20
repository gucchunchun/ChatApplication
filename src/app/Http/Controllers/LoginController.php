<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\UseCases\LoginUseCase;
use App\Http\Requests\Login\LoginRequest;
use App\Http\Resources\Auth\UserResource;

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

        // TODO: メッセージconfigに移動
        return $this->createResponse(
            config('response.success.login'),
            (new UserResource($userEntity))->resolve()
        );
    }
}
