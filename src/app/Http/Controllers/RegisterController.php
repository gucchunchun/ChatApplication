<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\UseCases\RegisterUseCase;
use App\Http\Requests\Register\RegisterRequest;
use App\Http\Resources\Auth\UserResource;

class RegisterController extends Controller
{
    private $registerUseCase;
    public function __construct(RegisterUseCase $registerUseCase)
    {
        $this->registerUseCase = $registerUseCase;
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $userEntity = $this->registerUseCase->execute($request->validated());

        return $this->createResponse(
            config('response.success.register'),
            (new UserResource($userEntity))->resolve(),
            201
        );
    }
}
