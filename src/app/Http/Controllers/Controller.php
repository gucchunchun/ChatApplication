<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function createResponse(string $message = 'success', array $data = null, int $status = 200, array $header = [])
    {
        $contents = [
            'message' => $message,
        ];

        if (isset($data)) {
            $contents['data'] = $data;
        }

        return response()->json(
            $contents, 
            $status,
            $header
        );
    }
}
