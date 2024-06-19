<?php

namespace App\Exceptions;

use Exception;

class MissingNameException extends Exception
{
    private $userData;
    public function __construct(array $userData, string $message = "Nickname is required")
    {
        parent::__construct($this->message);

        $this->userData = $userData;
    }

    public function report($request)
    {
        
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'NicknameRequiredException',
            'message' => $this->getMessage(),
            'data' => $this->userData
        ], 422);
    }
}
