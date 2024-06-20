<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\UseCases\SNSLoginUseCase;
use App\Http\Resources\Auth\UserResource;

class SNSLoginController extends Controller
{
    private $snsLoginUseCase;
    public function __construct(SNSLoginUseCase $snsLoginUseCase)
    {
        $this->snsLoginUseCase = $snsLoginUseCase;
    }

    public function gitHub(): JsonResponse
    {
        $result = $this->snsLoginUseCase->gitHub();

        return $this->createResponseFromResult($result);
    }

    protected function createResponseFromResult(array $result): JsonResponse
    {
        return $this->createResponse(
            $result['new']? config('response.success.register'): config('response.success.login'),
            (new UserResource($result['user']))->resolve(),
            $result['new']? 201: 200,
        );
    }
}
