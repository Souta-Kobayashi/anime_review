<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DatabaseUpdateException extends Exception
{
    private string $term;

    public function __construct(string $term)
    {
        $this->term = $term;
    }

    public function render()
    {
        return response()->json(
            ['status' => 500, 'message' => "想定外のエラーにより{$this->term}の更新に失敗しました"],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
