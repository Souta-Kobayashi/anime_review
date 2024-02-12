<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class DatabaseStoreException extends Exception
{
    private string $term;

    private string $error;

    public function __construct(string $term, $error)
    {
        $this->term = $term;
        $this->error = $error;
    }

    public function render()
    {
        return response()->json(
            [
                'status' => 500,
                'message' => "想定外のエラーにより{$this->term}の保存に失敗しました",
                'error' => $this->error,
            ],
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
