<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            // 非ログイン時の例外処理
            if ($request->is('api/isLoggedIn') && $e instanceof AuthenticationException) {
                return response()->json(
                    ['status' => 401, 'message' => 'authenticate failed'],
                );
            }

            // APIの認証エラーの例外処理
            if ($request->is('api/*') && $e instanceof AuthenticationException) {
                return response()->json(
                    ['status' => 401, 'message' => 'authenticate failed'],
                    Response::HTTP_UNAUTHORIZED
                );
            }
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
